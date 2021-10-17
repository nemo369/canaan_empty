<?php
// THIS IS THE main  functions files -> include filter, hooks and menus and so
defined('ABSPATH') || die();
if (canaan_conf::$isSafeLocalHost) {
    // wp_set_current_user(1);
    // wp_set_auth_cookie(1, true);
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
    if (WP_DEBUG === true) {
        canaan_conf::$staticVersionID = time();
    }
    if (is_admin() ||  'wp-login.php' === $pagenow) {
        return;
    }
    // wp_dequeue_script('jquery');
    // wp_deregister_script('jquery');
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

// BLOCK WP REST API FRON NOT LOGED USER 
// add_filter('rest_authentication_errors', function ($result) {

//     if (!empty($result)) {
//         return $result;
//     }
//     if (!is_user_logged_in()) {
//         return new WP_Error('rest_not_logged_in', 'You are not currently logged in.', array('status' => 401));
//     }
//     return $result;
// });

// FOR use with canaan_get_menu_array 
add_filter('wp_get_nav_menu_items', 'prefix_nav_menu_classes', 10, 3);

function prefix_nav_menu_classes($items, $menu, $args)
{
    _wp_menu_item_classes_by_context($items);
    return $items;
}

