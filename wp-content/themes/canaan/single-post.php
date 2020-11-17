<?php
defined('ABSPATH') || die();

global $post;
$prefix='post_';

$mainObj=new canaan_post($post);
$url=$mainObj->get_url();
$pid=$mainObj->get_ID();


 

get_header();

?>
<main  class="col-1-1">
    <article class="col-1-1">
    </article>

    <aside>
    
    </aside>
</main>



<?php 

get_footer();

