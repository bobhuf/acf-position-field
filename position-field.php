<?php
/*
Plugin Name: ACF Position Grid Field
Plugin URI: https://example.com/position-grid-field
Description: Adds a custom ACF field for flexible positioning using a 3x3 grid
Version: 1.01
Author: Taggetig
Author URI: https://taggetig.be
*/

// Prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}

class PositionGridField {
    public function __construct() {
        // Perform the ACF check on the init hook to ensure all plugins are loaded
        add_action('init', [$this, 'initialize_field'], 5);
    }
    
    /**
     * Initialize the field after checking if ACF is active
     */
    public function initialize_field() {
        // Check if ACF exists - using multiple detection methods
        if (!$this->is_acf_active()) {
            add_action('admin_notices', [$this, 'missing_acf_notice']);
            return;
        }

        // Wait for ACF to initialize before adding our field type
        add_action('acf/include_field_types', [$this, 'create_position_field_type']);
        add_action('acf/input/admin_enqueue_scripts', [$this, 'enqueue_styles']);
    }
    
    /**
     * Check if ACF is active using multiple detection methods
     */
    private function is_acf_active() {
        // Method 1: Check for ACF class
        if (class_exists('ACF')) {
            return true;
        }
        
        // Method 2: Check for ACF Pro class
        if (class_exists('acf_pro')) {
            return true;
        }
        
        // Method 3: Check for acf_field class (should be present in both)
        if (class_exists('acf_field')) {
            return true;
        }
        
        // Method 4: Check if function exists
        if (function_exists('acf_register_field_type')) {
            return true;
        }
        
        // Method 5: Check for active plugins
        if (!function_exists('is_plugin_active')) {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }
        
        if (is_plugin_active('advanced-custom-fields/acf.php') || 
            is_plugin_active('advanced-custom-fields-pro/acf.php')) {
            return true;
        }
        
        return false;
    }

    public function missing_acf_notice() {
        ?>
        <div class="notice notice-error">
            <p><?php _e('ACF Position Grid Field requires Advanced Custom Fields plugin to be installed and activated.', 'text_domain'); ?></p>
        </div>
        <?php
    }

    public function create_position_field_type() {
        if (function_exists('acf_register_field_type')) {
            require_once dirname(__FILE__) . '/class-acf-field-position-grid.php';
            acf_register_field_type(new acf_field_position_grid());
        }
    }

    public function enqueue_styles() {
        wp_enqueue_style('acf-position-grid', plugins_url('css/position-grid.css', __FILE__));
    }
}

// Initialize our plugin
new PositionGridField();
