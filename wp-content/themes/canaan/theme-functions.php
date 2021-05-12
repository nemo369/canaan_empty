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
function canaan_add_image_sizes()
{
    add_theme_support('post-thumbnails');
    // add_image_size('1920X580', 1920, 580, true);
    $images = [
        ['name' => '250X250', 'crop' => true]
    ];
    foreach ($images as $key => $img) {
        $sizes = explode('X', $img['name']);
        add_image_size($img['name'], $sizes[0], $sizes[1], $img['crop']);
    }
}
add_action('after_setup_theme', 'canaan_add_image_sizes');

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
 * Allow SVG uploads
 */
function add_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'add_mime_types');

// FOR use with canaan_get_menu_array 
add_filter('wp_get_nav_menu_items', 'prefix_nav_menu_classes', 10, 3);

function prefix_nav_menu_classes($items, $menu, $args)
{
    _wp_menu_item_classes_by_context($items);
    return $items;
}


$BUILD_FOLDER = 'build';

function vite_get_css_urls(string $entry): array
{
    global $BUILD_FOLDER;
    $urls = [];
    $manifest = vite_get_manifest();
   
    if (!empty($manifest[$entry]['css'])) {
        foreach ($manifest[$entry]['css'] as $file) {
            $urls[] = '/'.$BUILD_FOLDER.'/' . $file;
        }
    }
    return $urls;
}
function vite_get_manifest(): array
{
    global $BUILD_FOLDER;
    
    $build_dir = get_template_directory_uri().'/'.$BUILD_FOLDER;
    $content = file_get_contents($build_dir . '/manifest.json');
    return json_decode($content, true);
}
function vite_get_js_urls(string $entry): string
{
    global $BUILD_FOLDER;
    $manifest = vite_get_manifest();

    return isset($manifest[$entry])
    ? '/'.$BUILD_FOLDER.'/' . $manifest[$entry]['file']
    : '';
}
function vite_enqueue_script()
{
    if (!$_ENV['IS_DEV'] || $_ENV['IS_DEV']=== 'false') {
        $js = vite_get_js_urls('wp-content/themes/canaan/static/js/main.js');//cross with vite.confiog.js
        $csss = vite_get_css_urls('wp-content/themes/canaan/static/js/main.js');//cross with vite.confiog.js

        foreach ($csss as $key => $css) {
            wp_enqueue_style('canaan', get_template_directory_uri() .$css, []);
        }
        wp_enqueue_script('canaan', get_template_directory_uri() . $js, [], canaan_conf::$staticVersionID, true);
    } else{
        ?>
        <!-- if development -->
        <script type="module" src="http://localhost:3000/@vite/client"></script>
        <script type="module" src="http://localhost:3000/wp-content/themes/canaan/static/js/main.js"></script>
    <?php
    }
}

add_action('wp_enqueue_scripts', 'vite_enqueue_script');