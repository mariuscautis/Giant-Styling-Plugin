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
    // Get the URL of the image file
    $image_url = plugins_url( 'assets/g.jpg', __FILE__ );

    add_menu_page(
        'Giant Styling Sheet',
        'Giant Styling',
        'manage_options',
        'giant-styling',
        'giant_styling_page',
        $image_url, // Use the image URL as the icon
        20
    );
    
    add_submenu_page(
      'giant-styling',
      'Globals Settings',
      'Globals',
      'manage_options',
      'giant-styling-globals',
      'giant_styling_globals_page'
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
      'Width Options',
      'Width Options',
      'manage_options',
      'giant-styling-width',
      'giant_styling_width_page'
  );


    add_submenu_page(
      'giant-styling',
      'Flex Options',
      'Flex Options',
      'manage_options',
      'giant-styling-flex-width',
      'giant_styling_flex_width_page'
  );

 

    // add_submenu_page(
    //     'giant-styling',
    //     'Font Size Settings',
    //     'Font Size',
    //     'manage_options',
    //     'giant-styling-font-size',
    //     'giant_styling_font_size_page'
    // );


  
  


}
add_action('admin_menu', 'add_giant_styling_menu');

// Callback function for main menu page
function giant_styling_page() {
    // Display your plugin's main page content here
    echo '<div class="giant-container">';
        echo '<h1>Giant Styling Sheet</h1>';       
        include( plugin_dir_path( __FILE__ ) . 'parts/intro.php' );
    echo '</div>';
}


function giant_styling_globals_page() {
  // Display content for Globals Settings page
  echo '<div class="giant-container">';
      echo '<h1>Globals Settings</h1>';
      include( plugin_dir_path( __FILE__ ) . 'parts/globals.php' );
  echo '</div>';
}


// Callback functions for subpages
function giant_styling_margin_page() {
    // Display content for Margin Settings page
    echo '<div class="giant-container">';
        echo '<h1>Margin Settings</h1>';
        include( plugin_dir_path( __FILE__ ) . 'parts/margin.php' );
    echo '</div>';
}

function giant_styling_padding_page() {
    // Display content for Padding Settings page
    echo '<div class="giant-container">';
        echo '<h1>Padding Settings</h1>';
        include( plugin_dir_path( __FILE__ ) . 'parts/padding.php' );
    echo '</div>';
}

function giant_styling_width_page() {
  // Display content for Globals Settings page
  echo '<div class="giant-container">';
      echo '<h1>Width Options</h1>';
      include( plugin_dir_path( __FILE__ ) . 'parts/width.php' );
  echo '</div>';
}

function giant_styling_flex_width_page() {
  // Display content for Padding Settings page
  echo '<div class="giant-container">';
      echo '<h1>Flex Options</h1>';
      include( plugin_dir_path( __FILE__ ) . 'parts/flex.php' );
  echo '</div>';
}



function giant_styling_font_size_page() {
    // Display content for Font Size Settings page
    echo '<div class="giant-container">';
        echo '<h1>Font Size Settings</h1>';
    echo '</div>';
}






?>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all grandchildren within the values-area div
    var elements = document.querySelectorAll('.values-area div[id="giant-value"]');

    // Loop through each element and add event listener
    elements.forEach(function(element) {
      element.addEventListener('click', function(event) {
        // Prevent the default action of the click event
        event.preventDefault();
        // Stop event propagation to prevent parent element scroll
        event.stopPropagation();

        // Get the class name of the clicked element
        var className = element.className;
        console.log('Class name to copy:', className);
        // alert(sd);
        // Copy the class name to the clipboard
        copyToClipboard(className);
        
        // Add 'copied' class to the clicked element
        elements.forEach(function(el) {
          el.classList.remove('copied');
        });
        element.classList.add('copied');
      
        // Alternative focus method to avoid potential scroll animation
        element.setAttribute('tabindex', '0');
        element.blur();
      });
    });

    // Function to copy text to clipboard
    function copyToClipboard(text) {
      if (navigator.clipboard) {
        navigator.clipboard.writeText(text)
          .then(function() {
            console.log('Class name copied:', text);
          })
          .catch(function(err) {
            console.error('Failed to copy class name:', err);
            // Fallback to execCommand('copy')
            fallbackCopyTextToClipboard(text);
          });
      } else {
        // Fallback to execCommand('copy')
        fallbackCopyTextToClipboard(text);
      }
    }

    // Fallback method for copying text to clipboard using execCommand
    function fallbackCopyTextToClipboard(text) {
      var textArea = document.createElement('textarea');
      textArea.value = text;
      document.body.appendChild(textArea);
    //   textArea.focus();
      textArea.select();

      try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Fallback copy attempt was ' + msg);
      } catch (err) {
        console.error('Fallback copy attempt failed:', err);
      }

      document.body.removeChild(textArea);
    }
  });









</script>