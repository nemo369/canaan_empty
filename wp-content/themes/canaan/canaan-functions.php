<?php
// THIS IS THE main  functions files -> include filter, hooks and menus and so
defined('ABSPATH') || die();
// if(canaan_conf::$isSafeLocalHost){
//     wp_set_current_user(1);
//      wp_set_auth_cookie( 1, true ) ;
//    }


add_action('init', 'canaan_init');
function canaan_init()
{
    // if( ! session_id() ) {
    //     session_start();
    // }

    if (canaan_conf::$allowStaticVersioning) {
        if (intval(get_option('staticVersionID')))  canaan_conf::$staticVersionID = intval(get_option('staticVersionID'));
    }
    wp_deregister_script('jquery');
}



if (!function_exists('rsvp_canaan_theme_support')) :
    function rsvp_canaan_theme_support()
    {
        add_theme_support('title-tag');
        register_nav_menu('primary',  'Primary Menu');
    }
endif;
add_action('after_setup_theme', 'rsvp_canaan_theme_support');

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');

/*
 * prevents WP messages to users about upgrading
 */
remove_action('admin_notices', 'update_nag', 3);
remove_action('network_admin_notices', 'update_nag', 3);




/*
 * disable users from resetting their password by email
 */
function wo_disable_password_reset_cb()
{
    return false;
}

add_filter('allow_password_reset', 'wo_disable_password_reset_cb');

function wo_remove_password_reset_text_in($text)
{
    return str_replace('Lost your password</a>?', '</a>', 'X');
}




/*
 * Add Google Analytics tracking settings to admin dashboard
 */
function my_general_section()
{
    add_settings_section(
        'wo_google_analytics_section',  // Section ID
        'Google Analytics Tracking IDs',        // Section Title
        'wo_google_analytics_section', // Callback
        'general'                      // This makes the section show up on the General Settings Page
    );


    add_settings_field(
        'ga_tracking_code_1',   // Option ID
        'Tracking ID #1',       // Label
        'wo_google_analytics_settings', // !important - This is where the args go!
        'general',                      // Page it will be displayed (General Settings)
        'wo_google_analytics_section',  // Name of our section
        array(
            'ga_tracking_code_1' // Should match Option ID
        )
    );

    add_settings_field(
        'ga_tracking_code_2',   // Option ID
        'Tracking ID #2',       // Label
        'wo_google_analytics_settings', // !important - This is where the args go!
        'general',                      // Page it will be displayed (General Settings)
        'wo_google_analytics_section',  // Name of our section
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
function wo_google_analytics_section()
{
    echo '<p>Enter Google Analytics tracking codes. Uses the <code>gtag.js</code> tracking method.</p>';
}

function wo_email_accounts($args)
{
    $option = get_option($args[0]);
    echo '<input type="email" id="' . $args[0] . '" name="' . $args[0] . '" value="' . $option . '" placeholder="mail@domain.com , mail@doamin.com"/>';
}

function wo_google_analytics_settings($args)
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
// add_filter('upload_mimes', 'add_mime_types');

// securty - remove users from WP_API
// add_filter( 'rest_endpoints','rest_endpoints');

function rest_endpoints($endpoints)
{
    if (isset($endpoints['/wp/v2/users'])) {
        unset($endpoints['/wp/v2/users']);
    }
    if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
        unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints;
};

add_post_type_support('post', 'page-attributes');

/*
* Enqueue Custom custom_styles
*/
function custom_styles()
{
    $template_dir = get_stylesheet_directory_uri();
    $bundle_path = '/static/css/style.css';
    wp_register_style('canaan-css', $template_dir . $bundle_path, null, custom_latest_timestamp('css'), false);
    wp_enqueue_style('canaan-css');
}
add_action('wp_enqueue_scripts', 'custom_styles', 10);
/*
* Enqueue Custom Scripts
*/
function custom_scripts()
{
    $template_dir = get_stylesheet_directory_uri();
    $bundle_path = '/static/js/bundle.js';
    if(canaan_conf::$isProd) $bundle_path = '/static/js/bundle.dev.js';
    wp_enqueue_script('bundle', $template_dir . $bundle_path, null, custom_latest_timestamp('js'), true);
}
add_action('wp_enqueue_scripts', 'custom_scripts', 10);


/*
    * Convenience function to generate timestamp based on latest edits. Used to automate cache updating
    */
function custom_latest_timestamp($type = 'js')
{
    // set base, find top level assets of static dir
    $base = get_template_directory();
    $assets = array_merge(glob($base . '/static/'.$type.'/*.' . $type));
    // get m time of each asset
    $stamps = array_map(function ($path) {
        return filemtime($path);
    }, $assets);

    // if valid return time of latest change, otherwise current time
    return rsort($stamps) ? reset($stamps) : time();
}
