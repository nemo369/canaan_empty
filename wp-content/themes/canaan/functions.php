<?php
defined('ABSPATH') || die();
if (!class_exists('canaan_conf')) {
    if (file_exists(ABSPATH . '/canaan_conf.class.php')) {
        include ABSPATH . '/canaan_conf.class.php';
    } else {
        die('wrong instaliton');
    }
}

include_once(dirname(__FILE__) . '/theme-functions.php');
include_once(dirname(__FILE__) . '/framework/framework.php');
include_once(dirname(__FILE__) . '/carbon/carbon.php');
