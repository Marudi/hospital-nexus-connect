/**
 * Default Theme JavaScript
 * KlinicX Hospital Management System
 */

(function($) {
    'use strict';
    
    // Initialize theme when document is ready
    $(document).ready(function() {
        // Apply theme colors from CSS variables
        applyThemeColors();
        
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Initialize popovers
        $('[data-toggle="popover"]').popover();
        
        // Initialize select2 if available
        if ($.fn.select2) {
            $('.select2').select2();
        }
        
        // Sidebar toggle functionality
        $('.sidebar-toggle').on('click', function(e) {
            e.preventDefault();
            $('body').toggleClass('sidebar-collapse');
        });
        
        // Add smooth scrolling to all links
        $('a.smooth-scroll').on('click', function(e) {
            if (this.hash !== '') {
                e.preventDefault();
                var hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function() {
                    window.location.hash = hash;
                });
            }
        });
    });
    
    // Apply theme colors based on CSS variables
    function applyThemeColors() {
        var root = document.documentElement;
        
        // Get theme settings from page
        var primaryColor = root.style.getPropertyValue('--primary-color') || '#3c8dbc';
        var secondaryColor = root.style.getPropertyValue('--secondary-color') || '#f39c12';
        var bodyBg = root.style.getPropertyValue('--body-background') || '#f4f4f4';
        
        // Set colors in CSS variables if not already set
        if (!root.style.getPropertyValue('--primary-color')) {
            root.style.setProperty('--primary-color', primaryColor);
        }
        
        if (!root.style.getPropertyValue('--secondary-color')) {
            root.style.setProperty('--secondary-color', secondaryColor);
        }
        
        if (!root.style.getPropertyValue('--body-background')) {
            root.style.setProperty('--body-background', bodyBg);
        }
    }
    
    // Theme customization functions
    var ThemeCustomizer = {
        // Change primary color
        changePrimaryColor: function(color) {
            document.documentElement.style.setProperty('--primary-color', color);
        },
        
        // Change secondary color
        changeSecondaryColor: function(color) {
            document.documentElement.style.setProperty('--secondary-color', color);
        },
        
        // Change body background
        changeBodyBackground: function(color) {
            document.documentElement.style.setProperty('--body-background', color);
        }
    };
    
    // Make ThemeCustomizer available globally
    window.ThemeCustomizer = ThemeCustomizer;
    
})(jQuery); 