<?php
/**
 * Single variation cart button
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
            
<div id="nm-single-variation" class="single_variation"></div>

<div class="woocommerce-variation-add-to-cart variations_button">
    <button type="submit" class="nm-variable-add-to-cart-button single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
    <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
    <input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
    <input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
