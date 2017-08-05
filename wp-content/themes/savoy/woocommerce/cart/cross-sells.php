<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $nm_theme_options;

$crosssells = WC()->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) {
	return;
}

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $nm_theme_options['product_related_per_page'] ),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $nm_theme_options['product_related_columns'] );
$woocommerce_loop['columns_xsmall'] = '2';
$woocommerce_loop['columns_small'] = '2';
$woocommerce_loop['columns_medium'] = '4';

if ( $products->have_posts() ) : ?>

    <div id="nm-cross-sells" class="cross-sells products">
		
        <div class="nm-row">
        	<div class="col-xs-12">
				
                <h2><?php _e( 'You may be interested in&hellip;', 'woocommerce' ) ?></h2>
        	
                <?php woocommerce_product_loop_start(); ?>
        	
                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
        	
                        <?php wc_get_template_part( 'content', 'product' ); ?>
        	
                    <?php endwhile; // end of the loop. ?>
        	
                <?php woocommerce_product_loop_end(); ?>
			
        	</div>
        </div>
	
	</div>

<?php endif;

wp_reset_query();