<?php
defined('ABSPATH') || die();

class canaan_post{
    public $id=false;
    public $data=false;
    public $meta=false;

    public function __construct($post=false,$fetchAll=false) {
        if(!$post){
            global $post;
            if(!$post || $post &&!is_object($post)){
                return false;
            }
        }
        $postObject=false;
         switch (gettype($post)){
            case 'object':
                $postObject=$post;
            break;
            case 'integer':
                $postObject=get_post($post);
            break;
         }
        if(!$postObject || is_wp_error($postObject)){
            return false;
        }
        $this->data = $postObject;
        if(!$fetchAll){
            $this->meta = [];
        }else{
            $this->meta = get_post_meta($postObject->ID);
        } 
        return $this;
    }
    
    public function is_set($fname){
        if(!$fname){
            return false;
        }
        if(!isset($this->meta[$fname])){
            return false;
        }
        return true;
    }
            
    
    public function get_val($fname,$isCarbon=true){
        if($isCarbon){
            return carbon_get_post_meta( $this->get_ID(), $fname );   
        }
        if(!$this->is_set($fname)){
            return false;
        }
        return $this->meta[$fname][0];
    }
    
    public function get_title(){        
        return $this->data->post_title;
    }
    
    public function get_content(){
        return apply_filters('the_content', $this->data->post_content);
    }
    public function get_blocks()
    {
        $contnet = $this->data->post_content;
        if (has_blocks($contnet)) {
           return $blocks = parse_blocks($contnet);
        }
        return null;
    }
    public function get_excerpt($more_link_text ='', $trim = 50)
    {
        if (!empty ($this->data->post_excerpt)) {
            $use_excerpt = $this->data->post_excerpt;
        } else {
            $use_excerpt =$this->get_contnet();
        }

        if (preg_match('/<!--more(.*?)?-->/', $use_excerpt, $matches)) {
            $content = explode($matches [0], $use_excerpt, 2);
            if (!empty ($matches [1])) {
                $more_link_text = strip_tags(wp_kses_no_null(trim($matches [1])));
            }
            $use_excerpt = $content [0];
        }

        $text = strip_shortcodes($use_excerpt);
        //format it
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);

        $text = wp_trim_words($text, $trim);

        $text .= $more_link_text;

        return apply_filters('wp_trim_excerpt', $text, $text);
    }


    public function get_rich_text($fname,$isCarbon=true){
        return apply_filters('the_content', $this->get_val($fname,$isCarbon));
    }
    
    public function get_modified_date($format='d/m/Y'){
        return get_post_modified_time( $format, false, $this->data, true );
    }
    
    public function get_ID(){
        return $this->data->ID;
    }
    public function get_meta(){
        return $this->data->meta;
    }
    
    public function get_url(){
        return get_permalink($this->data);
    }
   
            
    public function get_post_terms($tax='category'){
        $terms= wp_get_post_terms($this->get_ID(), $tax);
        //$terms = array_reverse($terms);
        return $terms;
    }
    
    public function get_post_term($tax='category', $type ='name'){
        $terms= $this->get_post_terms( $tax);
        if(is_wp_error($terms)) return;
        if(empty($terms)) return null;
        $term = (array)$terms[0];
        if($term[$type]) return $term[$type];
        return $term;
    }
    
    public function get_image($args,$isCarbon=true){
        $defaults = array(
	      'field'=>'_thumbnail_id',
            'output'=>'object',
            'class'=>false,
            'lazy' => false,
            'size'=>array(
                false,false
            ),
	);
    $r = wp_parse_args( $args, $defaults );
    $val=$this->get_val($r['field'],$isCarbon);
        if(!$val){
            return false;
        }
        $img=new canaan_image($val);
        if(!$img){
            return false;
        }
        switch ($r['output']){
            case 'object':
                 return $img;
            break;
            case 'html':
            return $img->get_img_tag_sized($r['size'][0], $r['size'][1], $r['class'], $r['lazy']);
            break;
            case 'url':
                 return $img->get_sized_url();
            break;
            default:
                 return $img;
            break;
        }
    }
    
     
}
 