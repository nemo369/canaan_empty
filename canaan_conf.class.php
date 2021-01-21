<?php
// if (ABSPATH.'canaan_conf.class.php')) include ABSPATH.'canaan_conf.class.php';

class canaan_conf
{
    /**
     * always change before WP install!
     * never change after WP install
     *
     * used in WP's wp-config.php
     * 
     * @var string
     */


    public static $staticVersionID = 1;
    public static $carbonDir = '/';
    public static $static = false;
    public static $isSafeLocalHost = false;
    public static $IN_MAINTENANCE = false;
}
if (defined('ABSPATH')) {
    canaan_conf::$carbonDir = ABSPATH . '/vendor';
}




if (file_exists(dirname(__FILE__) . '/canaan_conf_local_overrides.php')){
    include dirname(__FILE__) . '/canaan_conf_local_overrides.php';
}
