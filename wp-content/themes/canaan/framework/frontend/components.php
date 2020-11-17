<?php

defined('ABSPATH') || die();


function get_wo_breadcrumbs($arr){
?>
    <?php
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