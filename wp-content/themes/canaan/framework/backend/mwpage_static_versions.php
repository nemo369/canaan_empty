<?php
if ( !defined('ABSPATH') ){
    die();
}
/**
 * wo
 *
 * Coded by Tom Rusko
 *
 * Copyrights Reserved
 *
 */

?><br><br><h1 style="text-align:center">Static File Versioning</h1><?php

$DoRequest = isset($_REQUEST['static_versioning_do']) ? true : false;
$staticVersionID = canaan_conf::$staticVersionID;
if(isset($_REQUEST['staticVersionID'])) $staticVersionID = $_REQUEST['staticVersionID'];
$targetVersion = isset($_REQUEST['static_versioning_next']) && $_REQUEST['static_versioning_next'] == 'true' ? $staticVersionID + 1 : $staticVersionID;

if ($DoRequest) {
    ?><h2>Versioning Styles</h2><?php
    $report = wo_styles::produceStaticVersions($targetVersion);
    echo '<pre>'.implode('<br>', $report).'</pre>';

    ?><h2>Versioning Sprites</h2><?php
    $report = wo_sprites::produceStaticVersions($targetVersion);
    echo '<pre>'.implode('<br>', (array)$report).'</pre>';

    ?><h2>Versioning JS Scripts</h2><?php
    $report = wo_jss::produceStaticVersions($targetVersion);
    echo '<pre>'.implode('<br>', $report).'</pre>';
    update_option('staticVersionID', $targetVersion);
} else {
    $staticVersionID = intval(get_option('staticVersionID'));
    if(!$staticVersionID) $staticVersionID = canaan_conf::$staticVersionID;
    ?>
        <hr>
    <form method="get" style="text-align:center; direction:ltr">
        <input type="hidden" name="static_versioning_do" value="true"/>
        <input type="hidden" name="page" value="mwpage_static_versions"/>
        current staticVersionID (This number is updating autmatilcy) <input type="number" value="<?php echo $staticVersionID;?>" name="staticVersionID"> 
        <br>
        <br>
        <br>
        <button name="static_versioning_next" value="false">Produce Current Static Version</button>
        <button name="static_versioning_next" value="true">Produce Next Static Version</button>
    </form><?php
}

