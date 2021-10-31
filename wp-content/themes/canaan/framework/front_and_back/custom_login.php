<?php

// changing the logo link from wordpress.org to your site
function mb_login_url() {  return 'https://naamanfrenkel.dev/'; }
add_filter( 'login_headerurl', 'mb_login_url' );



function my_login_logo()
{ ?>
    <style type="text/css">
    #login{
        max-width: 580px;
        width: 100% !important;
    }
    #loginform{
        border: 2px solid #cb5858;
        border-radius: 4px;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }
    body.login{
        background: #f2f2f2;
    }
        #login h1 a,
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/framework/backend/nemo.svg);
            height: 65px;
            width: 320px;
            background-size: 320px 65px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }

        body.login div#login p#backtoblog,
        body.login div#login p#nav {
            text-align: center;
        }
        body.login div#login p#nav a,
        body.login div#login p#backtoblog a {
            color: #cb5858 !important;
            font-size: 20px;
            text-align: center;
            /* Your link color. */
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');

function my_login_stylesheet()
{
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/framework/backend/style-login.css');
}
add_action('login_enqueue_scripts', 'my_login_stylesheet');
