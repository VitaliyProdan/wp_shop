<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

global $product, $woocommerce, $yith_wcwl_init;
add_action( 'woocommerce_after_add_to_cart_button', 'yit_product_other_actions' );
remove_action( 'woocommerce_share', array( $woocommerce->integrations->integrations['sharethis'], 'sharethis_code' ) );

if( !yit_get_option( 'shop-enabled' ) ) {
    add_action( 'woocommerce_single_product_summary', 'yit_product_other_actions', 35 );
}

$style = yit_get_option('product-single-layout', 'layout-1');

if ( $style == 'layout-2' ) {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

    if ( get_post_meta( $product->id, 'shop_single_layout_2_width', true ) ) {
        yit_get_model( 'image' )->set_size( 'shop_single', array(
            'width' => get_post_meta( $product->id, 'shop_single_layout_2_width', true ),
            'height' => get_post_meta( $product->id, 'shop_single_layout_2_height', true ),
            'crop' => 0
        ));
    }
}
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class( 'product-' . $style ); ?>>

	<?php
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );   
	?>

    <?php if ( $style == 'layout-2' ) : ?><div class="row main"><?php endif; ?>

        <div class="summary entry-summary<?php if ( $style == 'layout-2' ) echo ' span5' ?>">

            <?php
                if ( ! is_shop_enabled() || ! yit_get_option( 'shop-detail-show-price' ) )  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
                if ( ! is_shop_enabled() || ! yit_get_option( 'shop-detail-add-to-cart' ) ) remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

                remove_action( 'woocommerce_single_product_summary', '' );

                // add a separator after title and price
                add_action( 'woocommerce_single_product_summary', create_function( '', 'echo do_shortcode("[line]");' ) );

                /**
                 * woocommerce_single_product_summary hook
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 */
                do_action( 'woocommerce_single_product_summary' );
            ?>

        </div><!-- .summary -->

        <div class="after-product-summary<?php if ( $style == 'layout-2' ) echo ' span7' ?>"><?php

            /**
             * woocommerce_after_single_product_summary hook
             *
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_output_related_products - 20
             */
            do_action( 'woocommerce_after_single_product_summary' ); ?>

        </div>

        <?php if ( $style == 'layout-2' ) : ?>
        <div class="span12"><?php woocommerce_output_related_products() ?></div>
        <?php endif; ?>

    <?php if ( $style == 'layout-2' ) : ?></div><?php endif; ?>



</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>