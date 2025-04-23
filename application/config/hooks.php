<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_controller'] = array(
       // 'class'    => '',
        'function' => 'required',
        'filename' => 'required.php',
        'filepath' => 'hooks',
       // 'params'   => ''
);

// Security check hook - runs after controller execution
$hook['post_controller'] = array(
    'class'    => 'Security_check',
    'function' => 'check',
    'filename' => 'Security_check.php',
    'filepath' => 'hooks',
    'params'   => array()
);