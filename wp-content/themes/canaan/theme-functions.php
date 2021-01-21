<?php
// THIS IS THE main  functions files -> include filter, hooks and menus and so
defined('ABSPATH') || die();
if (canaan_conf::$isSafeLocalHost) {
    wp_set_current_user(1);
    wp_set_auth_cookie(1, true);
}
add_action('wp_loaded', function () {
    if (canaan_conf::$IN_MAINTENANCE && !is_user_logged_in()) {
 
        header('HTTP/1.1 Service Unavailable', true, 503);
        header('Content-Type: text/html; charset=utf-8');
        header('Retry-After: 3600');
       
        if (file_exists(ABSPATH . '/maintenance.html')) {
            require_once(ABSPATH . '/maintenance.html');
        }
        die();
    }
});

add_action('init', 'canaan_init');
function canaan_init()
{
  
      
        global $pagenow;
        if (defined('WP_DEBUG')) {
            canaan_conf::$staticVersionID = time();
        }
        if (is_admin() ||  'wp-login.php' === $pagenow ) {
            return;
        }
        wp_dequeue_script('jquery');
        wp_deregister_script('jquery');
    
}



function canaan_theme_support()
{
    register_nav_menu('primary',  'Primary Menu');
}
add_action('after_setup_theme', 'canaan_theme_support');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('admin_notices', 'update_nag', 3);
remove_action('network_admin_notices', 'update_nag', 3);




/*
 * disable users from resetting their password by email
 */
function canaan_disable_password_reset_cb()
{
    return false;
}

add_filter('allow_password_reset', 'canaan_disable_password_reset_cb');

function canaan_remove_password_reset_text_in($text)
{
    return str_replace('Lost your password</a>?', '</a>', 'X');
}




/*
 * Add Google Analytics tracking settings to admin dashboard
 */
function my_general_section()
{
    add_settings_section(
        'canaan_google_analytics_section',  // Section ID
        'Google Analytics Tracking IDs',        // Section Title
        'canaan_google_analytics_section', // Callback
        'general'                      // This makes the section show up on the General Settings Page
    );


    add_settings_field(
        'ga_tracking_code_1',   // Option ID
        'Tracking ID #1',       // Label
        'canaan_google_analytics_settings', // !important - This is where the args go!
        'general',                      // Page it will be displayed (General Settings)
        'canaan_google_analytics_section',  // Name of our section
        array(
            'ga_tracking_code_1' // Should match Option ID
        )
    );

    add_settings_field(
        'ga_tracking_code_2',   // Option ID
        'Tracking ID #2',       // Label
        'canaan_google_analytics_settings', // !important - This is where the args go!
        'general',                      // Page it will be displayed (General Settings)
        'canaan_google_analytics_section',  // Name of our section
        array(
            'ga_tracking_code_2' // Should match Option ID
        )
    );

    register_setting('general', 'ga_tracking_code_1', 'esc_attr');
    register_setting('general', 'ga_tracking_code_2', 'esc_attr');
}
add_action('admin_init', 'my_general_section');
/*
 * Settings callbacks that build the Analytics markup
 */
function canaan_google_analytics_section()
{
    echo '<p>Enter Google Analytics tracking codes. Uses the <code>gtag.js</code> tracking method.</p>';
}

function canaan_email_accounts($args)
{
    $option = get_option($args[0]);
    echo '<input type="email" id="' . $args[0] . '" name="' . $args[0] . '" value="' . $option . '" placeholder="mail@domain.com , mail@doamin.com"/>';
}

function canaan_google_analytics_settings($args)
{
    $option = get_option($args[0]);
    echo '<input type="text" id="' . $args[0] . '" name="' . $args[0] . '" value="' . $option . '" placeholder="UA-12345678-1"/>';
}


/*
 * Allow SVG uploads
 */
function add_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'add_mime_types');



// FOR use with canaan_get_menu_array 
add_filter( 'wp_get_nav_menu_items', 'prefix_nav_menu_classes', 10, 3 );

function prefix_nav_menu_classes($items, $menu, $args) {
    _wp_menu_item_classes_by_context($items);
    return $items;
}