<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $product, $woocommerce_loop, $post;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )    { $woocommerce_loop['loop'] = 0; }
// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) { $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 ); }

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
    return;
}

// Increase loop count
$woocommerce_loop['loop'] ++;

// Extra post classes
$woocommerce_loop['li_class'] = array();

if ( ! ( isset( $woocommerce_loop['layout'] ) && ! empty( $woocommerce_loop['layout'] ) ) ) {
    $woocommerce_loop['layout'] = yit_get_option( 'shop-layout', 'with-hover' );
}

// view
if ( ! ( isset( $woocommerce_loop['view'] ) && ! empty( $woocommerce_loop['view'] ) ) ) {
    $woocommerce_loop['view'] = yit_get_option( 'shop-view', 'grid' );
}

$woocommerce_loop['li_class'][] = $woocommerce_loop['view'];
$woocommerce_loop['li_class'][] = $woocommerce_loop['layout'];

// force open hover
if ( $woocommerce_loop['layout'] != 'classic' ) {
    $woocommerce_loop['li_class'][] = ( ! yit_get_option( 'shop-open-hover' ) ) ? 'add-hover' : 'force-open';
}

// open the hover on mobile
if ( yit_get_option( 'responsive-open-hover' ) && $woocommerce_loop['layout'] != 'classic' ) {
    $woocommerce_loop['li_class'][] = 'open-on-mobile';
}

// open the hover on mobile
if ( yit_get_option( 'responsive-force-classic' ) && $woocommerce_loop['layout'] == 'with-hover' ) {
    $woocommerce_loop['li_class'][] = 'force-classic-on-mobile';
}

// add border to classic style
if ( yit_get_option( 'shop-view-show-border' ) ) {
    $woocommerce_loop['li_class'][] = 'with-border';
}

// title classes
$title_class = array();
if ( ! yit_get_option( 'shop-view-show-title' ) ) { $title_class[] = 'hide'; }
if ( yit_get_option( 'shop-title-uppercase' ) )   { $title_class[] = 'upper'; }

$title_class = empty( $title_class ) ? '' : ' class="' . implode( ' ', $title_class ) . '"';

yit_detect_span_catalog_image(); //automatically add the classes

if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
    $woocommerce_loop['li_class'][] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
    $woocommerce_loop['li_class'][] = 'last';
}

if ( ! is_shop_enabled() || ! yit_get_option( 'shop-view-show-price' ) ) {
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
}

$image  = yit_image( "size=shop_catalog&output=array" );
$height = isset( $image[2] ) ? $image[2] : 0;
?>
<li <?php post_class( $woocommerce_loop['li_class'] ); ?><?php if ( $woocommerce_loop['view'] == 'list' ) : ?> style="min-height: <?php echo $height; ?>px;"<?php endif; ?>>

    <div class="product-wrapper">

        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

        <?php
        /**
         * woocommerce_before_shop_loop_item_title hook
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>

        <?php if ( $woocommerce_loop['layout'] == 'classic' && yit_get_option( 'shop-view-show-shadow' ) ) : ?>
            <div class="product-shadow"></div>
        <?php endif; ?>

        <?php if ( yit_get_option( 'shop-view-show-title' ) ): ?>
            <h3<?php echo $title_class ?>><?php the_title(); ?><?php if ( $woocommerce_loop['view'] == 'list' && yit_get_option( 'shop-view-show-rating' ) ) {
                    echo $product->get_rating_html();
                } ?></h3>
        <?php endif ?>

        <?php
        /**
         * woocommerce_after_shop_loop_item_title hook
         *
         * @hooked woocommerce_template_loop_price - 10
         * @hooked woocommerce_template_loop_rating - 5
         */
        do_action( 'woocommerce_after_shop_loop_item_title' ); ?>

        <div class="grid-add-to-cart"><?php woocommerce_template_loop_add_to_cart() ?></div>

        <?php if ($woocommerce_loop['layout'] != 'classic') : ?>
        <div class="clear"></div><?php endif ?>

        <div class="product-meta">
            <div class="product-meta-wrapper">

                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

            </div>
        </div>

    </div>

</li>