<?php

defined('ABSPATH') || die();


function the_breadcrumb($args)
{
    $sep = '<span class="sep">/</span>';
    if (!is_front_page()) {

        // Start the breadcrumb with a link to your homepage
        echo '<div class="inner-width mx-auto d-flex align-center row-1-1">';
        echo '<a class="color-blue" href="';
        echo home_url();
        echo '">';
        pll_e('ראשי');
        echo '</a>' . $sep;

        // Check if the current page is a category, an archive or a single page. If so show the category or archive name.
        if (is_category() || is_single()) {
            the_category($sep);
        } elseif (is_archive() || is_single()) {
            if($args['title']){
                printf($args['title']);
            } elseif (is_day()) {
                printf(__('%s', 'text_domain'), get_the_date());
            } elseif (is_month()) {
                printf(__('%s', 'text_domain'), get_the_date(_x('F Y', 'monthly archives date format', 'text_domain')));
            } elseif (is_year()) {
                printf(__('%s', 'text_domain'), get_the_date(_x('Y', 'yearly archives date format', 'text_domain')));
            } else {
                the_archive_title();
            }
        }

        // If the current page is a single post, show its title with the separator
        if (is_single()) {
            echo $sep;
            the_title();
        }

        // If the current page is a static page, show its title.
        if (is_page()) {
            echo the_title();
        }
        if(is_404()){
            echo '404';
        }

        // if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
        if (is_home()) {
            global $post;
            $page_for_posts_id = get_option('page_for_posts');
            if ($page_for_posts_id) {
                $post = get_page($page_for_posts_id);
                setup_postdata($post);
                the_title();
                rewind_posts();
            }
        }

        echo '</div>';
    }
}
function canaan_form(){
    $fields =[
        ['id'=>'fname','placeholder'=>'שם' ,'type'=>'text' ,'isRequierd'=>true],
        ['id'=>'email','placeholder'=>'אימייל' ,'type'=>'email' ,'isRequierd'=>true],
        ['id'=>'tel','placeholder'=>'פלאפון' ,'type'=>'tel' ,'isRequierd'=>false],
    ];
    echo '<form class="canaan-form js-canaan-form">';
    foreach ($fields as $key => $field) {
        echo '<div class="canaan-form__input">';
        echo '<input type="'.$field['type'].'" name="'.$field['id'].'" 
        id="'.$field['id'].'" '.($field['isRequierd'] ? 'required' : '').' placeholder="'.$field['placeholder'].'" >';
        echo '<div class="js-error-'.$field['id'].' error"></div>';
        echo '</div>';
    }
    echo '</form>';

}

function canaan_posted_on()
{
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        /* translators: %s: post date. */
        esc_html_x('Posted on %s', 'post date', 'canaan'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}

function canaan_posted_by()
{
    $byline = sprintf(
        /* translators: %s: post author. */
        esc_html_x('by %s', 'post author', 'canaan'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
