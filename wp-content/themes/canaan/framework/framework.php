<?php
defined('ABSPATH') || die();


include_once(dirname(__FILE__).'/front_and_back/general.php');
include_once(dirname(__FILE__).'/front_and_back/register_post_types.php');

if(is_admin()){
    include_once(dirname(__FILE__).'/backend/admin_side.php');
}else{
    include_once(dirname(__FILE__).'/frontend/frontend.php');
}



/*
 * Add Google Analytics tracking settings to admin dashboard
 */
function add_google_analytics()
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
add_action('admin_init', 'add_google_analytics');


/*
 * Settings callbacks that build the Analytics markup
 */
function canaan_google_analytics_section()
{
    echo '<p>Enter Google Analytics tracking codes. Uses the <code>gtag.js</code> tracking method.</p>';
}

function canaan_google_analytics_settings($args)
{
    $option = get_option($args[0]);
    echo '<input type="text" id="' . $args[0] . '" name="' . $args[0] . '" value="' . $option . '" placeholder="UA-12345678-1"/>';
}
