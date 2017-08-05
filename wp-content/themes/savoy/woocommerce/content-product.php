<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $nm_theme_options, $nm_globals;

nm_add_page_include( 'products' );

// Action: woocommerce_before_shop_loop_item
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

// Action: woocommerce_before_shop_loop_item_title
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// Action: woocommerce_after_shop_loop_item_title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Action: woocommerce_after_shop_loop_item
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();

// Product link
$product_link_atts = ' href="' . esc_url( get_permalink() ) . '"';

// Quick view link
if ( $nm_theme_options['product_quickview'] ) {
    $quickview_enabled = true;
    
    // Action: woocommerce_after_shop_loop_item
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    
    $quickview_link_atts = $product_link_atts . ' data-product_id="' . esc_attr( $product->id ) . '" class="nm-quickview-btn product_type_' . esc_attr( $product->product_type ) . '"';
    
    // Override static product link?
    if ( $nm_theme_options['product_quickview_links'] == 'all' ) {
        $product_link_atts = $quickview_link_atts;
    }
} else {
    $quickview_enabled = false;
}
	
// Hover image
$image_swap = ( $nm_theme_options['product_hover_image_global'] ) ? true : get_post_meta( $product->id, 'nm_product_image_swap', true );
$hover_image = '';
if ( $image_swap ) {
	$gallery_image_ids = $product->get_gallery_attachment_ids();
	
	if ( $gallery_image_ids ) {
		$hover_image_id = reset( $gallery_image_ids ); // Get first gallery image id
		$hover_image_src = wp_get_attachment_image_src( $hover_image_id, 'shop_catalog' );
		
		// Make sure the first image is found (deleted image id's can can still be assigned to the gallery)
		if ( $hover_image_src ) {
			$hover_image = '<img src="' . esc_url( NM_THEME_URI . '/img/transparent.gif' ) . '" data-src="' . esc_url( $hover_image_src[0] ) . '" width="' . esc_attr( $hover_image_src[1] ) . '" height="' . esc_attr( $hover_image_src[2] ) . '" class="attachment-shop-catalog hover-image" />';
		}
		
		$classes[] = 'hover-image-load';
	}
}
?>
<li <?php post_class( $classes ); ?>>

	<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 */
		do_action( 'woocommerce_before_shop_loop_item' );
	?>
    
    <div class="nm-shop-loop-thumbnail nm-loader">
        <a<?php echo $product_link_atts; ?>>
            <?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
                        
			<?php
				$placeholder_image = apply_filters( 'nm_shop_placeholder_img_src', NM_THEME_URI . '/img/placeholder.gif' );
				
				if ( has_post_thumbnail() ) {
                    $product_thumbnail_id		= get_post_thumbnail_id();
					$product_thumbnail_title	= get_the_title( $product_thumbnail_id );
					$product_thumbnail 			= wp_get_attachment_image_src( $product_thumbnail_id, 'shop_catalog' );
					
					if ( $nm_globals['shop_image_lazy_loading'] ) {
						echo '<img src="' . esc_url( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog unveil-image" />';
					} else {
						echo '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog" />';
					}
                } else if ( woocommerce_placeholder_img_src() ) {
					echo '<img src="' . esc_url( $placeholder_image ) . '" class="attachment-shop-catalog" />';
                }
				
				// Hover image
				echo $hover_image;
			?>
        </a>
    </div>
	
    <div class="nm-shop-loop-details">
    	<?php if ( $nm_globals['wishlist_enabled'] ) : ?>
        <div class="nm-shop-loop-wishlist-button"><?php nm_wishlist_button(); ?></div>
        <?php endif; ?>
    
        <h3><a<?php echo $product_link_atts; ?>><?php the_title(); ?></a></h3>
        
        <div class="nm-shop-loop-after-title <?php echo esc_attr( $nm_theme_options['product_action_link'] ); ?>">
			<div class="nm-shop-loop-price">
                <?php
					/**
					 * woocommerce_after_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
            </div>
            
            <div class="nm-shop-loop-actions">
				<?php
                    if ( $quickview_enabled ) {
                        echo '<a' . $quickview_link_atts . '>' . esc_html__( 'Show more', 'nm-framework' ) . '</a>';
                    }
                
                    /**
                     * woocommerce_after_shop_loop_item hook
                     *
                     * @hooked woocommerce_template_loop_add_to_cart - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item' );
                ?>
            </div>
        </div>
    </div>

</li>
