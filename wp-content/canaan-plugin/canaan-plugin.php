<?php
defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');

/**
 * @package  Canaan Plugin
 */
/*
Plugin Name: Canaan_Plugin
Plugin URI: https://naamanfrenkel.dev
Description: This is plugin is a must for Canaan Plugin
Version: 0.0.1
Author: Nemo Frenkel
Author URI: https://naamanfrenkel.dev
License: GPLv2 or later
Text Domain: nemo-plugin
*/

define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));

require_once dirname(__FILE__) . '/inc/pages/Admin.php';


class CanaanPlugin
{
}

$canaan_plugin = new CanaanPlugin();
