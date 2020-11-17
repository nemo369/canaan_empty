<?php
defined('ABSPATH') || die();


include_once(dirname(__FILE__).'/front_and_back/general.php');

if(is_admin()){
    include_once(dirname(__FILE__).'/backend/backend.php');
}else{
    include_once(dirname(__FILE__).'/frontend/frontend.php');
}
