<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! is_shop_enabled() || ! yit_get_option( 'shop-view-show-add-to-cart' ) ) return;

global $product;
?>

<?php if ( ! $product->is_in_stock() ) : ?>

	<a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ); ?>" class="out-of-stock button"><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out Of Stock', 'yit' ) ); ?></a>

<?php else : ?>

	<?php
		$link = array(
			'url'   => '',
			'label' => '',
			'class' => '',
			'quantity' => 1
		);

		$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );

		switch ( $handler ) {
			case "variable" :
				$link['url'] 	= apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
				$link['label'] 	= apply_filters( 'variable_add_to_cart_text', __( 'Set options', 'yit' ) );
			break;
			case "grouped" :
				$link['url'] 	= apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
				$link['label'] 	= apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'yit' ) );
			break;
			case "external" :
				$link['url'] 	= apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
				$link['label'] 	= apply_filters( 'external_add_to_cart_text', __( 'Read More', 'yit' ) );
			break;
			default :
				if ( $product->is_purchasable() ) {
					$link['url'] 	  = apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
					$link['label'] 	  = apply_filters( 'add_to_cart_text', __( 'Add to cart', 'yit' ) );
					$link['class']    = apply_filters( 'add_to_cart_class', 'add_to_cart_button' );
                    $link['quantity'] = apply_filters( 'add_to_cart_quantity', ( get_post_meta( $product->id, 'minimum_allowed_quantity', true ) ? get_post_meta( $product->id, 'minimum_allowed_quantity', true ) : 1 ) );
				} else {
					$link['url'] 	= apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
					$link['label'] 	= apply_filters( 'not_purchasable_text', __( 'Read More', 'yit' ) );
				}
			break;
		}

		echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-quantity="%s" data-product_sku="%s" class="%s button product_type_%s">%s</a>', esc_url( $link['url'] ), esc_attr( $product->id ), esc_attr( $link['quantity'] ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_attr( $product->product_type ), esc_html( $link['label'] ) ), $product, $link );

	?>

<?php endif; ?>
