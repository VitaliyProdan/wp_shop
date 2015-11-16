<?php
require_once('simple_html_dom.php');
include_once('../cyr2lat/cyr-to-lat.php');

class SiteReader
{
    protected $site_url;
    protected $category_selector;

    function __construct($site_url, $category_selector)
    {
        $this->site_url = $site_url;
        $this->category_selector = $category_selector;
    }

    public function get_categories($with_html = true)
    {
        $html = file_get_html($this->site_url);
        foreach ($html->find($this->category_selector) as $value) {
            $trim_value = trim($value->innertext);
            $url = $value->href;
            $slug = $this->slug_from_url($url);

            $this->save_category($trim_value, $slug); // TODO Uncomment me for saving!
            $result[] = $trim_value;
//            if($term = get_term_by( 'name', $value->innertext, 'product_cat') && $with_html ){
//                $result[] = "<span class='new'>$value->innertext</span>";
//                $this->save_category($value->innertext);
//            }else{
//                $result[] = $value->innertext;
//            }
        }

        if (!isset($result)) {
            $result[0] = 'Not found Categories by selector ' . $this->category_selector;
        }
        return $result;
    }

    public function save_category($name, $slug)
    {
        wp_insert_term(
            $name, // the term
            'product_cat', // the taxonomy
            array(
                'description' => $name,
                'slug' => $slug //ctl_sanitize_title($name) //function_exists('ctl_sanitize_title') ? ctl_sanitize_title($name) : $name
            )
        );
    }

    public function encoding($text)
    {
        return iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
    }

    public function get_products()
    {
        for ($i = 1; $i < 11; $i++) {
            $goods_page = file_get_html("http://tiande-shop.net/page/$i/?min_price=0&max_price=9999");
            //$i = 0;//TODO delete me
            foreach ($goods_page->find('ul.products li.product') as $product_link) {
                //if ($++i == 10) {break;} //TODO delete me
                $url = $product_link->children(0)->href;
                if (empty($url)) {
                    continue;
                }
                $product_page = file_get_html($url);

                $product = [];
                $product['Product'] = $product_page->find('h1.product_title')[0]->innertext;
                //echo $product['Product'] . '<br />';
                $price = $product_page->find('p.price span.amount')[0]->innertext;
                $product['Price'] = empty($price) ? 0 : (float)$this->remove_after($price, '&nbsp');
                //echo $product['Price'] . '<br />';

                 $product['SKU'] = (int)trim(strip_tags($product_page->find('span.sku')[0]->innertext));
                //echo $product['SKU']. '<br />';

                $categories = $product_page->find('span.posted_in a');
                $cat_ids = [];
                foreach ($categories as $cat) {
                    $slug = $this->slug_from_url($cat->href);
                    $slug = get_term_by('slug', $slug, 'product_cat');
                    $cat_ids[] = $slug->term_id;
                    //echo '$slug->term_id: ' . $slug->term_id . '<br />';
                }
                $product['cat_ids'] = $cat_ids;
                //$weight = $product_page->find('p.price span.amount')->innertext;
                $img = $product_page->find('img.attachment-shop_single')[0]->src;
                // echo $img . '<br />';

                $product['img_path'] = $img;
                //$product['img_path'] = wp_upload_dir()['path'] . '/' . $this->generateRandomString() . '.jpg';
                //file_put_contents($product['img_path'], file_get_contents($img));


                $product['Long_description'] = $product_page->find('div[itemprop="description"]')[0]->innertext;
                //echo $product['Long_description'] . '<br />';
                $product['Qty'] = 1000;
                //echo '<hr />';
                $this->create_new_product($product);
            }
        }
    }

    public function slug_from_url($url)
    {
        if (substr($url, -1) == '/') {
            $url = substr_replace($url, '', strlen($url) - 1, 1);
        }
        $slug = explode('/', $url);
        return end($slug);
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function create_new_product($product)
    {
        $new_post = array(
            'post_title' => $product['Product'],
            'post_name' => ctl_sanitize_title($product['Product']),
            'post_content' => $product['Long_description'],
            'post_status' => 'publish',
            'post_type' => 'product'
        );

        $skuu = $product['SKU'];
        $post_id = wp_insert_post($new_post);
        update_post_meta($post_id, '_sku', $skuu );
        update_post_meta( $post_id, '_regular_price', (float)$product['Price'] );
        update_post_meta( $post_id, '_price', (float)$product['Price'] );
        update_post_meta( $post_id, '_manage_stock', true );
        update_post_meta( $post_id, '_stock', $product['Qty'] );
        //update_post_meta( $post_id, '_weight', $product['Weight'] );

        update_post_meta( $post_id, '_visibility', 'visible' );
        //wp_set_object_terms ($post_id, 'variable','product_type');
        wp_set_object_terms( $post_id, $product['cat_ids'][0], 'product_cat' );

        if (((int)$product['Qty']) > 0) {
            update_post_meta( $post_id, '_stock_status', 'instock');
        }
        //wp_set_object_terms($post_id, $product['cat_ids'], 'wpsc_product_category' );
//        foreach ($product['cat_ids'] as $v){
//
//        }



//        $dir = dirname(__FILE__);
//        $imageFolder = $dir.'/../import/';
//        $imageFile   = $product['ID'].'.jpg';
//        $imageFull = $imageFolder.$imageFile;

        // only need these if performing outside of admin environment
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // example image
        //$image = 'http://localhost/wordpress/wp-content/import/'.$product['ID'].'.jpg';

        // magic sideload image returns an HTML image, not an ID
        $media = media_sideload_image($product['img_path'], $post_id);

        // therefore we must find it so we can set it as featured ID
        if(!empty($media) && !is_wp_error($media)){
            $args = array(
                'post_type' => 'attachment',
                'posts_per_page' => -1,
                'post_status' => 'any',
                'post_parent' => $post_id,
            );

            // reference new image to set as featured
            $attachments = get_posts($args);

            if(isset($attachments) && is_array($attachments)){
                foreach($attachments as $attachment){
                    // grab source of full size images (so no 300x150 nonsense in path)
                    $image = wp_get_attachment_image_src($attachment->ID, 'full');
                    // determine if in the $media image we created, the string of the URL exists
                    if(strpos($media, $image[0]) !== false){
                        // if so, we found our image. set it as thumbnail
                        set_post_thumbnail($post_id, $attachment->ID);
                        // only want one image
                        break;
                    }
                }
            }
        }
    }
    public function remove_after($string, $after){
        $position = strripos($string, $after);
        return substr($string, 0, $position);
    }

}