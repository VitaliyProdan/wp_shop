<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

add_filter('yit_plugins', 'yit_add_plugins');
function yit_add_plugins( $plugins ) {
    return array_merge( $plugins, array(


      array(
            'name' 		=> 'YITH WooCommerce Zoom Magnifier',
            'slug' 		=> 'yith-woocommerce-zoom-magnifier',
            'required' 	=> false,
            'version'=> '1.0.2',
        ),

        array(
            'name' 		=> 'YITH WooCommerce Wishlist',
            'slug' 		=> 'yith-woocommerce-wishlist',
            'required' 	=> false,
            'version'=> '1.0.2',
        ),
        array(
            'name'         => 'YITH Woocommerce Advanced Reviews',
            'slug' 		   => 'yith-woocommerce-advanced-reviews',
            'required' 	   => false,
            'version'      => '1.0.0',
        ),

        array(
            'name'         => 'YITH Woocommerce Order Traking',
            'slug' 		   => 'yith-woocommerce-order-tracking',
            'required' 	   => false,
            'version'      => '1.0.0',
        ),

        array(
            'name'         => 'YITH Woocommerce Review Reminder',
            'slug' 		   => 'yith-woocommerce-review-reminder',
            'required' 	   => false,
            'version'      => '1.0.0',
        ),

        array(
            'name' 		=> 'YITH WooCommerce Ajax Search',
            'slug' 		=> 'yith-woocommerce-ajax-search',
            'required' 	=> false,
            'version'   => '1.1.1'
        ),

        array(
            'name'      => 'YITH WooCommerce Cart Message',
            'slug'      => 'yith-woocommerce-cart-messages',
            'required'  => false,
            'version'   => '1.0.0'
        ),

        array(
            'name'      => 'YITH WooCommerce PDF Invoice and Shipping List',
            'slug'      => 'yith-woocommerce-pdf-invoice',
            'required'  => false,
            'version'   => '1.0.0'
        ),

        array(
            'name'      => 'YITH WooCommerce Stripe',
            'slug'      => 'yith-woocommerce-stripe',
            'required'  => false,
            'version'   => '1.0.0'
        ),

        array(
            'name'      => 'YITH WooCommerce Authorize.net Payment Gateway',
            'slug'      => 'yith-woocommerce-authorizenet-payment-gateway',
            'required'  => false,
            'version'   => '1.0.0'
        ),

    ));
}