<?php
defined('ABSPATH') || die();

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
add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);
function add_type_attribute($tag, $handle, $src) {
    // if not your script, do nothing and return original $tag
    if ( 'canaan' !== $handle ) {
        return $tag;
    }
    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" defer src="' . esc_url( $src ) . '"></script>';
    return $tag;
}