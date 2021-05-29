<?php
defined('ABSPATH') || die();

//  add genral data

add_action('wp_ajax_contactus', 'contactus_cb_ajax');
add_action('wp_ajax_nopriv_contactus', 'contactus_cb_ajax');
function contactus_cb_ajax()
{

    global $_POST;
    $email = $_POST['email'];

    $data = $_POST;
    foreach ($data as $k => $v) {
        $data[$k] = wp_kses_data($v);
    }

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array('status' => 'fail', 'message' => pll__('המייל אינו תקין'), 'element' => 'email'));
        die(); // bad request1
    }

    $emails_meta=carbon_get_theme_option( 'misc_'.'email_accounts' );
    $emails_to =wp_list_pluck($emails_meta, 'email');

    $to = carbon_get_theme_option('misc_email_accounts');

    add_filter( 'wp_mail_content_type', function( $content_type ) {
        return 'text/html';
    } );
    $email_content = '';

    unset($data['pll_load_front']);
    unset($data['order_tour_field']);
    unset($data['action']);
    unset($data['_wp_http_referer']);

    foreach ($data as $k => $v) {
        $email_content .= '<p style="direction:rtl;"><b>' . field_trans($k) . ':</b><br/>' . $v . '</p>';
    }

    $email_content = apply_filters('comment_moderation_text', $email_content);
    echo apply_filters('comment_moderation_headers', '');


    $subject = " הודעה מאתר  " . get_bloginfo('name');

    // create_a_lead($email_content,$data['name'] );
    $headers = array('Content-Type: text/html; charset=UTF-8');
    @wp_mail($emails_to, $subject, $email_content, $headers);
    echo json_encode(array('status' => 'sent', 'message' => pll__('ההודעה נשלחה בהצלחה')));
    die();
}


function field_trans($k)
{
    switch ($k) {
        case 'phone':
            return 'טלפון';
            break;
        case 'name':
            return 'שם מלא';
            break;
        case 'address':
            return 'כתובת';
            break;
        case 'show':
            return 'בחירת הופעה';
            break;
        case 'role':
            return 'תפקיד';
            break;
        case 'ticket-type':
            return 'כרטיס יחיד/זוגי';
            break;
    }


    return $k;
}

function create_a_lead($email_content, $name){
        // Create a Lead 
        $args = [
            'post_title'    => wp_strip_all_tags($name),
            'post_content'  => $email_content,
            // 'post_status'   => 'published',
            'post_type' => 'lead',
        ];
        wp_insert_post($args);
        // Create a Lead 
}