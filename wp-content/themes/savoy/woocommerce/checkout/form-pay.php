<?php
/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author   WooThemes
 * @package  WooCommerce/Templates
 * @version  2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form id="order_review" method="post">
	<div class="nm-myaccount-checkout nm-checkout clearfix">
        <div class="nm-row">
            <div class="col-md-4 col-xs-12">
                <h3 id="order_review_heading"><?php esc_html_e( 'Unpaid Order', 'nm-framework' ); ?></h3>
            </div>
            
            <div class="col-md-8 col-xs-12">
                <ul class="shop_table">
                    <?php if ( sizeof( $order->get_items() ) > 0 ) : ?>
						<?php 
							foreach ( $order->get_items() as $item ) :
                        	
							// Product thumbnail
                            if ( has_post_thumbnail( $item['product_id'] ) ) {
                                $thumbnail = get_the_post_thumbnail( $item['product_id'], 'shop_thumbnail', array() );
							} else {
                                $thumbnail = '';
							}
						?>
                            <li>
                                <div class="product-thumbnail"><?php echo $thumbnail; ?></div>
                                <div class="product-details">
                                    <div class="col-xs-8 nopad">
                                        <div class="product-name"><?php echo esc_html( $item['name'] ); ?><strong class="product-quantity">&times; <?php echo esc_html( $item['qty'] ); ?></strong></div>
                                    </div>
                                    <div class="col-xs-4 nopad">
                                        <div class="product-subtotal"><?php echo $order->get_formatted_line_subtotal( $item ); ?></div>
                                    </div>
                                </div<
                            </li>
						<?php endforeach; ?>
					<?php endif; ?>
                </ul>
                
                <div class="cart_totals">
                    <ul>
                    <?php
                        if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
                            ?>
                            <li>
                                <div class="col-th col-xs-6"><?php echo $total['label']; ?></div>
                                <div class="product-total col-td col-xs-6"><?php echo $total['value']; ?></div>
                            </li>
                            <?php
                        endforeach;
                    ?>
                    </ul>
                </div>
                
            </div>
		</div>
		    
        <div id="payment" class="nm-row">
        	<div class="col-md-4 col-xs-12">
                <h3><?php _e( 'Payment', 'woocommerce' ); ?></h3>
            </div>
            
			<div class="col-md-8 col-xs-12">
            	<?php if ( $order->needs_payment() ) : ?>
                <ul class="payment_methods methods">
                    <?php
                        if ( ! empty( $available_gateways ) ) {
							foreach ( $available_gateways as $gateway ) {
								wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
							}
                        } else {
							echo '<p>' . apply_filters( 'woocommerce_no_available_payment_methods_message', __( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) ) . '</p>';
                        }
                    ?>
                </ul>
				<?php endif; ?>
        
                <div class="place-order">
                    <input type="hidden" name="woocommerce_pay" value="1" />
                    
                    <?php wc_get_template( 'checkout/terms.php' ); ?>
                    
                    <?php do_action( 'woocommerce_pay_order_before_submit' ); ?>

					<?php echo apply_filters( 'woocommerce_pay_order_button_html', '<input type="submit" class="button alt" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' ); ?>
        
                    <?php do_action( 'woocommerce_pay_order_after_submit' ); ?>
        
                    <?php wp_nonce_field( 'woocommerce-pay' ); ?>
                </div>
		
			</div>
		</div>
	</div>
</form>
