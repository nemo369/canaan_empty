<?php
defined('ABSPATH') || die();


function get_img_html($p, $lazy= true, $size='full'){

    $img= new canaan_image($p, $size);
    
    if(!$img || !$img->isValid()) return;
    if($lazy){
        // return '<img loading="lazy" data-src="'.$img->get_sized_url().'" class="lazyload" width="'.$img->get_width().'" height="'.$img->get_height().'" alt="'.esc_attr( $img->get_alt()).'">';
        return $img->get_img_html($size, $lazy);
    } else{
        return '<img  src="'.$img->get_sized_url($size).'" alt="'.esc_attr( $img->get_alt()).'" >';
    }
}
function get_img_src($id, $size ='full'){
    $img= new canaan_image($id, $size);
    if(!$img) return;
    return $img->get_sized_url($size);
}

class canaan_image
{
    private $ID = false;
    private $src_full = false;
    private $width_full = false;
    private $height_full = false;
    private $title = false;
    private $caption = false;
    private $is_pdf = false;
    private $metaData = false;
    private $attachData = false;
    private $isValid = true;

    function __construct($img_id, $size = 'full')
    {
        
        $img_id = (int)$img_id;
        if (is_numeric($img_id)) {
            $img_ind = (int)$img_id;
            if ($img_ind <= 0) {
                $this->isValid = false;

                return;
            }

            $this->ID = $img_id;

            $img = wp_get_attachment_image_src($this->ID, $size);
            if ($img === false) {
                $pst = get_post($img_id);
                if ($pst->post_type == 'attachment' && $pst->post_mime_type == 'application/pdf') {
                    $this->src_full = wp_get_attachment_url($img_id);
                }
                if ($this->src_full !== false) {
                    $this->is_pdf = true;
                }
            }
            if (!$this->is_pdf) {
                if ($img === false || !is_array($img)) {
                    return false;
                }

                $this->src_full = $img[0];
                $this->width_full = $img[1];
                $this->height_full = $img[2];
            }

            $cc_s = get_post($this->ID);

            $this->title = $cc_s->post_title;
            if (empty($this->title)) {
                $this->title = false;
            }

            $this->caption = $cc_s->post_excerpt;
            if (empty($this->caption)) {
                $this->caption = false;
            }

            $this->metaData = get_post_custom($this->ID);
            if (key_exists('_wp_attachment_metadata', $this->metaData)) {
                $this->attachData = unserialize($this->metaData['_wp_attachment_metadata'][0]);
            }
        } else {
            $this->isValid = false;
        }
    }

    public function get_sized_url($width = false, $height = false)
    {
        if ($this->src_full == false || empty($this->src_full)) {
            return false;
        }

        if ($height === false && $width == false) {
            return $this->src_full;
        }

        if ($height === false) {
            $height = intval($this->height_full * $width / $this->width_full);
        }

        if ($width === false) {
            $width = intval($this->width_full * $height / $this->height_full);
        }

        if (preg_match('/(.*).(jpg|png)\z/', $this->src_full, $matches) && count($matches) == 3) {
            return $matches[1].'_wo_'.$width.'_'.$height.'.'.$matches[2];
        }

        return $this->src_full;
    }

    public function isValid()
    {
        return $this->isValid;
    }

    public function get_ratio()
    {
        return $this->width_full / $this->height_full;
    }

    public function is_acceptable_ratio($ratio)
    {
        return abs($this->get_ratio() - $ratio) < 0.05;
    }

    public function get_width()
    {
        return $this->width_full;
    }

    public function is_pdf()
    {
        return $this->is_pdf;
    }

    public function get_height()
    {
        return $this->height_full;
    }

    public function get_title()
    {
        return $this->title;
    }

    public function get_caption()
    {
        return $this->caption;
    }

    public function get_alt()
    {
        if (is_array($this->metaData) && key_exists('_wp_attachment_image_alt', $this->metaData)) {
            return $this->metaData['_wp_attachment_image_alt'][0];
        }
        if (isset( $this->title)) {
            return $this->title;
        }

   
        return false;
    }
    public function get_url_originalImage()
    {
        return $this->src_full;
    }

    public function get_img_tag_by_size($size_slug, $lazy=true)
    {

       $img=wp_get_attachment_image_src($this->ID, $size_slug);

            if ($img===false || !is_array($img))
                    $url= $this->src_full;
            else
                    $url= $img[0];		


        if ($url == false) {
            return false;
        }

        $alt = $this->get_alt();
        $title = $this->get_title();

        $html = '<img '.($lazy ? 'loading="lazy" ' : '').' src="'.esc_attr($url).'" ';
        if (!empty ($addClass)) {
            $html .= ' class="'.$addClass.'" ';
        }

        if ($alt != false && !empty ($alt)) {
            $html .= ' alt="'.esc_attr($alt).'" ';
        }


        $html .= ' />';

        return $html;

    }

    public function get_img_tag_sized($width = false, $height = false, $addClass = '', $islazey=false)
    {

        $url = $this->get_sized_url($width, $height);

        if ($url == false) {
            return false;
        }

        $alt = $this->get_alt();
        $title = $this->get_title();

        $html = '<img src="'.esc_attr($url).'" ';
        if (!empty ($addClass)) {
            $html .= ' class="'.$addClass.'" ';
        }

        if ($alt != false && !empty ($alt)) {
            $html .= ' alt="'.esc_attr($alt).'" ';
        }

        $html .= ' '.($islazey ? 'loading="lazy" ' : '').' />';

        return $html;

    }

    public function get_img_html($size_slug = 'full', $lazy = true){
        $img = wp_get_attachment_image_src($this->ID, $size_slug);
        
        if ($img === false || !is_array($img)) {
            $url = $this->src_full;
        } else {
            $url = $img[0];
        }

        $alt = $this->get_alt();
        $title = $this->get_title();
        $caption = $this->get_caption();

        $html = '';
        $html .= '<img src="'.esc_attr($url).'" ';
        if ($alt != false && !empty ($alt)) {
            $html .= ' alt="'.esc_attr($alt).'" ';
        }
      
        $html .= ' width="'.$this->get_width().'" height="'.$this->get_height().'"';

        $html .= ' '.($lazy ? 'loading="lazy" ' : '').' />';



        return $html;
    }
    public function get_html_sized_wcaption($size_slug = null, $addClass ='', $islazey = false)
    {

        $img = wp_get_attachment_image_src($this->ID, $size_slug);

        if ($img === false || !is_array($img)) {
            $url = $this->src_full;
        } else {
            $url = $img[0];
        }

        $alt = $this->get_alt();
        $title = $this->get_title();
        $caption = $this->get_caption();

        $html = '';
        if (mb_strlen($caption)) {
            $html .= '<div class="img_w_caption">';
        }

        $html .= '<img src="'.esc_attr($url).'" ';
        if (!empty ($addClass)) {
            $html .= ' class="'.$addClass.'" ';
        }

        if ($alt != false && !empty ($alt)) {
            $html .= ' alt="'.esc_attr($alt).'" ';
        }


        $html .= ' '.($islazey ? 'loading="lazy" ' : '').' />';

        $html .= ' />';


        if (mb_strlen($caption)) {
            $html .= '<p class="img_caption_gen">'.$caption.'</p></div>';
        }


        return $html;
    }
}



