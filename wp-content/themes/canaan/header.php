<?php
if (!defined('ABSPATH')) {
    die();
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php // get_template_part('parts/favicon'); 
    ?>
    <?php get_template_part('parts/ga-tracking'); ?>
    <?php // get_template_part('parts/font-loader');
    ?>
    <script>
        var __mainData = {
            nonce: '<?php echo wp_create_nonce('register_user'); ?>',
            isHP: <?php echo (is_front_page() ? 'true' : 'false'); ?>,
            homeUrl: '<?php echo home_url(); ?>',
            ajaxUrl: '<?php echo admin_url('admin-ajax.php'); ?>',
            isRtl: <?php echo is_rtl() ? 'true' : 'false' ?>,
            loadMore: false,
            postsPerPage: <?php echo get_option('posts_per_page'); ?>,
            offset: <?php echo get_option('posts_per_page'); ?>,
        }
    </script>

    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="generator" content="Naaman Frenkel using WordPress">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <?php
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>
    <div id="app">
        <div class="sitcky-footer">
            <header>

            </header>