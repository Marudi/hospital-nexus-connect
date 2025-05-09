/*
 * RTLCSS https://github.com/MohammadYounes/rtlcss
 * Framework for transforming Cascading Style Sheets (CSS) from Left-To-Right (LTR) to Right-To-Left (RTL).
 * Copyright 2017 Mohammad Younes.
 * Licensed under MIT <http://opensource.org/licenses/mit-license.php>
 * */
'use strict'
const postcss = require('postcss')
const state = require('./state.js')
const config = require('./config.js')
const util = require('./util.js')

module.exports = function (options, plugins, hooks) {
  const processed = Symbol('processed')
  const configuration = config.configure(options, plugins, hooks)
  const context = {
    // provides access to postcss
    postcss: postcss,
    // provides access to the current configuration
    config: configuration,
    // provides access to utilities object
    util: util.configure(configuration),
    // processed symbol
    symbol: processed
  }
  let flipped = 0
  const toBeRenamed = {}

  function shouldProcess (node, result) {
    if (!node[processed]) {
      let prevent = false
      state.walk(function (current) {
        // check if current directive is expecting this node
        if (!current.metadata.blacklist && current.directive.expect[node.type]) {
          // perform action and prevent further processing if result equals true
          if (current.directive.begin(node, current.metadata, context)) {
            prevent = true
          }
          // if should end? end it.
          if (current.metadata.end && current.directive.end(node, current.metadata, context)) {
            state.pop(current)
          }
        }
      })
      node[processed] = true
      return !prevent
    }
    return false
  }
  return {
    postcssPlugin: 'rtlcss',
    Once (root, { result }) {
      context.config.hooks.pre(root, postcss)
      shouldProcess(root, result)
    },
    Rule (node, { result }) {
      if (shouldProcess(node, result)) {
        // new rule, reset flipped decl count to zero
        flipped = 0
      }
    },
    AtRule (node, { result }) {
      if (shouldProcess(node, result)) {
        // @rules requires url flipping only
        if (context.config.processUrls === true || context.config.processUrls.atrule === true) {
          const params = context.util.applyStringMap(node.params, true)
          node.params = params
        }
      }
    },
    Comment (node, { result }) {
      if (shouldProcess(node, result)) {
        state.parse(node, result, function (current) {
          let push = true
          if (current.directive === null) {
            current.preserve = !context.config.clean
            context.util.each(context.config.plugins, function (plugin) {
              const blacklist = context.config.blacklist[plugin.name]
              if (blacklist && blacklist[current.metadata.name] === true) {
                current.metadata.blacklist = true
                if (current.metadata.end) {
                  push = false
                }
                if (current.metadata.begin) {
                  result.warn('directive "' + plugin.name + '.' + current.metadata.name + '" is blacklisted.', { node: current.source })
                }
                // break each
                return false
              }
              current.directive = plugin.directives.control[current.metadata.name]
              if (current.directive) {
                // break each
                return false
              }
            })
          }
          if (current.directive) {
            if (!current.metadata.begin && current.metadata.end) {
              if (current.directive.end(node, current.metadata, context)) {
                state.pop(current)
              }
              push = false
            } else if (current.directive.expect.self && current.directive.begin(node, current.metadata, context)) {
              if (current.metadata.end && current.directive.end(node, current.metadata, context)) {
                push = false
              }
            }
          } else if (!current.metadata.blacklist) {
            push = false
            result.warn('unsupported directive "' + current.metadata.name + '".', { node: current.source })
          }
          return push
        })
      }
    },
    Declaration (node, { result }) {
      if (shouldProcess(node, result)) {
        // if broken by a matching value directive .. break
        if (!context.util.each(context.config.plugins,
          function (plugin) {
            return context.util.each(plugin.directives.value, function (directive) {
              if (node.raws.value && node.raws.value.raw) {
                const expr = context.util.regexDirective(directive.name)
                if (expr.test(node.raws.value.raw)) {
                  expr.lastIndex = 0
                  if (directive.action(node, expr, context)) {
                    if (context.config.clean) {
                      node.value = node.raws.value.raw = context.util.trimDirective(node.raws.value.raw)
                    }
                    flipped++
                    // break
                    return false
                  }
                }
              }
            })
          })) return
        // loop over all plugins/property processors
        context.util.each(context.config.plugins, function (plugin) {
          return context.util.each(plugin.processors, function (processor) {
            if (node.prop.match(processor.expr)) {
              const raw = node.raws.value && node.raws.value.raw ? node.raws.value.raw : node.value
              const state = context.util.saveComments(raw)
              const pair = processor.action(node.prop, state.value, context)
              state.value = pair.value
              pair.value = context.util.restoreComments(state)
              if (pair.prop !== node.prop || pair.value !== raw) {
                flipped++
                node.prop = pair.prop
                node.value = pair.value
              }
              // match found, break
              return false
            }
          })
        })
        // if last decl, apply auto rename
        // decl. may be found inside @rules
        if (context.config.autoRename && !flipped && node.parent.type === 'rule' && context.util.isLastOfType(node)) {
          const renamed = context.util.applyStringMap(node.parent.selector)
          if (context.config.autoRenameStrict === true) {
            const pair = toBeRenamed[renamed]
            if (pair) {
              pair.selector = node.parent.selector
              node.parent.selector = renamed
            } else {
              toBeRenamed[node.parent.selector] = node.parent
            }
          } else {
            node.parent.selector = renamed
          }
        }
      }
    },
    OnceExit (root, { result }) {
      state.walk(function (item) {
        result.warn('unclosed directive "' + item.metadata.name + '".', { node: item.source })
      })
      Object.keys(toBeRenamed).forEach(function (key) {
        result.warn('renaming skipped due to lack of a matching pair.', { node: toBeRenamed[key] })
      })
      context.config.hooks.post(root, postcss)
    }
  }
}

module.exports.postcss = true

/**
 * Creates a new RTLCSS instance, process the input and return its result.
 * @param {String}  css  A string containing input CSS.
 * @param {Object}  options  An object containing RTLCSS settings.
 * @param {Object|Array}  plugins An array containing a list of RTLCSS plugins or a single RTLCSS plugin.
 * @param {Object}  hooks An object containing pre/post hooks.
 * @returns {String} A string contining the RTLed css.
 */
module.exports.process = function (css, options, plugins, hooks) {
  return postcss([this(options, plugins, hooks)]).process(css).css
}

/**
 * Creates a new instance of RTLCSS using the passed configuration object
 * @param {Object}  config  An object containing RTLCSS options, plugins and hooks.
 * @returns {Object}  A new RTLCSS instance.
 */
module.exports.configure = function (config) {
  config = config || {}
  return postcss([this(config.options, config.plugins, config.hooks)])
}
