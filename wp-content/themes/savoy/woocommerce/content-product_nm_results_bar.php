<?php
/**
 *	Template for displaying shop results bar/button
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $nm_theme_options;

$is_search = false;
$is_taxonomy = false;

// Config
if ( ! empty( $_REQUEST['s'] ) ) { // Is search query set and not empty?
    $is_search = true;
    $results_bar_class = ' is-search';
    $esc_button_text = sprintf( esc_html__( 'Search results for &ldquo;%s&rdquo;', 'nm-framework' ), '<span>' . esc_html( $_REQUEST['s'] ) . '</span>' );
} else if ( is_product_taxonomy() ) {
    $is_taxonomy = true;
    $current_term = $GLOBALS['wp_query']->get_queried_object();
    
    if ( is_product_category() ) {
        $results_bar_class = ' is-category';
        $esc_button_text = sprintf( esc_html__( 'Showing &ldquo;%s&rdquo;', 'nm-framework' ), '<span>' . esc_html( $current_term->name ) . '</span>' );
    } else {
        $results_bar_class = ' is-tag';
        $esc_button_text = sprintf( esc_html__( 'Products tagged &ldquo;%s&rdquo;', 'woocommerce' ), '<span>' . esc_html( $current_term->name ) . '</span>' );
    }
}

if ( $is_search || $is_taxonomy ) :
	// Get shop page URL
	$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
	
	// Button "href" value
	$button_href = ( $nm_theme_options['shop_filters_enable_ajax'] ) ? '#' : $shop_page_url;
?>

    <div class="nm-shop-results-bar btn<?php echo esc_attr( $results_bar_class ); ?>">
        <a href="<?php echo esc_url( $button_href ); ?>" data-shop-url="<?php echo esc_url( $shop_page_url ); ?>" id="nm-shop-results-reset">
            <i class="nm-font nm-font-close2"></i>
            <?php echo $esc_button_text; ?>
        </a>
    </div>

<?php endif; ?>
