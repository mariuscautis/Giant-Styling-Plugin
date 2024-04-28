<?php 
/**
 * Plugin Name: Giant Styling Sheet
 * Description: Practical sheet to help with CSS styling by adding the below classes to Gutenberg Blocks
 * Author: Marius Cautis
 * Author URI: www.gogiant.co.uk
 * Version: 1.0.0
 * Text Domain: giant-styling-sheet
 */


// Security check
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue CSS file
function enqueue_giant_styles() {
    // Enqueue the stylesheet
    wp_enqueue_style( 'giant-styles', plugins_url( 'giant-styles.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_giant_styles' );




// Enqueue CSS file for admin area
function enqueue_admin_styles() {
    wp_enqueue_style( 'giant-admin-styles', plugins_url( 'giant-styles.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_styles' );



// Add menu link
function add_giant_styling_menu() {
    add_menu_page(
        'Giant Styling Sheet',
        'Giant Styling',
        'manage_options',
        'giant-styling',
        'giant_styling_page',
        'dashicons-admin-appearance',
        20
    );

    // Add subpages
    add_submenu_page(
        'giant-styling',
        'Margin Settings',
        'Margin',
        'manage_options',
        'giant-styling-margin',
        'giant_styling_margin_page'
    );

    add_submenu_page(
        'giant-styling',
        'Padding Settings',
        'Padding',
        'manage_options',
        'giant-styling-padding',
        'giant_styling_padding_page'
    );

    add_submenu_page(
        'giant-styling',
        'Font Size Settings',
        'Font Size',
        'manage_options',
        'giant-styling-font-size',
        'giant_styling_font_size_page'
    );

    add_submenu_page(
        'giant-styling',
        'Globals Settings',
        'Globals',
        'manage_options',
        'giant-styling-globals',
        'giant_styling_globals_page'
    );
}
add_action('admin_menu', 'add_giant_styling_menu');

// Callback function for main menu page
function giant_styling_page() {
    // Display your plugin's main page content here
    echo '<h1 class="backend-title">Giant Styling Sheet</h1>';
    echo '<p>Welcome to the Giant Styling plugin!</p>';
}

// Callback functions for subpages
function giant_styling_margin_page() {
    // Display content for Margin Settings page
    echo '<h1>Margin Settings</h1>';
}

function giant_styling_padding_page() {
    // Display content for Padding Settings page
    echo '<h1>Padding Settings</h1>';
}

function giant_styling_font_size_page() {
    // Display content for Font Size Settings page
    echo '<h1>Font Size Settings</h1>';
}

function giant_styling_globals_page() {
    // Display content for Globals Settings page
    echo '<h1>Globals Settings</h1>';
}
