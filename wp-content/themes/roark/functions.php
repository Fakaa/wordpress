<?php
define('ROARK_VERSION', "1.0");
define('ROARK_CSS_URI', get_template_directory_uri() . '/css/');
define('ROARK_JS_URI', get_template_directory_uri() . '/js/');
define('ROARK_IMG',  get_template_directory_uri() . '/img/');

add_action( 'after_setup_theme', 'roark_setup' );
function roark_setup() {

	load_theme_textdomain('roark', get_template_directory() . '/languages' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form') );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('title-tag');

	global $content_width;

	if ( ! isset( $content_width ) ) { 
		$content_width = 1200;
	}

	add_theme_support( 'menus' );
	register_nav_menus(
		array( 'roark-main-menu' => esc_html__( 'Roark Menu', 'roark' ) )
	);

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'link', 'quote' ) );
}

function roark_get_postformat($post) {
	return get_post_format($post);
}

// Widget Sidebar
add_action('widgets_init', 'roark_widget_sidebar');
function roark_widget_sidebar() {
	register_sidebar( array(
		'name'			=> esc_html__('Sidebar', 'roark'),
		'id'			=> 'roark_sidebar',
		'description'	=> esc_html__('The content inside of the area will be shown on the left/right page position.', 'roark'),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="h5 widget-title"><span>',
		'after_title'	=> '</span></h4>'
	) );

	register_sidebar( array(
		'name'			=> esc_html__('Footer 1', 'roark'),
		'id'			=> 'roark_footer_left',
		'description'	=> esc_html__('Dragging some widget items for Footer 1', 'roark'),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="h5 widget-title">',
		'after_title'	=> '</h4>'
	) );

	register_sidebar( array(
		'name'			=> esc_html__('Footer 2', 'roark'),
		'id'			=> 'roark_footer_right',
		'description'	=> esc_html__('Dragging some widget items for Footer 2', 'roark'),
		'description'	=> '',
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="h5 widget-title">',
		'after_title'	=> '</h4>'
	) );
}

/*
Register Fonts
*/
function roark_studio_fonts_url($font) {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'roark' ) ) {
        $font_url = add_query_arg( 'family', urlencode( $font ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}

// Enqueue script and style
add_action( 'wp_enqueue_scripts', 'roark_load_scripts' );
function roark_load_scripts() {
	$min = defined('WP_DEBUG') && WP_DEBUG ? '.' : '.min.';

	wp_enqueue_style('roark', get_stylesheet_uri());

	if( isset(roark_framework::$option['googlemap_api']) && !empty(roark_framework::$option['googlemap_api']) )
	{
		$url = add_query_arg( 'key', roark_framework::$option['googlemap_api'], '//maps.googleapis.com/maps/api/js' );
		wp_enqueue_script('googlemap', $url, array(), 'v3', false);
	}

    if( !wp_style_is('roark_google_fonts' , 'enqueued') ) {
    	$font_default = 'Droid Serif:400,400i|Lato:400,400i,700|Montserrat:400,700';
	 	wp_enqueue_style('roark_google_fonts', roark_studio_fonts_url($font_default), array(), '1.0.0' );
    }

	wp_enqueue_style('font-awesome', ROARK_CSS_URI . 'lib/font-awesome.min.css');
	wp_enqueue_style('font-linea', ROARK_CSS_URI .'lib/font-linea.css');
	wp_enqueue_style('bootstrap', ROARK_CSS_URI .'lib/bootstrap.min.css');
	wp_enqueue_style('animate', ROARK_CSS_URI .'lib/animate.css');
	wp_enqueue_style('owl.carousel', ROARK_CSS_URI .'lib/owl.carousel.css');
	wp_enqueue_style('magnific-popup', ROARK_CSS_URI . 'lib/magnific-popup.css');
	wp_enqueue_style('roark_style', ROARK_CSS_URI .'style.css');
	
	// Script
    wp_enqueue_script('jquery');
    if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
 	}
    wp_enqueue_script('jquery-ui-tabs');
 	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('owlcarousel', ROARK_JS_URI .'lib/owl.carousel.min.js', array('jquery'), '2.0.0', true);
	wp_enqueue_script('parallax', ROARK_JS_URI .'/lib/jquery.parallax-1.1.3.min.js', array('jquery'), '1.1.3', true);
	wp_enqueue_script('imagesloaded');
	wp_enqueue_script('isotope', ROARK_JS_URI .'lib/isotope.pkgd.min.js', array('jquery'), '2.2.2', true);
	wp_enqueue_script('wow', ROARK_JS_URI .'lib/wow.min.js', array('jquery'), '1.0.4', true);
    wp_enqueue_script('magnific-popup', ROARK_JS_URI . 'lib/jquery.magnific-popup.min.js', array('jquery'), '', true);
	wp_enqueue_script('roark_script', ROARK_JS_URI .'script'.$min.'js', array('jquery'), ROARK_VERSION, true);

	wp_add_inline_script('jquery-migrate', roark_add_to_head());
	wp_add_inline_script('jquery', roark_add_to_footer());
	wp_localize_script('roark_script', 'roark_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

}

add_action('script_loader_tag', 'roark_add_attributes_to_scripts', 10, 3);
function roark_add_attributes_to_scripts($tag, $handle, $src)
{
	if ( $handle != 'jquery-core' && (strpos($tag, 'themepunch') === false) )
	{
    	return str_replace( array(' src', ' href'), array(' data-cfasync="true" src', ' data-cfasync="true" href'), $tag );
	}else{
		return str_replace( array(' src', ' href'), array(' data-cfasync="false" src', ' data-cfasync="false" href'), $tag);
	}
}


add_action('comment_form_top', 'roark_comment_form_top');
function roark_comment_form_top() {
	echo '<div class="row">';
}

add_action('comment_form', 'roark_comment_form_bottom');
function roark_comment_form_bottom($post_id) {
	echo '</div>';
}

add_filter( 'comment_form_fields', 'roark_move_comment_field_to_bottom' );
function roark_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}


function roark_custom_comment ( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; 

	switch ($comment->comment_type) :
		case 'pingback':
		case 'trackpack':
        // Display trackbacks differently than normal comments.
        ?>
        <li <?php comment_class('comment');?> id="comment-<?php comment_ID();?>">
            <div class="comment-body"><?php esc_html_e('Pingback:', 'roark');?> <?php comment_author_link();?> <?php edit_comment_link(esc_html__('(Edit)', 'roark'), '<span class="edit-link">', '</span>');?></div>
        <?php
        break;
		default:
?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

			<?php echo get_avatar($comment, $args['avatar_size'] ); ?>

			<div class="comment-body">
				<cite class="fn text-uppercase"><?php comment_author_link(); ?></cite>
			
				<span class="comment-date"><?php printf( esc_html__('%1s at %2s', 'roark'), get_comment_date(), get_comment_time() ); ?></span>

				<?php comment_text(); ?>

				<div class="comment-edit-reply">
					<?php comment_reply_link( array_merge( $args, array('reply_text'=> esc_html__('Reply', 'roark'), 'depth'=> $depth, 'max_depth'=>$args['max_depth']) ), $comment->comment_ID ); ?>
					<?php if( is_user_logged_in() ) { echo '/'; } ?>
					<?php edit_comment_link( esc_html__('Edit', 'roark') );  ?>
	            </div>

	        </div>
	<?php 
		break;
	endswitch;
}

// Convert array key=>value to attribute
function roark_array_to_attributes($array_attr) {
	$str = null;


	foreach ($array_attr as $key => $value)
	{
		if ( $key == 'bg_overlay' )
		{
			if ( isset($value['rgba']) && !empty($value['rgba']) )
			{
				$str .= "$key='".$value['rgba']."'";
			}else{
				if ( isset($value['color']) && !empty($value['color']) )
				{
					$str .= "$key='".$value['color']."'";
				}
			}
		}else{
			$str .= "$key=\"$value\" ";
		}

	}

	return $str;
}	

if ( ! function_exists( 'roark_disable_dev_mode_plugin' ) ) {
    function roark_disable_dev_mode_plugin( $redux ) {
        if ( $redux->args['opt_name'] != 'redux_demo' ) {
            $redux->args['dev_mode'] = false;
            $redux->args['forced_dev_mode_off'] = false;
        }
    }
    add_action( 'redux/construct', 'roark_disable_dev_mode_plugin' );
}

// Remove font end editor
if ( function_exists('vc_disable_frontend') )
{
	vc_disable_frontend();

	add_filter( 'vc_load_default_templates', 'roark_custom_template_modify_array' ); // Hook in
	function roark_custom_template_modify_array( $data ) {
	    return array(); // This will remove all default templates. Basically you should use native PHP functions to modify existing array and then return it.
	}
}

// PARSE VIDEO
function roark_parse_video($url) {

    $type = $id = '';

    if (strpos($url, 'youtube') > 0) {

        $type = 'youtube';
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $output_array);
        $id = $output_array[1];

    } else if (strpos($url, 'vimeo') > 0) {

        $type = 'vimeo';
        preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/', $url, $output_array);
        $id = $output_array[5];

    }

    if ( !empty($id) && !empty($type) ) {
        return array('type'=>$type, 'id'=>$id);
    } else {
        return array('type'=>'self', 'id'=>$id);
    }
}

function roark_add_to_head()
{
	ob_start();
	?>
	window.WilokeGlobal = {};
	WilokeGlobal.portfolio = {};
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	if( isset(roark_framework::$option['header_code']) && !empty(roark_framework::$option['header_code']) )
	{
		$content .= roark_framework::$option['header_code'];
	}

	return $content;
}

function roark_add_to_footer()
{
	if( isset(roark_framework::$option['footer_code']) && !empty(roark_framework::$option['footer_code']) )
	{
		return roark_framework::$option['footer_code'];
	}
}


function roark_parse_googlefont($aFont) {
    $aParseFont = explode("\n", $aFont);
    $aFontStyles = array('default' => 'Default');

    foreach ( $aParseFont as $font ) {

        preg_match('/(?:family=)([^:&\'\"]*)(?:\:?)((?:[^&\'\"]*))/', $font, $match);

        $fontFamily = str_replace('+', ' ', $match[1]);

        if ( isset($match[2]) && !empty($match[2]) )
        {
            $parseStyle = explode(",", $match[2]);

            foreach ( $parseStyle as $style )
            {
                $fontStyle = preg_replace("/(\d*)/", "", $style);

                $weight = (int)$style;

                switch ($weight)
                {
                    case 100:
                        $weightName = "Thin";
                        break;
                    case 300:
                        $weightName = "Light";
                        break;
                    case 500:
                        $weightName = "Medium";
                        break;
                    case 900:
                        $weightName = "Ultra-Bold";
                        break;
                    case 700:
                        $weightName = "Bold";
                        break;
                    case 800:
                        $weightName = "Extra-Bold";
                        break;
                    default:
                        $weightName = "Normal";
                        break;
                }

                $fontkey = $match[1].'||'.$weight.'||'.$fontStyle;

                $aFontStyles[$fontkey]    = $fontFamily . ' ' . $weightName . ' ' . $weight . ' ' . ucfirst($fontStyle);
            }

        }else{
            $aFontStyles[$match[1]]  = $fontFamily;
        }

    }

    return $aFontStyles;
}

function roark_explode_font($font) {
	
	if( !empty($font) ) {
		$font = explode('||', $font);
	}

	return $font;
}

require_once get_template_directory() . '/core/init.php';


function roark_parse_request( $query )
{
	$portfolioLink = get_option('roark_portfolio_permalink');

	if ( $portfolioLink != 'category-portfolio' )
	{
		return false;
	}

	// Only noop the main query
	if ( ! $query->is_main_query() )
		return;

	// Only noop our very specific rewrite rule match
	if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
		return;
	}

	// 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
	if ( ! empty( $query->query['name'] ) ) {
		$query->set( 'post_type', array( 'portfolio' ) );
	}
}

function roark_portfolio_permalink() {

	add_settings_field(
		'roark_portfolio_permalink', // id
		 esc_html__('Custom Project URL', 'roark'), // setting title
		'roark_settings_input',  // display callback
		'permalink', // settings page
		'optional'  // settings section
	);

}
add_action( 'admin_init', 'roark_portfolio_permalink' );

function roark_permalink_save()
{
	if ( !is_admin() )
		return;

	if ( isset($_POST['roark_portfolio_permalink']) && !empty($_POST['roark_portfolio_permalink']) )
	{
		$permalink = roark_clean($_POST['roark_portfolio_permalink']);
		update_option('roark_portfolio_permalink', $permalink);
	}
}
roark_permalink_save();

function roark_clean( $var ) {
	return is_array( $var ) ? array_map( 'roark_clean', $var ) : sanitize_text_field( $var );
}

function roark_settings_input()
{
	$value = get_option('roark_portfolio_permalink');
	$value = $value ? $value : 'portfolio';
	?>
	<p>
		<input id='roark_portfolio_permalink_1' name='roark_portfolio_permalink' type='radio' value='portfolio' <?php checked($value, 'portfolio'); ?> />
		<code><?php echo esc_url(get_option('siteurl')); ?>/portfolio</code>
	</p>
	<p>
		<input id='roark_portfolio_permalink_2' name='roark_portfolio_permalink' type='radio' value='category-portfolio' <?php checked($value, 'category-portfolio'); ?>/>
		<code><?php echo esc_url(get_option('siteurl')); ?>/category-slug/portfolio-slug</code>
	</p>
	<?php

}

add_filter('wp_list_categories', 'roark_count_span');
function roark_count_span($links) {
	$links = str_replace('</a> (', ' (', $links);
	$links = str_replace(')', ')</a>', $links);
	return $links;
}

add_filter('get_archives_link', 'roark_archive_count_span');
function roark_archive_count_span($links) {
	$links = str_replace('</a>&nbsp;(', ' (', $links);
	$links = str_replace(')', ')</a>', $links);
	return $links;
}

function roark_remove_dev_mode() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'roark_remove_dev_mode');