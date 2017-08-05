<?php
/*
Plugin Name: Roark Shortcode
Plugin URI: http://wiloke.net
Description: Roark Shortcode
Version: 1.0
Author: Love - Wiloke Team
Author URI: http://wiloke.net
*/


if (!defined('ABSPATH')) {
	die("You don't have sufficient permission to access this page");
}

define('roark_SHORTCODE_URL', trailingslashit(plugins_url('', __FILE__)) );
define('roark_ADMIN_CORE_DIR',  trailingslashit(get_template_directory_uri().'/core'));
define('roark_SHORTCODE', '1.0');

if(!class_exists('roark_plugin_shortcode')) {

	class roark_plugin_shortcode {

		public $shortcodes = array(
			'shortcode_portfolio',
			'shortcode_banner',
			'shortcode_iconbox',
			'shortcode_client',
			'shortcode_title',
			'shortcode_twitter',
			'shortcode_google',
			'shortcode_skill',
			'shortcode_team',
			'shortcode_testimonial',
			'shortcode_pricing',
			'shortcode_portfolio',
			'shortcode_blog'
		);

		public function __construct() {
			$this-> init_shortcode();
			add_action('init', array($this, 'roark_register'));
			add_action( 'wp_ajax_roark_ajax_portfolio', array($this, 'ajaxLoadmore' ));
			add_action( 'wp_ajax_nopriv_roark_ajax_portfolio', array($this, 'ajaxLoadmore' ));
			add_filter( 'post_type_link', array($this, 'roark_remove_portfolio_slug'), 10, 2 );
			add_action( 'pre_get_posts', array($this, 'roark_parse_request'));
			add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts' ) );
		}

		public function init_shortcode() {
			foreach ($this->shortcodes as $shortcode) {
				add_shortcode( 'roark_' . $shortcode, array($this, 'render_'. $shortcode));
				add_action( 'vc_before_init', array($this, 'vc_map_'. $shortcode));
			}
		}

		public function enqueue_scripts() {

			if(!wp_script_is('appear', 'enqueued')) {
				wp_register_script('appear', roark_SHORTCODE_URL . 'assets/js/jquery.appear.js', array(), '', true);
				wp_enqueue_script('appear');
			}

			if(!wp_script_is('jquery-rose-shortcode', 'enqueued')) {
				wp_register_script('jquery-rose-shortcode', roark_SHORTCODE_URL . 'assets/js/rose.shortcode.js', array(), '', true);
				wp_enqueue_script('jquery-rose-shortcode');
			}

			if( !wp_script_is('sidebar-sticky', 'enqueued') ) {
		    	wp_register_script('sidebar-sticky', roark_SHORTCODE_URL .'assets/js/sidebar-sticky.js', array(), '', true);
		    	wp_enqueue_script('sidebar-sticky');
		    }

	  		if( !wp_script_is('jquery-waypoints', 'enqueued') ) {
		    	wp_register_script('jquery-waypoints', roark_SHORTCODE_URL .'assets/js/jquery.waypoints.min.js', array(), '4.0.0', true);
		    	wp_enqueue_script('jquery-waypoints');
		    }

		    

		    if( !wp_script_is('rose-js-portfolio', 'enqueued') ) {
		    	wp_register_script('rose-js-portfolio', roark_SHORTCODE_URL .'assets/js/rose.portfolio.js', array(), '1.0', true);
			 	wp_enqueue_script('rose-js-portfolio');
		    }
		}

		protected function merge_css( $param ) {

			if( !empty($param) ) {
				$css = '';
				foreach ($param as $key => $value) {

					if( !empty($value) ) {

						if( $key == 'background-image' ) {
							$css .= $key . ': url(' . esc_attr($value) . ');';
						} else {
							$css .= $key . ':' . esc_attr($value) . ';';
						}
					}
				}

				return $css;
			}

			return '';
		}

		protected function get_attachment_image_src($id, $size = 'thumbnail') {

			if( !empty($id) ) {
				$image = wp_get_attachment_image_src($id, $size);

				if( $image )
					return $image[0];

			}

			return '';
		}

		protected function animation() {
			return array(
				esc_html__( 'None', 'wiloke' ) 						=> 'none',
				esc_html__( 'Bounce', 'wiloke' ) 					=> 'bounce',
				esc_html__( 'Flash', 'wiloke' ) 					=> 'flash',
				esc_html__( 'Pulse', 'wiloke' ) 					=> 'pulse',
				esc_html__( 'RubberBand', 'wiloke' ) 				=> 'rubberBand',
				esc_html__( 'Shake', 'wiloke' ) 					=> 'shake',
				esc_html__( 'Swing', 'wiloke' ) 					=> 'swing',
				esc_html__( 'Tada', 'wiloke' ) 						=> 'tada',
				esc_html__( 'Wobble', 'wiloke' ) 					=> 'wobble',
				esc_html__( 'Jello', 'wiloke' ) 					=> 'jello',
				esc_html__( 'Bounce In', 'wiloke' ) 				=> 'bounceIn',
				esc_html__( 'Bounce InDown', 'wiloke' ) 			=> 'bounceInDown',
				esc_html__( 'Bounce InLeft', 'wiloke' ) 			=> 'bounceInLeft',
				esc_html__( 'Bounce InRight', 'wiloke' ) 			=> 'bounceInRight',
				esc_html__( 'Bounce InUp', 'wiloke' ) 				=> 'bounceInUp',
				esc_html__( 'Bounce Out', 'wiloke' ) 				=> 'bounceOut',
				esc_html__( 'Bounce OutDown', 'wiloke' ) 			=> 'bounceOutDown',
				esc_html__( 'Bounce OutLeft', 'wiloke' ) 			=> 'bounceOutLeft',
				esc_html__( 'Bounce OutRight', 'wiloke' ) 			=> 'bounceOutRight',
				esc_html__( 'Bounce OutUp', 'wiloke' ) 			=> 'bounceOutUp',
				esc_html__( 'Fade In', 'wiloke' ) 					=> 'fadeIn',
				esc_html__( 'Fade InDown', 'wiloke' ) 				=> 'fadeInDown',
				esc_html__( 'Fade InDown Big', 'wiloke' ) 			=> 'fadeInDownBig',
				esc_html__( 'Fade InLeft', 'wiloke' ) 				=> 'fadeInLeft',
				esc_html__( 'Fade InLeft Big', 'wiloke' ) 			=> 'fadeInLeftBig',
				esc_html__( 'Fade InRight', 'wiloke' ) 			=> 'fadeInRight',
				esc_html__( 'Fade InRight Big', 'wiloke' ) 			=> 'fadeInRightBig',
				esc_html__( 'Fade InUp', 'wiloke' ) 				=> 'fadeInUp',
				esc_html__( 'Fade InUp Big', 'wiloke' ) 			=> 'fadeInUpBig',
				esc_html__( 'Fade Out', 'wiloke' ) 					=> 'fadeOut',
				esc_html__( 'Fade OutDown', 'wiloke' ) 			=> 'fadeOutDown',
				esc_html__( 'Fade OutDown Big', 'wiloke' ) 			=> 'fadeOutDownBig',
				esc_html__( 'Fade OutLeft', 'wiloke' ) 			=> 'fadeOutLeft',
				esc_html__( 'Fade OutLeft Big', 'wiloke' ) 			=> 'fadeOutLeftBig',
				esc_html__( 'Fade OutRight', 'wiloke' ) 			=> 'fadeOutRight',
				esc_html__( 'Fade OutRight Big', 'wiloke' ) 		=> 'fadeOutRightBig',
				esc_html__( 'Fade OutUp', 'wiloke' ) 				=> 'fadeOutUp',
				esc_html__( 'Fade OutUp Big', 'wiloke' ) 			=> 'fadeOutUpBig',
				esc_html__( 'Flip', 'wiloke' ) 						=> 'flip',
				esc_html__( 'Flip InX', 'wiloke' ) 					=> 'flipInX',
				esc_html__( 'Flip InY', 'wiloke' ) 					=> 'flipInY',
				esc_html__( 'Flip OutX', 'wiloke' ) 				=> 'flipOutX',
				esc_html__( 'Flip OutY', 'wiloke' ) 				=> 'flipOutY',
				esc_html__( 'Light Speed In', 'wiloke' ) 			=> 'lightSpeedIn',
				esc_html__( 'Light Speed Out', 'wiloke' ) 			=> 'lightSpeedOut',
				esc_html__( 'Rotate In', 'wiloke' ) 				=> 'rotateIn',
				esc_html__( 'Rotate InDown Left', 'wiloke' ) 		=> 'rotateInDownLeft',
				esc_html__( 'Rotate InDown Right', 'wiloke' ) 		=> 'rotateInDownRight',
				esc_html__( 'Rotate InUp Left', 'wiloke' ) 			=> 'rotateInUpLeft',
				esc_html__( 'Rotate InUp Right', 'wiloke' ) 		=> 'rotateInUpRight',
				esc_html__( 'Rotate Out', 'wiloke' ) 				=> 'rotateOut',
				esc_html__( 'Rotate OutDown Left', 'wiloke' ) 		=> 'rotateOutDownLeft',
				esc_html__( 'Rotate OutDown Right', 'wiloke' ) 		=> 'rotateOutDownRight',
				esc_html__( 'Rotate OutUp Left', 'wiloke' ) 		=> 'rotateOutUpLeft',
				esc_html__( 'Rotate OutUp Right', 'wiloke' ) 		=> 'rotateOutUpRight',
				esc_html__( 'Slide InUp', 'wiloke' ) 				=> 'slideInUp',
				esc_html__( 'Slide InDown', 'wiloke' ) 				=> 'slideInDown',
				esc_html__( 'Slide InLeft', 'wiloke' ) 				=> 'slideInLeft',
				esc_html__( 'Slide InRight', 'wiloke' ) 			=> 'slideInRight',
				esc_html__( 'Slide OutUp', 'wiloke' ) 				=> 'slideOutUp',
				esc_html__( 'Slide OutDown', 'wiloke' ) 			=> 'slideOutDown',
				esc_html__( 'Slide OutLeft', 'wiloke' ) 			=> 'slideOutLeft',
				esc_html__( 'Slide OutRight', 'wiloke' ) 			=> 'slideOutRight',
				esc_html__( 'Zoom In', 'wiloke' ) 					=> 'zoomIn',
				esc_html__( 'Zoom InDown', 'wiloke' ) 				=> 'zoomInDown',
				esc_html__( 'Zoom InLeft', 'wiloke' ) 				=> 'zoomInLeft',
				esc_html__( 'Zoom InRight', 'wiloke' ) 				=> 'zoomInRight',
				esc_html__( 'Zoom Out', 'wiloke' ) 					=> 'zoomOut',
				esc_html__( 'Zoom OutDown', 'wiloke' ) 				=> 'zoomOutDown',
				esc_html__( 'Zoom OutLeft', 'wiloke' ) 				=> 'zoomOutLeft',
				esc_html__( 'Zoom OutRight', 'wiloke' ) 			=> 'zoomOutRight',
				esc_html__( 'Zoom OutUp', 'wiloke' ) 				=> 'zoomOutUp',
				esc_html__( 'Hinge', 'wiloke' ) 					=> 'hinge',
				esc_html__( 'Roll In', 'wiloke' ) 					=> 'rollIn',
				esc_html__( 'Roll Out', 'wiloke' ) 					=> 'rollOut',
			);
		}

		//REGISTER PORTFOLIO
		public function roark_register() {

			// Register post type portfolio
			$labels = array(
				'name' => esc_html__('Portfolio', 'roark'),
				'singular_name' => esc_html__('Portfolio', 'roark'),
				'all_items' => esc_html__('All Portfolio', 'roark'),
				'add_new' => esc_html__('Add Portfolio', 'roark'),
				'add_new_item' => esc_html__('Add Portfolio', 'roark'),
				'edit_item' => esc_html__('Edit Portfolio', 'roark'),
				'new_item' => esc_html__('New Portfolio', 'roark'),
				'view_item' => esc_html__('View Portfolio', 'roark'),
				'search_items' => esc_html__('Search Portfolio', 'roark'),
				'not_found' =>  esc_html__('No Portfolio found', 'roark'),
				'not_found_in_trash' => esc_html__('No Portfolio found in Trash', 'roark'),
				'parent_item_colon' => ''
			);

			$portfolioLink = get_option('wiloke_portfolio_permalink');

			if ( $portfolioLink == 'category-portfolio' )
			{
				$portfolioLink = '%portfolio-category%';
			}elseif ($portfolioLink == 'without-posttype'){
				$portfolioLink = '%portfolio-postname%';
			}else{
				$portfolioLink = 'portfolio';
			}

	      	$args = array(
		        'labels' => $labels,
		        'public' => true,
		        'publicly_queryable' => true,
		        'show_ui' => true,
		        'query_var' => true,
		        'rewrite' => array('with_front'=>false, 'slug'=>$portfolioLink),
		        'has_archive' => true,
		        'capability_type' => 'post',
		        'show_in_nav_menus' => false,
		        'hierarchical' => true,
		        'exclude_from_search' => true,
		        'menu_position' => 21,
		        'menu_icon' => 'dashicons-portfolio',
		        'supports' => array('title','editor','thumbnail', 'page-attributes', 'author')
	      	);

	      	register_post_type('portfolio', $args);

	      	$labels = array(
		        'name' => 'Categories',
		        'singular' => 'Categories',
		        'menu_name' => 'Categories'
	      	);

	      	$args_taxonomy = array(
		        'labels'                     => $labels,
		        'hierarchical'               => true,
		        'public'                     => true,
		        'show_ui'                    => true,
		        'show_admin_column'          => true,
		        'show_in_nav_menus'          => false,
		        'show_tagcloud'              => false,
	      	);

	      	register_taxonomy('category-portfolio', 'portfolio', $args_taxonomy);
	    }

	    public function roark_parse_request($query) {

		 	if ( !$query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
		        return;
		    }

		    $aPostTypes = get_post_types();

		    if ( ! empty( $query->query['name'] ) ) {
		        $query->set( 'post_type', $aPostTypes );
		    }
	  	}

	  	public function roark_remove_portfolio_slug($url, $post) {

	  		if ( 'portfolio' != $post->post_type || 'publish' != $post->post_status ) {
		        return $url;
		    }

			$portfolioLink = get_option('wiloke_portfolio_permalink');

			if ( $portfolioLink == 'category-portfolio' ) {
				$pattern = '%portfolio-category%';
			} elseif ($portfolioLink == 'without-posttype') {
				$pattern = '%portfolio-postname%';
			}

			if ( isset($pattern) ) {
				$url = str_replace( '/'.$pattern.'/', '/', $url );
			}
		    
		    return $url;
	  	}

	  	protected function check_gif($size) {

	  		$id = get_post_thumbnail_id();

	  		$url = wp_get_attachment_url($id);

		    $filetype = wp_check_filetype($url);

		    if( $filetype['ext'] == 'gif' ) {
		    	return 'full';
		    	the_post_thumbnail('full', array('class' => 'img-responsive')); 
		    } else {
		    	return $size;
		    }
	  	}

	  	protected function filter( $category = '', $parentid ) { 
			if( isset($category) && !empty($category) ) {
				$args = array(
					'hide_empty' => true, 
					'parent' => 0,
					'include'	=> array_map('intval', explode(',', $category))
				);

	  			$terms = get_terms('category-portfolio', $args); 

	  			ob_start();

				if ($terms) : ?>
					
					<div class="portfolio-filter mb-40">

						<div class="toggle-filter"><span></span></div>

				    	<ul class="ul-filter">
			    			<li class="active"><a href="#" data-filter="*" data-show-button="1" class="all">All</a></li>
				  			<?php foreach ($terms  as $term ) : ?>
			  					<li><a href="#" title="<?php echo esc_attr($term->name) ?>" data-filter=".roark_portfolio_category_<?php echo esc_attr($term->term_id); ?>" data-id="<?php echo esc_attr($term->term_id); ?>" data-post="<?php echo esc_attr($term->count); ?>" ><?php echo esc_html($term->name); ?></a></li>
							<?php endforeach; ?>

						</ul>
					</div>

		  		<?php endif;

		  		$output = ob_get_clean();
		  		echo $output;
	  		}

	  	}

		public function ajaxLoadmore() {
			
			if( isset($_GET['param'] )) {

		      	$args = stripslashes(html_entity_decode( $_GET['param']) );
		      	$args = json_decode($args, true);
		      	$args['style'] = isset($args['style']) ? $args['style'] : 'style1';
		      	$args['post_number'] = isset($args['post_number']) ? $args['post_number'] : 8;
		      	$args['order'] = isset($args['order']) ? $args['order'] : 'DESC';
		      	$args['orderby'] = isset($args['orderby']) ? $args['orderby'] : 'date';
		      	$args['post__not_in'] = isset($args['post__not_in']) ? $args['post__not_in'] : '';
		      	$args['category_in'] = isset($args['category_in']) ? $args['category_in'] : array();
		      	if( isset($args['category_filter']) ) { $args['category_in'] = $args['category_filter']; }

				ob_start();

				$this->loop($args);
				$result['content'] = ob_get_clean();

				echo json_encode($result);
				wp_die();
			}
		}

		protected function loop( $args= array(), $query=null ) {

			if(isset($args['category_in']) && !empty($args['category_in'])) {
				$args['category_in'] =  array_map('intval', explode(',', $args['category_in']) );
			} else {
				return;
			}

			$query_args = array(
				'post_type' 			=> 'portfolio',
				'post_status' 			=> 'publish',
				'posts_per_page' 		=> $args['post_number'],
				'ignore_sticky_posts'	=> 1,
				'order'					=> $args['order'],
				'orderby'				=> $args['orderby'],
				'tax_query'				=> array(
					array(
	  					'taxonomy' 	=> 'category-portfolio',
	  					'field' 	=> 'term_id', 
	  					'terms' 	=> $args['category_in']
  					)
				)
	  		);

			if( isset($args['post__not_in']) && !empty($args['post__not_in']) ) {
				$query_args['post__not_in'] = array_map('intval', explode(',', $args['post__not_in']));
			}

			if ( empty($query) )
			{
	  			$query = new WP_Query($query_args);
	  		}
	  				
	  		$attr = array( 
	  			'style' => $args['style'], 
	  			'caption_pos' => $args['caption_pos'], 
	  			'category_pos' => $args['category_pos'], 
	  			'animation' => $args['animation']  
  			);

	  		if( $query->have_posts() ) {
	  			$index = 0;
		  		while ($query->have_posts()) : $query->the_post();
		  			$attr['index'] = $index;
		  			$this->content($attr);
		  			$index++;
		  		endwhile;
			}

			wp_reset_postdata(); 
		}

		protected function content($args = array()) {

			global $post;

			$wow = $args['animation'] != 'none' ? 'wow ' . $args['animation'] : '';

			$category = $this->get_category($post->ID, 'category-portfolio');

			$slug = isset($category['term_id']) ? 'roark_portfolio_category_' . implode(' roark_portfolio_category_', $category['term_id']) : '';

			$name = isset($category['name']) ? implode(', ', $category['name']) : '';

			$class = $this->index_class($args['index']);

			$delay = absint($args['index']) * 0.15;

			if( $args['style'] != 'style1' ) { $class = ''; }

			ob_start(); ?>

			<div class="grid-item <?php echo esc_attr($slug); ?> <?php echo $class; ?>" data-id="<?php the_ID(); ?>">

			    <div class="portfolio-item <?php echo esc_attr($wow) ?>" data-wow-delay="<?php echo esc_attr($delay) ?>s">

			        <a href="<?php the_permalink() ?>">

						<?php if($args['caption_pos'] == 'caption-top') : ?>

				            <div class="caption">

				                <div class="tb">

				                    <div class="tb-cell">

		                        		<?php if($args['category_pos'] == 'bottom') : ?>

			                        		<h2><?php the_title(); ?></h2>
			                        		<span class="hr"></span>
			                        		<span class="cat"><?php echo esc_html($name); ?></span>

		                        		<?php else : ?>

		                        			<span class="cat"><?php echo esc_html($name); ?></span>
			                        		<span class="hr"></span>
			                        		<h2><?php the_title(); ?></h2>

		                        		<?php endif; ?>

		                        		<?php if($args['caption_pos'] != 'caption-middle') : ?>
						        			<span class="arrow"><i class="fa fa-angle-right"></i></span>
						        		<?php endif; ?>
				                    </div>

				                </div>

				            </div>

						<?php endif; ?>

			            <div class="img">
	
			            	<?php 

			            		if( has_post_thumbnail() ) :

				            		$size = $this->check_gif('large'); ?>

									<div class="wil-imageCover" style="background-image: url(<?php the_post_thumbnail_url($size); ?>)">
										<img src="<?php the_post_thumbnail_url($size); ?>" alt="<?php the_title(); ?>">
									</div>

							<?php endif; ?>
			                
			            </div>

						<?php if($args['caption_pos'] != 'caption-top') : ?>

				            <div class="caption">
				                <div class="tb">
				                    <div class="tb-cell">
				                    	<?php if($args['category_pos'] == 'bottom') : ?>
			                        		<h2><?php the_title(); ?></h2>
			                        		<span class="hr"></span>
			                        		<span class="cat"><?php echo esc_html($name); ?></span>
		                        		<?php else : ?>
		                        			<span class="cat"><?php echo esc_html($name); ?></span>
			                        		<span class="hr"></span>
			                        		<h2><?php the_title(); ?></h2>
		                        		<?php endif; ?>

						        		<?php if($args['caption_pos'] != 'caption-middle') : ?>
						        			<span class="arrow"><i class="fa fa-angle-right"></i></span>
						        		<?php endif; ?>
				                    </div>
				                </div>
				            </div>
				            
						<?php endif; ?>
			        </a>
			    </div>
			</div>

			<?php $output = ob_get_clean();

			echo $output;
		}

		protected function index_class($index) {
			$class = '';
			switch ($index) {
				case 0:
				case 6:
					$class = 'squaresx2';
					break;
				case 3:
					$class = 'rec-hor';
					break;
				case 4: 
					$class = 'rec-ver';
					break;
			}

			return $class;
		}

		protected function get_category($post_id, $type) {
			$terms = get_the_terms( $post_id, $type );
			$att =  array(
				'name'	=> array(),
				'slug'	=> array()
			);

		    if ( $terms && !is_wp_error( $terms ) ) {
		        foreach ( $terms as $term ) {
	        		$att['name'][].= $term->name; 
	        		$att['slug'][]= $term->slug;
	        		$att['term_id'][]= $term->term_id;
		        }
		    }

		    return $att;
		}

	  	protected function roark_terms() {
	  		$list = array();
	  		$terms = get_terms('category-portfolio', 'hide_empty=true');

	  		if( !is_wp_error($terms) ) {
	  			foreach ($terms as $term) {
	  				$list[$term->name] = $term->term_id;
	  			}
	  		}

	  		return $list;
	  	}

    /* ShortCode */

		// BANNER
		public function vc_map_shortcode_banner() {
			vc_map( array(
				'name'			=> esc_html__('Rose Banner', 'roark'),
				'base'			=> 'roark_shortcode_banner',
				'category'		=> esc_html__('Roark', 'roark'),
				'description'	=> '',
				'params'		=> array(

					array(
						'type'			=> 'attach_image',
						'heading'		=> esc_html__('Background Image', 'roark'),
						'param_name'	=> 'bg_img',
						'value'			=> '',
						'description'	=> esc_html__('Get image form media.', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title', 'roark'),
						'param_name'	=> 'title',
						'value'			=> '',
						'description'	=> esc_html__('Insert text title.', 'roark')
					),

					array(
						'type'			=> 'textarea',
						'heading'		=> esc_html__('Description', 'roark'),
						'param_name'	=> 'description',
						'value'			=> '',
						'description'	=> esc_html__('Insert text description.', 'roark')
					),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Text Align', 'roark'),
						'param_name'	=> 'align',
						'std'			=> 'text-left',
						'value'			=> array(
							esc_html__( 'Text Left', 'roark' ) => 'text-left',
							esc_html__( 'Text Center', 'roark' ) => 'text-center',
							esc_html__( 'Text Right', 'roark' ) => 'text-right',
						),
						'description'	=> esc_html__('Set alignment for all text this banner', 'roark')
					),

					array(
						'type' 				=> 'textfield',
						'heading' 			=> esc_html__( 'Extra class name', 'roark' ),
						'param_name' 		=> 'class',
						'description' 		=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'roark' ),
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Height', 'roark'),
						'param_name'	=> 'height',
						'std'			=> '',
						'value'			=> '',
						'description'	=> esc_html__('Set height for all text this banner. Default 300px.', 'roark'),
						'group'			=> esc_html__('Advance','roark')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Background overlay', 'roark'),
						'param_name'	=> 'bg_overlay',
						'value'			=> '',
						'description'	=> esc_html__('Controls the background color overlay. Leave blank for theme option selection.', 'roark'),
						'group'				=> esc_html__('Advance', 'roark' )
					),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Parallax', 'roark'),
						'param_name'	=> 'parallax',
						'std'			=> 'bg-scroll',
						'value'			=> array(
							esc_html__( 'Background Scroll', 'roark' ) => 'bg-scroll',
							esc_html__( 'Background Fixed', 'roark' ) => 'bg-fixed',
							esc_html__( 'Background Parallax', 'roark' ) => 'bg-parallax',
						),
						'description'	=> esc_html__('Set background parallax.', 'roark'),
						'group'				=> esc_html__('Advance', 'roark' )
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Title Color', 'roark'),
						'param_name'	=> 'color_title',
						'value'			=> '',
						'description'	=> esc_html__('Controls the title color. Leave blank for theme option selection.', 'roark'),
						'group'				=> esc_html__('Advance', 'roark' )
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title Size', 'roark'),
						'param_name'	=> 'font_title',
						'value'			=> '',
						'description'	=> esc_html__('Controls the title size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance','roark')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Description color', 'roark'),
						'param_name'	=> 'color_description',
						'value'			=> '',
						'description'	=> esc_html__('Controls the description color. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance','roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Description Size', 'roark'),
						'param_name'	=> 'font_description',
						'value'			=> '',
						'description'	=> esc_html__('Controls the description size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance','roark')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Line color', 'roark'),
						'param_name'	=> 'color_line',
						'value'			=> '',
						'description'	=> esc_html__('Controls the line color. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance','roark')
					),

					// Design Options
					array(
						'type' 			=> 'css_editor',
						'heading' 		=> esc_html__( 'CSS box', 'roark' ),
						'param_name' 	=> 'css',
						'group' 		=> esc_html__( 'Design Options', 'roark' ),
					),
				)
			));
		}

		public function render_shortcode_banner( $attr, $content = '' ) {

			extract(shortcode_atts( array(
				'title' 				=> '',
				'description'			=> '',
				'align'					=> 'text-left',
				'bg_img'				=> '',
				'bg_overlay'			=> '',
				'bg_position'			=> 'bg-center',
				'parallax'				=> 'bg-scroll',
				'height'				=> '',
				'font_description'		=> '',
				'color_description'		=> '',
				'color_title'			=> '',
				'font_title'			=> '',
				'color_line'			=> '',
				'class'					=> '',
				'css'					=> ''
			), $attr ));

			$class .= ' ' . $align . ' ' . $bg_position . ' '. $parallax . ' ' . vc_shortcode_custom_css_class($css);
			$wrap_css = $this->merge_css( array( 'background-image'=> $this->get_attachment_image_src($bg_img, 'large') ) );
		 	$title_css = $this->merge_css( array( 'font-size'=> $font_title, 'color'=> $color_title) );
		 	$line_css = $this->merge_css( array( 'background'=> $color_line) );
		 	$description_css = $this->merge_css( array( 'font-size'=> $font_description, 'color'=> $color_description) );
		 	$tb_css = $this->merge_css( array( 'height'=> $height) );
		 	$overlay_css = $this->merge_css( array( 'background-color'=> $bg_overlay) ); 

			ob_start(); ?>

			<div class="page-header <?php echo esc_attr($class) ?>" style="<?php print $wrap_css ?>">

				<?php if ( !empty($overlay_css) ) : ?>
					<div class="overlay" style="<?php print $overlay_css ?>"></div>
				<?php endif ?>

				<div class="tb" style="<?php print $tb_css; ?>">

					<div class="tb-cell ver-middle">

						<?php if( !empty($title) ) : ?>
							<h1 class="h2 page-title" style="<?php print $title_css; ?>" ><?php echo esc_html($title); ?></h1>
						<?php endif; ?>

						<?php if( !empty($description) ) : ?>
							<p style="<?php print $description_css ?>"><?php echo wp_kses($description, array('br' => array()), null); ?></p>
						<?php endif; ?>

						<span class="divider" style="<?php print $line_css; ?>"></span>

					</div>
				</div>
			</div>

			<?php $output = ob_get_clean();

			return $output;
		}

		// ICON BOX
		public function vc_map_shortcode_iconbox() {

			vc_map( array(
				'name'			=> esc_html__('Rose Box Icon', 'roark'),
				'base'			=> 'roark_shortcode_iconbox',
				'category'		=> esc_html__('Roark', 'roark'),
				'description'	=> '',
				'params'		=> array(

					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'roark' ),
						'param_name' => 'icon',
						'value' => '',
						'settings' => array(
								'emptyIcon' => false,
								'iconsPerPage' => 4000,
						),
						'description' => esc_html__( 'Select icon from library.', 'roark' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Icon Alignment', 'roark' ),
						'param_name' => 'align_icon',
						'std'	=> 'icon-top',
						'value' => array(
								esc_html__( 'Default', 'roark' ) => 'icon-standard',
								esc_html__( 'Icon Left', 'roark' ) => 'icon-left',
								esc_html__( 'Icon Right', 'roark' ) => 'icon-right',
								esc_html__( 'Icon Center', 'roark' ) => 'icon-center',
						),
						'description' => esc_html__( 'Select icon alignment.', 'roark' ),
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title', 'roark'),
						'param_name'	=> 'title',
						'value'			=> '',
						'description'	=> esc_html__('Insert title.', 'roark')
					),

					array(
						'type'			=> 'textarea',
						'heading'		=> esc_html__('Description', 'roark'),
						'param_name'	=> 'description',
						'value'			=> '',
						'description'	=> esc_html__('Insert description', 'roark')
					),

					array(
						'type' 				=> 'dropdown',
						'heading' 			=> esc_html__( 'Alignment Text', 'roark' ),
						'param_name' 		=> 'text_align',
						'std'				=> 'text-center',
						'value'				=> array(
							esc_html__('Text Left', 'roark')			=> 'text-left',
							esc_html__('Text Center', 'roark')			=> 'text-center',
							esc_html__('Text Right', 'roark')			=> 'text-right',
						),
						'save_always' 		=> true,
						'description' 		=> esc_html__( 'Choose alignment text of element.', 'roark' ),
					),

					array(
						'type' 				=> 'textfield',
						'heading' 			=> esc_html__( 'Extra class name', 'roark' ),
						'param_name' 		=> 'class',
						'description' 		=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'roark' ),
					),

					// Advance
					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Icon Color', 'roark'),
						'param_name'	=> 'color_icon',
						'value'			=> '',
						'description'	=> esc_html__('Controls the icon color. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Icon Background Color', 'roark'),
						'param_name'	=> 'bg_icon',
						'value'			=> '',
						'description'	=> esc_html__('Controls the icon background color. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Icon Size', 'roark'),
						'param_name'	=> 'size_icon',
						'value'			=> '',
						'description'	=> esc_html__('Controls the icon size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Title Color', 'roark'),
						'param_name'	=> 'color_title',
						'value'			=> '',
						'description'	=> esc_html__('Controls the title color. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title Size', 'roark'),
						'param_name'	=> 'size_title',
						'value'			=> '',
						'description'	=> esc_html__('Controls the name size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Description Color', 'roark'),
						'param_name'	=> 'color_description',
						'value'			=> '',
						'description'	=> esc_html__('Controls the description color. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Description Size', 'roark'),
						'param_name'	=> 'size_description',
						'value'			=> '',
						'description'	=> esc_html__('Controls the description size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					// Design Options
					array(
						'type' 			=> 'css_editor',
						'heading' 		=> esc_html__( 'CSS box', 'roark' ),
						'param_name' 	=> 'css',
						'group' 		=> esc_html__( 'Design Options', 'roark' ),
					),
				)
			));
		}

		public function render_shortcode_iconbox( $attr, $content = '' ) {

			extract(shortcode_atts( array(
				'icon' 				=> '',
				'title' 			=> '',
				'description'		=> '',
				'align_icon'		=> '',
				'text_align'		=> 'text-left',
				'color_icon'		=> '',
				'bg_icon'			=> '',
				'size_icon'			=> '',
				'color_title'		=> '',
				'size_title'		=> '',
				'color_description'	=> '',
				'size_description'	=> '',
				'class'				=> '',
				'css'				=> '',
			), $attr ));

			$class .= ' ' . $text_align . ' ' . $align_icon . ' ' . vc_shortcode_custom_css_class($css);
			$icon_css = $this->merge_css( array( 'font-size'=> $size_icon, 'color'=> $color_icon, 'background' => $bg_icon) );
		 	$title_css = $this->merge_css( array( 'font-size'=> $size_title, 'color'=> $color_title) );
		 	$description_css = $this->merge_css( array( 'font-size'=> $size_description, 'color'=> $color_description) );

			ob_start(); ?>


			<div class="icon-box <?php echo esc_attr($class); ?>" >

				<?php if( !empty($icon) ) : ?>
					<span class="icon" style="<?php print $icon_css ?>"><i class="<?php echo esc_attr($icon) ?>"></i></span>
				<?php endif; ?>

				<?php if( !empty($title) ) : ?>
					<h4 class="h6" style="<?php print $title_css ?>"><?php echo esc_html($title) ?></h4>
				<?php endif; ?>

				<?php if( !empty($description) ) : ?>
					<p style="<?php print $description_css ?>">
						<?php echo wp_kses($description, array( 'br' => array(), 'em' => array(), 'strong' => array() ) ) ?>
					</p>
				<?php endif; ?>

			</div>

			<?php $output = ob_get_clean();

			return $output;
		}

		// CLIENT
		public function vc_map_shortcode_client() {
			vc_map( array(
				'name'			=> esc_html__('Rose Client Carousel', 'roark'),
				'base'			=> 'roark_shortcode_client',
				'category'		=> esc_html__('Roark', 'roark'),
				'params'		=> array(

					array(
						'type' => 'param_group',
						'heading'	=> esc_html__('Item', 'roark'),
						'param_name'	=> 'values',
						'params'	=> array(
							array(
								'type'			=> 'attach_image',
								'heading'		=>	esc_html__('Image', 'roark'),
								'param_name'		=> 'img'
							),

							array(
								'type' 			=> 'textfield',
								'heading'		=> esc_html__('Link', 'roark'),
								'param_name'	=> 'link'
							)
						)
					),

					array(
						'type' 			=> 'dropdown',
						'heading'		=> esc_html__('Target', 'roark'),
						'param_name'	=> 'target',
						'std'			=> '_blank',
						'value'			=> array(
							esc_html__('New Window', 'roark')		=> '_blank',
							esc_html__('Open in window', 'roark')	=> '_self',
						)
					),

					array(
						'type' 				=> 'textfield',
						'heading' 			=> esc_html__( 'Extra class name', 'roark' ),
						'param_name' 		=> 'class',
						'description' 		=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'roark' ),
					),

					// Design Options
					array(
						'type' 			=> 'css_editor',
						'heading' 		=> esc_html__( 'CSS box', 'roark' ),
						'param_name' 	=> 'css',
						'group' 		=> esc_html__( 'Design Options', 'roark' ),
						'description' 		=> esc_html__( 'Insert your custom Facebook link.', 'roark' ),
					),
				)
			));
		}

		public function render_shortcode_client($attr, $content = '') {

			extract(shortcode_atts( array(
					'values' 		=> '',
					'target'		=> '_blank',
					'class'			=> '',
					'css'			=> ''
			), $attr ));

			$class .= ' ' . vc_shortcode_custom_css_class($css);

			ob_start();

			if(!empty( $values)  ) : ?>

				<?php $clients = json_decode( urldecode( $values ), true ); ?>
				
				<div class="client <?php echo esc_attr($class); ?>">

					<?php foreach ($clients as $client) : ?>

						<?php
						$attachment_id = $client['img'];
						$attachment = wp_get_attachment_image_src( $attachment_id, array(255, 180));
						$link = isset($client['link']) ? $client['link'] : '';
						?>

						<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
							<img src="<?php echo esc_url($attachment[0]); ?>" alt="">
						</a>

					<?php endforeach; ?>

				</div>

			<?php endif;

			$output = ob_get_clean();

			return $output;
		}

		// TITLE
		public function vc_map_shortcode_title() {

			vc_map( array(
				'name'			=> esc_html__('Rose Title', 'roark'),
				'base'			=> 'roark_shortcode_title',
				'category'		=> esc_html__('Roark', 'roark'),
				'description'	=> '',
				'params'		=> array(

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title', 'roark'),
						'param_name'	=> 'title',
						'value'			=> '',
						'description'	=> esc_html__('Insert the title.', 'roark')
					),

					array(
						'type'			=> 'textarea',
						'heading'		=> esc_html__('Description', 'roark'),
						'param_name'	=> 'description',
						'value'			=> '',
						'description'	=> esc_html__('Insert the description.', 'roark')
					),

					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Text Align', 'roark'),
						'param_name'	=> 'text_align',
						'std'			=> 'text-center',
						'value'			=> array(
								esc_html__( 'Text Left', 'roark' ) => 'text-left',
								esc_html__( 'Text Center', 'roark' ) => 'text-center',
								esc_html__( 'Text Right', 'roark' ) => 'text-right',
						),
						'description'	=> esc_html__('Set alignment for all text.', 'roark')
					),

					array(
						'type' 				=> 'textfield',
						'heading' 			=> esc_html__( 'Extra class name', 'roark' ),
						'param_name' 		=> 'class',
						'description' 		=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'roark' ),
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Heading Color', 'roark'),
						'param_name'	=> 'title_color',
						'value'			=> '',
						'description'	=> esc_html__('Controls the heading color. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Heading Size', 'roark'),
						'param_name'	=> 'title_size',
						'value'			=> '',
						'description'	=> esc_html__('Controls the heading size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Line Color', 'roark'),
						'param_name'	=> 'line_color',
						'value'			=> '',
						'description'	=> esc_html__('Controls the line color. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Description Color', 'roark'),
						'param_name'	=> 'description_color',
						'value'			=> '',
						'description'	=> esc_html__('Controls the description color. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Description Size', 'roark'),
						'param_name'	=> 'description_size',
						'value'			=> '',
						'description'	=> esc_html__('Controls the description size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					// Design Options
					array(
						'type' 			=> 'css_editor',
						'heading' 		=> esc_html__( 'CSS box', 'roark' ),
						'param_name' 	=> 'css',
						'group' 		=> esc_html__( 'Design Options', 'roark' ),
					),
				)
			));
		}

		public function render_shortcode_title( $attr, $content = '' ) {

			extract(shortcode_atts( array(
					'title' 				=> '',
					'description'			=> '',
					'text_align'			=> 'text-center',
					'title_color'			=> '',
					'title_size'			=> '',
					'line_color'			=> '',
					'description_color'		=> '',
					'description_size'		=> '',
					'class'					=> '',
					'css'					=> '',
			), $attr ));

			$class .= ' ' . $text_align . ' ' . vc_shortcode_custom_css_class($css);
		 	$title_css = $this->merge_css( array( 'font-size'=> $title_size, 'color'=> $title_color) );
		 	$line_css = $this->merge_css( array( 'background-color'=> $line_color) );
		 	$description_css = $this->merge_css( array( 'font-size'=> $description_size, 'color'=> $description_color) );

			ob_start(); ?>

			<div class="heading <?php echo esc_attr($class); ?>">

				<?php if ( !empty($title) ): ?>
					<h2 class="h6" style="<?php print $title_css; ?>" ><?php echo esc_html($title); ?></h2>
				<?php endif ?>
				
				<span class="line" style="<?php print $line_css; ?>"></span>

				<?php if( !empty($description) ) : ?>

					<p style="<?php print  $description_css?>">
						<?php echo wp_kses($description, array( 'br' => array(), 'em' => array(), 'strong' => array() ) ) ?>
					</p>

				<?php endif; ?>

			</div>

			<?php $output = ob_get_clean();

			return $output;
		}

		// GOOGLE MAP
		public function vc_map_shortcode_google() {

			vc_map( array(
				'name'			=> esc_html__('Rose Google Map', 'roark'),
				'base'			=> 'roark_shortcode_google',
				'category'		=> esc_html__('Roark', 'roark'),
				'description'	=> '',
				'params'		=> array(

					array(
						'type'			=> 'attach_image',
						'heading'		=> esc_html__('Icon Map', 'roark'),
						'param_name'	=> 'icon',
						'value'			=> '',
						'description'	=> esc_html__('Set icon location address', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title', 'roark'),
						'param_name'	=> 'title',
						'value'			=> '',
						'description'	=> esc_html__('Name location address.', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Latitude', 'roark'),
						'param_name'	=> 'lat',
						'value'			=> '',
							'description'	=> wp_kses_post('Latitude google map. <a hret="http://www.latlong.net/" target="_blank">Find My Lat&Long</a>')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Longitude', 'roark'),
						'param_name'	=> 'long',
						'value'			=> '',
						'description'	=> wp_kses_post('Longitude google map. <a hret="http://www.latlong.net/" target="_blank">Find My Lat&Long</a>')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Height', 'roark'),
						'param_name'	=> 'height',
						'value'			=> '',
						'description'	=> esc_html__('Set height google map.', 'roark')
					),

					array(
						'type' 				=> 'textfield',
						'heading' 			=> esc_html__( 'Extra class name', 'roark' ),
						'param_name' 		=> 'class',
						'description' 		=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'roark' ),
					),

					// Design Options
					array(
						'type' 			=> 'css_editor',
						'heading' 		=> esc_html__( 'CSS box', 'roark' ),
						'param_name' 	=> 'css',
						'group' 		=> esc_html__( 'Design Options', 'roark' ),
						'description' 		=> esc_html__( 'Insert your custom Facebook link.', 'roark' ),
					),
				)
			));
		}
		
		public function render_shortcode_google( $attr, $content = '' ) {

			extract(shortcode_atts( array(
				'icon'					=> '',
				'title'					=> '',
				'lat'					=> '',
				'long'					=> '',
				'height'				=> '400px',
				'class'					=> '',
				'css'					=> ''
			), $attr ));

			if( !empty($icon) ) {

				$icon = wp_get_attachment_image_src($icon);

				if( isset($icon) && !empty($icon)) {
					$icon = $icon[0];
				}
			}

			$class .= ' ' . vc_shortcode_custom_css_class($css);
			$wrap_css = $this->merge_css(array('height'=> $height));

			ob_start(); 

			if( !empty($lat) && !empty($long) ) : ?>
				<div class="contact-map <?php echo esc_attr($class); ?>" style="<?php print $wrap_css ?>">
					<div class="map" data-latlng="[<?php echo esc_attr($lat) ?>, <?php echo esc_attr($long) ?>]" data-title="<?php echo esc_attr($title); ?>" data-icon="<?php echo esc_url($icon); ?>"></div>
				</div>
			<?php endif;

			$output = ob_get_clean();

			return $output;
		}

		// TWITTER
		public function vc_map_shortcode_twitter() {
			vc_map( array(
				'name'			=> esc_html__('Rose Twitter', 'roark'),
				'base'			=> 'roark_shortcode_twitter',
				'category'		=> esc_html__('Roark', 'roark'),
				'description'	=> '',
				'params'		=> array(

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Username', 'roark'),
						'param_name'	=> 'username',
						'value'			=> 'wilokethemes',
						'std'			=> 'wilokethemes',
						'description'	=> esc_html__('Your twitter username.', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Limit', 'roark'),
						'param_name'	=> 'limit',
						'value'			=> 3,
						'std'			=> 3,
						'description'	=> esc_html__('Number of tweets will be showed.', 'roark')
					),

					array(
						'type' 				=> 'textfield',
						'heading' 			=> esc_html__( 'Extra class name', 'roark' ),
						'param_name' 		=> 'class',
						'description' 		=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'roark' ),
					),

					// Design Options
					array(
						'type' 			=> 'css_editor',
						'heading' 		=> esc_html__( 'CSS box', 'roark' ),
						'param_name' 	=> 'css',
						'group' 		=> esc_html__( 'Design Options', 'roark' ),
						'description' 		=> esc_html__( 'Insert your custom Facebook link.', 'roark' ),
					),
				)
			));
		}

		public function render_shortcode_twitter($attr, $content = '') {
			global $roark_option;

			extract(shortcode_atts( array(
				'username'		=> 'wilokethemes',
				'limit'			=> 3,
				'class'			=> '',
				'css'			=> ''
			), $attr ));

			ob_start();

			if ( empty($roark_option['consumer_key']) || empty($roark_option['consumer_secret']) || empty($roark_option['access_token_secret']) || empty($roark_option['access_token']) ) {

				_e('You haven\'t configured your twitter api', 'roark');

			} else {

				require_once plugin_dir_path(__FILE__).'twitter/twitteroauth.php';

				$initTWitter = new TwitterOAuth($roark_option['consumer_key'], $roark_option['consumer_secret'], $roark_option['access_token'], $roark_option['access_token_secret'], $roark_option['cache_interval']);
				$initTWitter->ssl_verifypeer = true;

				$limit  = !empty($limit) ? absint($limit) : 3;
				$tweets = $initTWitter->get('statuses/user_timeline', array('screen_name' => $username, 'include_rts' => 'false', 'count' => $limit));


				if ( !empty($tweets) ) {

					$tweets = json_decode($tweets);

					$class .= ' ' . vc_shortcode_custom_css_class($css);

					if( is_array($tweets) ) {

						echo '<div class="twitter-slide testimonial-slide text-center '. esc_attr($class) .'">';

						foreach($tweets as $control) {
							echo '<div class="testimonial-item">';
							echo '<i class="icon fa fa-twitter"></i>';
							$status =  preg_replace('/http:\/\/([^\s]+)/i', '<a href="http://$1" target="_blank">$1</a>', $control->text);
							print '<p>' . $status . '</p>';
							echo '</div>';
						}

						echo '</div>';
					}

				} else {
					_e('There isn\'t any tweet yet', 'roark');
				}
			}

			$output = ob_get_clean();

			return $output;
		}

		// SKILL
		public function vc_map_shortcode_skill() {
			vc_map( array(
				'name'			=> esc_html__('Rose Skill', 'roark'),
				'base'			=> 'roark_shortcode_skill',
				'category'		=> esc_html__('Roark', 'roark'),
				'description'	=> '',
				'params'		=> array(

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title', 'roark'),
						'param_name'	=> 'title',
						'value'			=> '',
						'description'	=> esc_html__('Skill name.', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Percent', 'roark'),
						'param_name'	=> 'percent',
						'description'	=> esc_html__('Example: 50', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Duration', 'roark'),
						'param_name'	=> 'duration',
						'description'	=> esc_html__('Example 2000', 'roark')
					),

					array(
						'type' 				=> 'textfield',
						'heading' 			=> esc_html__( 'Extra class name', 'roark' ),
						'param_name' 		=> 'class',
						'description' 		=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'roark' ),
					),

					// Advance
					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Title Color', 'roark'),
						'param_name'	=> 'color_title',
						'value'			=> '',
						'description'	=> esc_html__('Controls the title color. Leave blank for theme option selection.','roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title Size', 'roark'),
						'param_name'	=> 'size_title',
						'value'			=> '',
						'description'	=> esc_html__('Controls the title size. Enter the font size without px ex: 50px. Leave blank for theme option selection.','roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Background Processbar', 'roark'),
						'param_name'	=> 'bg',
						'value'			=> '',
						'description'	=> esc_html__('Controls the processbar background color. Leave blank for theme option selection.','roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Background Processbar Percent', 'roark'),
						'param_name'	=> 'bg_percent',
						'value'			=> '',
						'description'	=> esc_html__('Controls the processbar percent background color. Leave blank for theme option selection.','roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Processbar Size', 'roark'),
						'param_name'	=> 'processbar_size',
						'value'			=> '',
						'description'	=> esc_html__('Controls the title size. Enter the size without px ex: 50px. Leave blank for theme option selection.','roark'),
						'group'			=> esc_html__('Advance', 'roark')
					),

					// Design Options
					array(
						'type' 			=> 'css_editor',
						'heading' 		=> esc_html__( 'CSS box', 'roark' ),
						'param_name' 	=> 'css',
						'group' 		=> esc_html__( 'Design Options', 'roark' ),
						'description' 		=> esc_html__( 'Insert your custom Facebook link.', 'roark' ),
					),
				)
			));
		}

		public function render_shortcode_skill($attr, $content = '') {

			extract(shortcode_atts( array(
				'title'					=> '',
				'percent'				=> '',
				'color_title'			=> '',
				'size_title'			=> '',
				'bg'					=> '',
				'bg_percent'			=> '',
				'processbar_size'		=> '',
				'duration'				=> '',
				'class'					=> '',
				'css'					=> ''
			), $attr ));

			$class .= ' ' . vc_shortcode_custom_css_class($css);
		 	$title_css = $this->merge_css( array( 'font-size'=> $size_title, 'color'=> $color_title) );
		 	$processbar_css = $this->merge_css( array( 'background'=> $bg, 'height'=> $processbar_size ) );
		 	$percent_css = $this->merge_css( array( 'background'=> $bg_percent ) );

			ob_start(); ?>

			<div class="skill" data-duration="<?php echo esc_attr($duration) ?>" data-percent="<?php echo esc_attr($percent) ?>">
				<?php if( !empty($title) ) : ?>
					<h4 style="<?php print $title_css ?>"><?php echo esc_html($title) ?> <span class="percent"></span></h4>
				<?php endif; ?>
				<span class="processbar" style="<?php print $processbar_css ?>">
					<span class="processbar-percent" style="<?php print $percent_css; ?>"></span>
				</span>
			</div>

			<?php $output = ob_get_clean();

			return $output;
		}

		// TEAM
		public function vc_map_shortcode_team() {
			vc_map( array(
					'name'			=> esc_html__('Rose Team', 'roark'),
					'base'			=> 'roark_shortcode_team',
					'category'		=> esc_html__('Roark', 'roark'),
					'description'	=> '',
					'params'		=> array(

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Name', 'roark' ),
							'param_name' 		=> 'name',
							'admin_label'		=> true,
							'description' 		=> esc_html__( 'Insert the name of the person.', 'roark' ),
						),

						array(
							'type' 				=> 'attach_image',
							'heading' 			=> esc_html__( 'Avatar', 'roark' ),
							'param_name' 		=> 'avatar',
							'description' 		=> esc_html__( 'Upload a custom avatar image.', 'roark' ),
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Work', 'roark' ),
							'param_name' 		=> 'work',
							'admin_label'		=> true,
							'description' 		=> esc_html__( 'Insert the work of the person.', 'roark' ),
						),

						array(
							'type' 				=> 'dropdown',
							'heading' 			=> esc_html__( 'Alignment Text', 'roark' ),
							'param_name' 		=> 'text_align',
							'std'				=> 'text-center',
							'value'				=> array(
								esc_html__('Text Left', 'roark')			=> 'text-left',
								esc_html__('Text Center', 'roark')			=> 'text-center',
								esc_html__('Text Right', 'roark')			=> 'text-right',
							),
							'save_always' 		=> true,
							'description' 		=> esc_html__( 'Choose alignment text of element.', 'roark' ),
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Extra class name', 'roark' ),
							'param_name' 		=> 'class',
							'description' 		=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'roark' ),
						),

						// Social
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Facebook', 'roark' ),
							'param_name' 	=> 'facebook',
							'group' 		=> esc_html__( 'Social', 'roark' ),
							'description' 		=> esc_html__( 'Insert your custom Facebook link.', 'roark' ),
						),

						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Twitter', 'roark' ),
							'param_name' 	=> 'twitter',
							'group' 		=> esc_html__( 'Social', 'roark' ),
							'description' 		=> esc_html__( 'Insert your custom Twitter link.', 'roark' ),
						),

						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Google Plus', 'roark' ),
							'param_name' 	=> 'google_plus',
							'group' 		=> esc_html__( 'Social', 'roark' ),
							'description' 		=> esc_html__( 'Insert your custom Google link.', 'roark' ),
						),

						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Youtube', 'roark' ),
							'param_name' 	=> 'youtube',
							'group' 		=> esc_html__( 'Social', 'roark' ),
							'description' 		=> esc_html__( 'Insert your custom Youtube link.', 'roark' ),
						),

						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Linkedin', 'roark' ),
							'param_name' 	=> 'linkedin',
							'group' 		=> esc_html__( 'Social', 'roark' ),
							'description' 		=> esc_html__( 'Insert your custom Linkedin link.', 'roark' ),
						),

						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Dribbble', 'roark' ),
							'param_name' 	=> 'dribbble',
							'group' 		=> esc_html__( 'Social', 'roark' ),
							'description' 		=> esc_html__( 'Insert your custom Dribbble link.', 'roark' ),
						),

						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Instagram', 'roark' ),
							'param_name' 	=> 'instagram',
							'group' 		=> esc_html__( 'Social', 'roark' ),
							'description' 		=> esc_html__( 'Insert your custom Instagram link.', 'roark' ),
						),

						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Flickr', 'roark' ),
							'param_name' 	=> 'flickr',
							'group' 		=> esc_html__( 'Social', 'roark' ),
							'description' 		=> esc_html__( 'Insert your custom Flickr link.', 'roark' ),
						),

						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Pinterest', 'roark' ),
							'param_name' 	=> 'pinterest',
							'group' 		=> esc_html__( 'Social', 'roark' ),
							'description' 		=> esc_html__( 'Insert your custom Pinterest link.', 'roark' ),
						),

						// Advance
						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Name Color', 'roark' ),
							'param_name' 		=> 'name_color',
							'description' 		=> esc_html__( 'Controls the name color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Name Size', 'roark' ),
							'param_name' 		=> 'name_size',
							'description' 		=> esc_html__( 'Controls the name size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark')
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Work Color', 'roark' ),
							'param_name' 		=> 'work_color',
							'description' 		=> esc_html__( 'Controls the work color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Work Size', 'roark' ),
							'param_name' 		=> 'work_size',
							'description' 		=> esc_html__( 'Controls the work size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark')
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Social Color', 'roark' ),
							'param_name' 		=> 'social_color',
							'description' 		=> esc_html__( 'Controls the social color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Social Size', 'roark' ),
							'param_name' 		=> 'social_size',
							'description' 		=> esc_html__( 'Controls the social size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark')
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Divider Color', 'roark' ),
							'param_name' 		=> 'divider_color',
							'description' 		=> esc_html__( 'Controls the divider color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark')
						),

						// Design Options
						array(
							'type' 			=> 'css_editor',
							'heading' 		=> esc_html__( 'CSS box', 'roark' ),
							'param_name' 	=> 'css',
							'group' 		=> esc_html__( 'Design Options', 'roark' ),
							'description' 		=> esc_html__( 'Insert your custom Facebook link.', 'roark' ),
						),
					)
			));
		}

		public function render_shortcode_team($attr, $content = '') {

			extract(shortcode_atts( array(
				'name'				=> '',
			   	'avatar'			=> '',
			   	'work'				=> '',
			   	'text_align'		=> 'text-center',
			   	'facebook'			=> '',
			   	'twitter'			=> '',
			   	'google_plus'		=> '',
			   	'youtube'			=> '',
			   	'linkedin'			=> '',
			   	'dribbble'			=> '',
			   	'instagram'			=> '',
			   	'flickr'			=> '',
			   	'pinterest'			=> '',
			   	'name_color'		=> '',
			   	'name_size'			=> '',
			   	'work_color'		=> '',
			   	'work_size'			=> '',
			   	'social_color'		=> '',
			   	'social_size'		=> '',
			   	'divider_color'		=> '',
			   	'css'				=> '',
			    'class' 			=> ''
			), $attr ));

			$class .= ' ' . $text_align . ' ' . vc_shortcode_custom_css_class($css) . ' ';
			$name_css = $this->merge_css( array( 'font-size'=> $name_size, 'color'=> $name_color) );
			$work_css = $this->merge_css( array( 'font-size'=> $work_size, 'color'=> $work_color) );
			$social_css = $this->merge_css( array( 'font-size'=> $social_size, 'color'=> $social_color) );
			$divider_css = $this->merge_css( array( 'background'=> $divider_color) );
			$avatar_src = $this->get_attachment_image_src($avatar, 'medium');

			ob_start(); ?>

				<div class="team-item <?php echo esc_attr($class); ?>">

					<?php if ( !empty($avatar_src) ): ?>			
						<div class="avatar">
							<div class="wil-bg-cover" style="background-image: url(<?php echo esc_attr($avatar_src); ?>)">
								<img src="<?php echo esc_url($avatar_src) ?>" alt="<?php echo esc_html($name); ?>">
							</div>
						</div>
					<?php endif; ?>

					<?php if ( !empty($name) ): ?>
						<h4 class="h5" style="<?php print $name_css ?>"><?php echo esc_html($name) ?></h4>
					<?php endif ?>

					<?php if ( !empty($work) ): ?>
						<span style="<?php print $work_css ?>"><?php echo esc_html($work) ?></span>
					<?php endif ?>

					<div class="hr" style="<?php print $divider_css ?>"></div>
									
					<div class="social-user" style="<?php print $social_css ?>">

						<?php if ( !empty($facebook) ): ?>
							<a href="<?php echo esc_url($facebook) ?>"><i class="fa fa-facebook"></i></a>
						<?php endif ?>

						<?php if ( !empty($twitter) ): ?>
							<a href="<?php echo esc_url($twitter) ?>"><i class="fa fa-twitter"></i></a>
						<?php endif ?>

						<?php if ( !empty($google_plus) ): ?>
							<a href="<?php echo esc_url($google_plus) ?>"><i class="fa fa-google-plus"></i></a>
						<?php endif ?>

						<?php if ( !empty($dribbble) ): ?>
							<a href="<?php echo esc_url($dribbble) ?>"><i class="fa fa-dribbble"></i></a>
						<?php endif ?>

						<?php if ( !empty($youtube) ): ?>
							<a href="<?php echo esc_url($youtube) ?>"><i class="fa fa-youtube"></i></a>
						<?php endif ?>

						<?php if ( !empty($linkedin) ): ?>
							<a href="<?php echo esc_url($linkedin) ?>"><i class="fa fa-linkedin"></i></a>
						<?php endif ?>

						<?php if ( !empty($instagram) ): ?>
							<a href="<?php echo esc_url($instagram) ?>"><i class="fa fa-instagram"></i></a>
						<?php endif ?>

						<?php if ( !empty($flickr) ): ?>
							<a href="<?php echo esc_url($flickr) ?>"><i class="fa fa-flickr"></i></a>
						<?php endif ?>

						<?php if ( !empty($pinterest) ): ?>
							<a href="<?php echo esc_url($pinterest) ?>"><i class="fa fa-pinterest"></i></a>
						<?php endif ?>

					</div>

				</div>

			<?php 

			$output = ob_get_clean();

			return $output;
		}

		// TESTIMONIAL
		public function vc_map_shortcode_testimonial() {
			vc_map( array(
					'name'			=> esc_html__('Rose Testimonial', 'roark'),
					'base'			=> 'roark_shortcode_testimonial',
					'category'		=> esc_html__('Roark', 'roark'),
					'description'	=> '',
					'params'		=> array(

						array(
			                'type' 			=> 'param_group',
			                'param_name' 	=> 'testimonials',
			                'params' 		=> array(

			                	array(
									'type' 				=> 'attach_image',
									'heading' 			=> esc_html__( 'Avatar', 'roark' ),
									'param_name' 		=> 'avatar',
									'description' 		=> esc_html__( 'Upload a custom avatar image.', 'roark' ),
								),

								array(
									'type' 				=> 'textfield',
									'heading' 			=> esc_html__( 'Name', 'roark' ),
									'param_name' 		=> 'name',
									'admin_label'		=> true,
									'description' 		=> esc_html__( 'Insert the name of the person.', 'roark' ),
								),

								array(
									'type' 				=> 'textfield',
									'heading' 			=> esc_html__( 'Work', 'roark' ),
									'param_name' 		=> 'work',
									'admin_label'		=> true,
									'description' 		=> esc_html__( 'Insert the work of the person.', 'roark' ),
								),

								array(
									'type' 				=> 'textarea',
									'heading' 			=> esc_html__( 'Testimonial Content', 'roark' ),
									'param_name' 		=> 'message',
									'description' 		=> esc_html__( 'Add the testimonial content.', 'roark' ),
								),
							)
						),

			            array(
							'type' 				=> 'dropdown',
							'heading' 			=> esc_html__( 'Alignment Text', 'roark' ),
							'param_name' 		=> 'text_align',
							'std'				=> 'text-center',
							'value'				=> array(
								esc_html__('Text Left', 'roark')			=> 'text-left',
								esc_html__('Text Center', 'roark')			=> 'text-center',
								esc_html__('Text Right', 'roark')			=> 'text-right',
							),
							'save_always' 		=> true,
							'description' 		=> esc_html__( 'Choose alignment text of element.', 'roark' ),
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Extra class name', 'roark' ),
							'param_name' 		=> 'class',
							'description' 		=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'roark' ),
						),

						// Advance
						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Name Color', 'roark' ),
							'param_name' 		=> 'name_color',
							'description' 		=> esc_html__( 'Controls the name color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Name Size', 'roark' ),
							'param_name' 		=> 'name_size',
							'description' 		=> esc_html__( 'Controls the name size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark')
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Work Color', 'roark' ),
							'param_name' 		=> 'work_color',
							'description' 		=> esc_html__( 'Controls the work color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Work Size', 'roark' ),
							'param_name' 		=> 'work_size',
							'description' 		=> esc_html__( 'Controls the work size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark')
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Text Color', 'roark' ),
							'param_name' 		=> 'text_color',
							'description' 		=> esc_html__( 'Controls the text color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Text Size', 'roark' ),
							'param_name' 		=> 'text_size',
							'description' 		=> esc_html__( 'Controls the text size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark')
						),

						// Design Options
						array(
							'type' 			=> 'css_editor',
							'heading' 		=> esc_html__( 'CSS box', 'roark' ),
							'param_name' 	=> 'css',
							'group' 		=> esc_html__( 'Design Options', 'roark' ),
						),
					)
			));
		}

		public function render_shortcode_testimonial($attr, $content = '') {

			extract(shortcode_atts( array(
				'testimonials'		=> '',
		 		'text_align'		=> 'text-center',
		 		'radius'			=> '',
		 		'name_color'		=> '',
		 		'name_size'			=> '',
		 		'work_size'			=> '',
		 		'work_color'		=> '',
		 		'text_color'		=> '',
		 		'text_size'			=> '',
			   	'css'				=> '',
			    'class' 			=> ''
			), $attr ));

			$class .= ' ' . $text_align . ' ' . vc_shortcode_custom_css_class($css);
		 	$name_css = $this->merge_css( array( 'font-size'=> $name_size, 'color'=> $name_color) );
		 	$text_css = $this->merge_css( array( 'font-size'=> $text_size, 'color'=> $text_color) );
		 	$work_css = $this->merge_css( array( 'font-size'=> $work_size, 'color'=> $work_color) );
		 	$testimonials = vc_param_group_parse_atts( $testimonials );
		 	
			ob_start();

				if ( !empty($testimonials) ) : ?>

					<div class="testimonial-slide owl-carousel <?php echo esc_attr($class); ?>">

						<?php foreach ($testimonials as $testimonial) :
							$name = $testimonial['name'];
							$work = $testimonial['work'];
							$message = $testimonial['message'];
							$avatar_src = $this->get_attachment_image_src($testimonial['avatar'], 'thumbnail'); ?>

							<div class="testimonial-item">

								<?php if ( !empty($avatar_src) ): ?>
									<img width="75" height="75" src="<?php echo esc_url($avatar_src) ?>" alt="<?php echo esc_attr( $name); ?>">
								<?php endif ?>

								<?php if ( !empty($message) ): ?>
									<p style="<?php print $text_css; ?>"><?php echo wp_kses_post($message); ?></p>
								<?php endif ?>

								<?php if ( !empty($name) ): ?>
									<h4 class="h6" style="<?php print $name_css; ?>"><?php echo esc_html( $name); ?></h4>
								<?php endif ?>

								<?php if ( !empty($work) ): ?>
									<span style="<?php print $work_css; ?>"><?php echo esc_html( $work); ?></span>
								<?php endif ?>

							</div>

						<?php endforeach ?>
						
					</div>

				<?php endif;

			$output = ob_get_clean();

			return $output;
		}

		// PRICING
		public function vc_map_shortcode_pricing() {
			vc_map( array(
					'name'			=> esc_html__('Rose Pricing', 'roark'),
					'base'			=> 'roark_shortcode_pricing',
					'category'		=> esc_html__('Roark', 'roark'),
					'description'	=> '',
					'params'		=> array(

						array(
							'type' 				=> 'dropdown',
							'heading' 			=> esc_html__( 'Highlight', 'roark' ),
							'param_name' 		=> 'highlight',
							'value'				=> array(
								esc_html__('No') 		=> '',
								esc_html__('Yes') 		=> 'highlights'
							),
							'description' 		=> esc_html__( 'Set this item is highlight.', 'roark' ),
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Title', 'roark' ),
							'param_name' 		=> 'title',
							'admin_label'		=> true,
							'description' 		=> esc_html__( 'Insert the title.', 'roark' ),
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Price', 'roark' ),
							'param_name' 		=> 'price',
							'admin_label'		=> true,
							'description' 		=> esc_html__( 'Add the price.', 'roark' ),
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Unit', 'roark' ),
							'param_name' 		=> 'unit',
							'description' 		=> esc_html__( 'Add the unit.', 'roark' ),
						),

						array(
							'type' 				=> 'textarea_html',
							'heading' 			=> esc_html__( 'Content', 'roark' ),
							'param_name' 		=> 'content',
							'description' 		=> esc_html__( 'Add the content.', 'roark' ),
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Button Text', 'roark' ),
							'param_name' 		=> 'button_text',
							'description' 		=> esc_html__( 'Add the button text.', 'roark' ),
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Button Link', 'roark' ),
							'param_name' 		=> 'button_link',
							'description' 		=> esc_html__( 'Add the button link.', 'roark' ),
						),

						array(
							'type' 				=> 'dropdown',
							'heading' 			=> esc_html__( 'Alignment Text', 'roark' ),
							'param_name' 		=> 'text_align',
							'std'				=> 'text-center',
							'value'				=> array(
								esc_html__('Text Left', 'roark')			=> 'text-left',
								esc_html__('Text Center', 'roark')			=> 'text-center',
								esc_html__('Text Right', 'roark')			=> 'text-right',
							),
							'save_always' 		=> true,
							'description' 		=> esc_html__( 'Choose alignment text of element.', 'roark' ),
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Extra class name', 'roark' ),
							'param_name' 		=> 'class',
							'description' 		=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'roark' ),
						),

						// Advance
						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Title Color', 'roark' ),
							'param_name' 		=> 'title_color',
							'description' 		=> esc_html__( 'Controls the title color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Title Background', 'roark' ),
							'param_name' 		=> 'title_bg',
							'description' 		=> esc_html__( 'Controls the title background color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Title Size', 'roark' ),
							'param_name' 		=> 'title_size',
							'description' 		=> esc_html__( 'Controls the title size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark')
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Price Color', 'roark' ),
							'param_name' 		=> 'price_color',
							'description' 		=> esc_html__( 'Controls the price color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Price Background', 'roark' ),
							'param_name' 		=> 'price_bg',
							'description' 		=> esc_html__( 'Controls the price background color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Price Size', 'roark' ),
							'param_name' 		=> 'price_size',
							'description' 		=> esc_html__( 'Controls the price size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark')
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Unit Color', 'roark' ),
							'param_name' 		=> 'unit_color',
							'description' 		=> esc_html__( 'Controls the unit color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Unit Size', 'roark' ),
							'param_name' 		=> 'unit_size',
							'description' 		=> esc_html__( 'Controls the unit size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark')
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Content Color', 'roark' ),
							'param_name' 		=> 'content_color',
							'description' 		=> esc_html__( 'Controls the content color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Content Background', 'roark' ),
							'param_name' 		=> 'content_bg',
							'description' 		=> esc_html__( 'Controls the content background color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Button Color', 'roark' ),
							'param_name' 		=> 'button_color',
							'description' 		=> esc_html__( 'Controls the button color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'colorpicker',
							'heading' 			=> esc_html__( 'Button Background', 'roark' ),
							'param_name' 		=> 'button_bg',
							'description' 		=> esc_html__( 'Controls the button background color. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark' )
						),

						array(
							'type' 				=> 'textfield',
							'heading' 			=> esc_html__( 'Button Size', 'roark' ),
							'param_name' 		=> 'button_size',
							'description' 		=> esc_html__( 'Controls the button size. Enter the font size without px ex: 50px. Leave blank for theme option selection.', 'roark' ),
							'group'				=> esc_html__('Advance', 'roark')
						),

						// Design Options
						array(
							'type' 			=> 'css_editor',
							'heading' 		=> esc_html__( 'CSS box', 'roark' ),
							'param_name' 	=> 'css',
							'group' 		=> esc_html__( 'Design Options', 'roark' ),
						),
					)
			));
		}

		public function render_shortcode_pricing($attr, $content = '') {

			extract(shortcode_atts( array(
				'highlight'			=> '',
				'title'				=> '',
		 		'price'				=> '',
		 		'unit'				=> '',
		 		'text_align'		=> 'text-center',
		 		'button_text'		=> esc_html__('Button', 'roark'),
		 		'button_link'		=> '',
		 		'title_color'		=> '',
		 		'title_size'		=> '',
		 		'title_bg'			=> '',
		 		'price_color'		=> '',
		 		'price_size'		=> '',
		 		'price_bg'			=> '',
		 		'unit_color'		=> '',
		 		'unit_size'			=> '',
		 		'button_bg'			=> '',
		 		'button_color'		=> '',
		 		'button_size'		=> '',
		 		'content_color'		=> '',
		 		'content_bg'		=> '',
			   	'css'				=> '',
			    'class' 			=> ''
			), $attr ));

			$class .= ' ' . $text_align . ' ' . vc_shortcode_custom_css_class($css) . ' ' . $highlight;
		 	$title_css = $this->merge_css( array( 'font-size'=> $title_size, 'color'=> $title_color, 'background-color'=> $title_bg) );
		 	$price_css = $this->merge_css( array( 'font-size'=> $price_size, 'color'=> $price_color) );
		 	$price_bg = $this->merge_css( array('background-color'=> $price_bg) );
		 	$unit_css = $this->merge_css( array( 'font-size'=> $unit_size, 'color'=> $unit_color) );
		 	$button_css = $this->merge_css( array( 'font-size'=> $button_size, 'color'=> $button_color, 'background-color'=> $button_bg) );
		 	$content_css = $this->merge_css( array('color'=> $content_color, 'background-color'=> $content_bg ));

			ob_start(); ?>

				<div class="pricing-item <?php echo esc_attr($class) ?>">

					<?php if ( !empty($title) ): ?>
						<h2 class="h6" style="<?php print $title_css ?>"><?php echo esc_html($title) ?></h2>
					<?php endif ?>
					
					<?php if ( !empty($price) && !empty($unit) ): ?>

						<div class="price" style="<?php print $price_bg ?>">

							<?php if ( !empty($price) ): ?>
								<span class="money" style="<?php print $price_css ?>"><?php echo esc_html($price) ?></span>
							<?php endif ?>

							<?php if ( !empty($unit) ): ?>
								<span class="unit" style="<?php print $unit_css ?>"><?php echo esc_html($unit) ?></span>
							<?php endif ?>

						</div>

					<?php endif ?>

					<div class="pricing__content" style="<?php print $content_css ?>">

						<?php if ( !empty($content) ) {
							echo wp_kses_post($content);
						} ?>

						<?php if ( !empty($button_text) ): ?>
							<a class="button" href="<?php echo esc_url($button_link) ?>" style="<?php print $button_css ?>"><?php echo esc_html($button_text) ?></a>
						<?php endif ?>

					</div>

				</div>

			<?php

			$output = ob_get_clean();

			return $output;
		}

		// PORTFOLIO
		public function vc_map_shortcode_portfolio() {

			$cats = $this->roark_terms();

			vc_map( array(
				'name'			=> esc_html__('Rose Portfolio', 'roark'),
				'base'			=> 'roark_shortcode_portfolio',
				'category'		=> esc_html__('Roark', 'roark'),
				'admin_enqueue_js' => array(roark_ADMIN_CORE_DIR .'visual/assets/js/script.js'),
				'params'		=> array(

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'roark' ),
						'param_name' => 'style',
						'std'			=> 'style1',
						'value' => array(
							esc_html__( 'Modern', 'roark' ) => 'style1',
							esc_html__( 'Grid', 'roark' ) => 'style2',
							esc_html__( 'Masonry', 'roark' ) => 'style3',
						),
						'description' => esc_html__( 'Option select style portfolio.', 'roark' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Caption Position', 'roark' ),
						'param_name' => 'caption_pos',
						'std'			=> 'caption-middle',
						'value' => array(
							esc_html__( 'Middle', 'roark' ) => 'caption-middle',
							esc_html__( 'Bottom', 'roark' ) => 'caption-bottom',
						),
						'description' => esc_html__( 'Choose caption position middle or bottom.', 'roark' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Hover Effect', 'roark' ),
						'param_name' => 'effect',
						'std'			=> 'effet-fade',
						'value' => array(
							esc_html__( 'Fade', 'roark' ) => 'effet-fade',
							esc_html__( 'Push Top', 'roark' ) => 'effet-push-top',
							esc_html__( 'Push Right', 'roark' ) => 'effet-push-right',
							esc_html__( 'Push Bottom', 'roark' ) => 'effet-push-bottom',
							esc_html__( 'Push Left', 'roark' ) => 'effet-push-left',
							esc_html__( 'Move Top', 'roark' ) => 'effet-move-top',
							esc_html__( 'Move Right', 'roark' ) => 'effet-move-right',
							esc_html__( 'Move Bottom', 'roark' ) => 'effet-move-bottom',
							esc_html__( 'Move Left', 'roark' ) => 'effet-move-left',
							esc_html__( 'Classic', 'roark' ) => 'effet-classic',
							esc_html__( 'Zoom In', 'roark' ) => 'effet-zoom-in',
							esc_html__( 'Flip Y', 'roark' ) => 'effet-flip-y',
							esc_html__( 'Flip X', 'roark' ) => 'effet-flip-x',
							esc_html__( 'Slide Top', 'roark' ) => 'effet-slide-top',
							esc_html__( 'Slide Right', 'roark' ) => 'effet-slide-right',
							esc_html__( 'Slide Bottom', 'roark' ) => 'effet-slide-bottom',
							esc_html__( 'Slide Left', 'roark' ) => 'effet-slide-left',
						),
						'dependency' => array(
							'element' => 'caption_pos',
							'value' => array('caption-middle'),
						),
						'description' => esc_html__( 'Select the hover effect. The default is fade.', 'roark' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Categories Position', 'roark' ),
						'param_name' => 'category_pos',
						'std'			=> 'bottom',
						'value' => array(
							esc_html__( 'Under Title', 'roark' ) => 'bottom',
							esc_html__( 'Above Title', 'roark' ) => 'top',
						),
						'description' => esc_html__( 'Choose categories position top or bottom title.', 'roark' ),
					),

					array(
						'type' 			=> 'wiloke_get_list_of_terms',
						'heading' 		=> esc_html__( 'Categories Filter', 'roark' ),
						'param_name' 	=> 'category_in',
						'is_multiple'	=> true,
						'taxonomy'      => 'category-portfolio',
						'value'			=> $cats,
						'description'	=> esc_html__('Display post in category.', 'roark')
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Show Filter', 'roark' ),
						'param_name' => 'show_filter',
						'value'		=> array(
							esc_html__( 'Yes', 'roark' ) => 'yes',
							esc_html__( 'No', 'roark' ) => 'no'
						),
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Show Posts', 'roark'),
						'param_name'	=> 'post_number',
						'std'			=> 8,
						'value'			=> 8,
						'description'	=> esc_html__('Show the post on the page.')
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Animation', 'roark' ),
						'param_name' => 'animation',
						'std'			=> 'fadeInUp',
						'value' => $this->animation(),
						'description' => esc_html__( 'Animation when scroll.', 'roark' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Column Lager', 'roark' ),
						'param_name' => 'col_lg',
						'std'			=> '3',
						'value' => array(
							esc_html__( '1 Column', 'roark' ) => '1',
							esc_html__( '2 Column', 'roark' ) => '2',
							esc_html__( '3 Column', 'roark' ) => '3',
							esc_html__( '4 Column', 'roark' ) => '4',
							esc_html__( '5 Column', 'roark' ) => '5',
							esc_html__( '6 Column', 'roark' ) => '6',
						),
						'dependency' => array(
							'element' => 'style',
							'value' => array('style2', 'style3'),
						),
						'description' => esc_html__( 'Large devices desktops (≥1200px).', 'roark' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Column Medium', 'roark' ),
						'param_name' => 'col_md',
						'std'			=> '3',
						'value' => array(
							esc_html__( '1 Column', 'roark' ) => '1',
							esc_html__( '2 Column', 'roark' ) => '2',
							esc_html__( '3 Column', 'roark' ) => '3',
							esc_html__( '4 Column', 'roark' ) => '4',
							esc_html__( '5 Column', 'roark' ) => '5',
							esc_html__( '6 Column', 'roark' ) => '6',
						),
						'dependency' => array(
							'element' => 'style',
							'value' => array('style2', 'style3'),
						),
						'description' => esc_html__( 'Medium devices desktops (≥992px).', 'roark' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Column Small', 'roark' ),
						'param_name' => 'col_sm',
						'std'			=> '2',
						'value' => array(
							esc_html__( '1 Column', 'roark' ) => '1',
							esc_html__( '2 Column', 'roark' ) => '2',
							esc_html__( '3 Column', 'roark' ) => '3',
							esc_html__( '4 Column', 'roark' ) => '4',
							esc_html__( '5 Column', 'roark' ) => '5',
							esc_html__( '6 Column', 'roark' ) => '6',
						),
						'dependency' => array(
							'element' => 'style',
							'value' => array('style2', 'style3'),
						),
						'description' => esc_html__( 'Small devices tablets (≥768px).', 'roark' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Column Extra Small', 'roark' ),
						'param_name' => 'col_xs',
						'std'			=> '1',
						'value' => array(
							esc_html__( '1 Column', 'roark' ) => '1',
							esc_html__( '2 Column', 'roark' ) => '2',
							esc_html__( '3 Column', 'roark' ) => '3',
							esc_html__( '4 Column', 'roark' ) => '4',
							esc_html__( '5 Column', 'roark' ) => '5',
							esc_html__( '6 Column', 'roark' ) => '6',
						),
						'dependency' => array(
							'element' => 'style',
							'value' => array('style2', 'style3'),
						),
						'description' => esc_html__( 'Extra small devices phones (<768px).', 'roark' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Spacing Vertical', 'roark' ),
						'param_name' => 'vertical',
						'std'			=> '0',
						'value' => array(
							esc_html__( '0px', 'roark' ) 	=> '0',
							esc_html__( '5px', 'roark' ) 	=> '5',
							esc_html__( '10px', 'roark' ) => '10',
							esc_html__( '15px', 'roark' ) => '15',
							esc_html__( '20px', 'roark' ) => '20',
							esc_html__( '25px', 'roark' ) => '25',
							esc_html__( '30px', 'roark' ) => '30',
							esc_html__( '35px', 'roark' ) => '35',
							esc_html__( '40px', 'roark' ) => '40',
						),
						'description' => esc_html__( 'Spacing left right. Default no spacing.', 'roark' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Spacing Horizontal', 'roark' ),
						'param_name' => 'horizontal',
						'std'			=> '0',
						'value' => array(
							esc_html__( '0px', 'roark' ) 			=> '0',
							esc_html__( '5px', 'roark' ) 			=> '5',
							esc_html__( '10px', 'roark' ) 			=> '10',
							esc_html__( '15px', 'roark' ) 			=> '15',
							esc_html__( '20px', 'roark' ) 			=> '20',
							esc_html__( '25px', 'roark' ) 			=> '25',
							esc_html__( '30px', 'roark' ) 			=> '30',
							esc_html__( '35px', 'roark' ) 			=> '35',
							esc_html__( '40px', 'roark' ) 			=> '40',
						),
						'description' => esc_html__( 'Spacing top bottom. Default no spacing.', 'roark' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Pagination', 'roark' ),
						'param_name' => 'paging',
						'std'			=> 'scroll',
						'value' => array(
							esc_html__( 'Infinite Scroll', 'roark' ) 	=> 'scroll',
							esc_html__( 'Load More Button', 'roark' ) 	=> 'click',
							esc_html__( 'No Pagination', 'roark' ) 		=> 'none',
						)
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'roark' ),
						'param_name' => 'order',
						'std'			=> 'DESC',
						'value' => array(
							esc_html__( 'Descending', 'roark' ) 	=> 'DESC',
							esc_html__( 'Ascending', 'roark' ) 		=> 'ASC',
						)
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order By', 'roark' ),
						'param_name' => 'orderby',
						'std'			=> 'date',
						'value' 		=> array(
							esc_html__( 'Title', 'roark' ) 				=> 'title',
							esc_html__( 'Modified', 'roark' ) 			=> 'modified',
							esc_html__( 'Date', 'roark' ) 				=> 'date',
							esc_html__( 'Random', 'roark' ) 			=> 'rand',
							esc_html__( 'Comment count', 'roark' ) 		=> 'comment_count',
							esc_html__( 'Menu order', 'roark' ) 		=> 'menu_order',
						),
						'description' => esc_html__( 'Sort retrieved projects by parameter.', 'roark' ),
					),

					array(
						'type' 				=> 'textfield',
						'heading' 			=> esc_html__( 'Extra class name', 'roark' ),
						'param_name' 		=> 'class',
						'description' 		=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'roark' ),
					),

					// Design Options
					array(
						'type' 			=> 'css_editor',
						'heading' 		=> esc_html__( 'CSS box', 'roark' ),
						'param_name' 	=> 'css',
						'group' 		=> esc_html__( 'Design Options', 'roark' ),
					),
				)
			));
		}

		public function render_shortcode_portfolio($attr, $content = '') {

			extract(shortcode_atts( array(
				'style' 			=> 'style1',
				'post_number'		=> '8',
				'category_in'		=> '',
				'caption_pos'		=> 'caption-middle',
				'animation'			=> 'fadeInUp',
				'effect'			=> 'effet-fade',
				'col_lg'			=> '3',
				'col_md'			=> '3',
				'col_sm'			=> '2',
				'col_xs'			=> '1',
				'vertical'			=> '0',
				'horizontal'		=> '0',
				'paging'			=> 'scroll',
				'order'				=> 'DESC',
				'orderby'			=> 'date',
				'category_pos'		=> 'bottom',
				'show_filter'		=> 'yes',
				'post__not_in'		=> '',
				'class'				=> '',
				'css'				=> ''
			), $attr )); 

			$class_wrap = $class . ' ' . vc_shortcode_custom_css_class($css);

			$attribute = array();

			if($style != 'style1') {
				$attribute[] = 'data-col-lg="'. esc_attr($col_lg) .'"';
				$attribute[] = 'data-col-md="'. esc_attr($col_md) .'"';
				$attribute[] = 'data-col-sm="'. esc_attr($col_sm) .'"';
				$attribute[] = 'data-col-xs="'. esc_attr($col_xs) .'"';
			}
			
			$attribute[] = 'data-vertical="'. esc_attr($vertical) .'"';
			$attribute[] = 'data-horizontal="'. esc_attr($horizontal) .'"';

			if( $caption_pos != 'caption-middle') {
				$effect = '';
			}

			$class= 'portfolio-isotop grid '. $style .' '. $effect .' '. $caption_pos;

			$args = array( 
				'style' 			=> $style, 
				'animation'			=> $animation,
				'post_number'		=> $post_number,
				'category_in'		=> $category_in,
				'post__not_in'		=> $post__not_in,
				'order' 			=> $order, 
				'orderby' 			=> $orderby,
				'caption_pos'		=> $caption_pos,
				'category_pos'		=> $category_pos
			);

			if ( empty($category_in) )
			{
				return false;
			} 

			$aCatIds = explode(',', $args['category_in']);

			$query_args = array(
				'post_type' 			=> 'portfolio',
				'post_status' 			=> 'publish',
				'posts_per_page' 		=> $args['post_number'],
				'ignore_sticky_posts'	=> 1,
				'order'					=> $args['order'],
				'orderby'				=> $args['orderby'],
				'tax_query'				=> array(
					array(
	  					'taxonomy' 	=> 'category-portfolio',
	  					'field' 	=> 'term_id', 
	  					'terms' 	=> $aCatIds
  					)
				)
	  		);

	  		$wilokeQuery = new WP_Query($query_args);

			$portfolioWrapId = uniqid('portfolio_');

			$term_count = array();
			$totalCount = 0;
			
			$aCatIds = explode(',', $args['category_in']);

			foreach ($aCatIds as $term_id) {

				$aTerms = get_term($term_id, 'category-portfolio', OBJECT, 'count');
				if ( !empty($aTerms) && !is_wp_error($aTerms) )
				{
					$term_count[$term_id] = $aTerms->count;
				}
			}

			$term_count['all'] = $wilokeQuery->found_posts;
			$totalCount		   = $term_count['all'];
			$term_count = json_encode($term_count);
			

			$param = json_encode($args); 

			ob_start(); ?>
	
			<div id="<?php echo esc_attr($portfolioWrapId); ?>" class="portfolio-wrap <?php echo esc_attr($class_wrap); ?>" data-count="<?php echo esc_attr($term_count); ?>">

				<?php 

					if( $show_filter == 'yes' ) { 
						
						$this->filter($category_in, $portfolioWrapId); 

					} 

				?>

				<div class="<?php echo $class ?>" <?php echo implode(' ', $attribute) ?>>

					<div class="grid-size"></div>

					<?php $this->loop($args, $wilokeQuery); ?>
		
				</div>

				<?php if($paging !='hidden' || ( absint($args['post_number']) >= absint($totalCount) ) ): ?>

					<?php $key = rand(1, 1000000); ?>

					<div class="loadmore text-center <?php echo esc_attr($paging); ?> mt-30">
						<a href="#" class="button" data-parentid="<?php echo esc_attr($portfolioWrapId); ?>" data-id="roark_<?php echo esc_attr($key); ?>"><?php echo esc_html__('Load more', 'roark'); ?></a>								
						<script>
							window['roark_<?php echo esc_js($key); ?>']= <?php echo $param; ?>;
						</script>
					</div>
				<?php endif; ?>
				
			</div>
			
			<?php $output = ob_get_clean();

			return $output;
		}

		// BLOG
		public function vc_map_shortcode_blog() {
			vc_map( array(
				'name'			=> esc_html__('Rose Blog', 'roark'),
				'base'			=> 'roark_shortcode_blog',
				'category'		=> esc_html__('Roark', 'roark'),
				'description'	=> '',
				'params'		=> array(

					array(
		                'type'       		=> 'textfield',
		                'heading'    		=> esc_html__('Number of Post', 'roark'),
		                'param_name' 		=> 'per_post',
		                'std'        		=> 10,
		                'value'      		=> 10,
		                'admin_label'   	=> true,
		                'description'   	=> esc_html__('Display number of post.', 'roark')
		            ),

		            array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Order', 'roark' ),
						'param_name' 	=> 'order',
						'std'			=> 'DESC',
						'admin_label'   => true,
						'value' 		=> array(
							esc_html__( 'Descending', 'roark' ) 		=> 'DESC',
							esc_html__( 'Ascending', 'roark' ) 			=> 'ASC',
						),
						'save_always'	=> true
					),

					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Order By', 'roark' ),
						'param_name' 	=> 'orderby',
						'std'			=> 'date',
						'admin_label'   => true,
						'value' 		=> array(
							esc_html__( 'Title', 'roark' ) 				=> 'title',
							esc_html__( 'Modified', 'roark' ) 			=> 'modified',
							esc_html__( 'Date', 'roark' ) 				=> 'date',
							esc_html__( 'Random', 'roark' ) 			=> 'rand',
							esc_html__( 'Comment count', 'roark' ) 		=> 'comment_count',
							esc_html__( 'Menu order', 'roark' ) 		=> 'menu_order',
						),
						'description' 	=> esc_html__( 'Sort retrieved projects by parameter.', 'roark' ),
						'save_always'	=> true
					),

					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Paging', 'roark' ),
						'param_name' 	=> 'paging',
						'std'			=> 'pagination',
						'admin_label'   => true,
						'value' 		=> array(
							esc_html__( 'Pagination', 'roark' ) 		=> 'pagination',
							esc_html__( 'No Paging', 'roark' ) 			=> 'nopaging',
						),
						'description' 	=> esc_html__( 'Choose paging style.', 'roark' ),
						'save_always'	=> true
					),

					array(
						'type' 				=> 'textfield',
						'heading' 			=> esc_html__( 'Extra class name', 'roark' ),
						'param_name' 		=> 'class',
						'description' 		=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'roark' ),
					),

					// Layout
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Blog', 'roark' ),
						'param_name' 	=> 'layout',
						'std'			=> 'standard',
						'admin_label'   => true,
						'value' 		=> array(
							esc_html__( 'Standard', 'roark' ) 		=> 'standard',
							esc_html__( 'Grid', 'roark' ) 			=> 'grid',
						),
						'save_always'	=> true,
						'description' 	=> esc_html__( 'Display post style.', 'roark' ),
						'group'			=> esc_html__('Layout', 'roark')
					),

					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Sidebar', 'roark' ),
						'param_name' 	=> 'sidebar',
						'std'			=> 'sidebar_right',
						'admin_label'   => true,
						'value' 		=> array(
							esc_html__( 'Sidebar Left', 'roark' ) 		=> 'sidebar_left',
							esc_html__( 'Sidebar Right', 'roark' ) 		=> 'sidebar_right',
							esc_html__( 'No Sidebar', 'roark' ) 		=> 'no_sidebar',
						),
						'save_always'	=> true,
						'description' 	=> esc_html__( 'Display position sidebar.', 'roark' ),
						'group'			=> esc_html__('Layout', 'roark')
					),

		            // Design Options
					array(
						'type' 				=> 'css_editor',
						'heading' 			=> esc_html__( 'CSS box', 'roark' ),
						'param_name' 		=> 'css',
						'group' 			=> esc_html__( 'Design Options', 'roark' ),
					),
				)
			));
		}

		public function render_shortcode_blog($attr, $content = '') {

			extract(shortcode_atts( array(
				'per_post'			=> 8,
		 		'order'				=> 'date',
		 		'orderby'			=> 'DESC',
		 		'except_length'		=> 55,
		 		'paging'			=> 'pagination',
		 		'layout'			=> 'standard',
		 		'sidebar'			=> 'sidebar_right',
			   	'css'				=> '',
			    'class' 			=> ''
			), $attr ));

			$class .= ' ' . vc_shortcode_custom_css_class($css);

            $args  = array(
                'post_type'         => 'post',
                'post_status'       => 'publish',
                'posts_per_page'    => $per_post,
                'paged'             => get_query_var( 'paged', 1 )
            );

            $query = new WP_Query($args);

			ob_start(); ?>

			<section class="section-blog <?php echo esc_attr($class); ?>">

				<div class="row">

					<div class="<?php echo $sidebar == 'no_sidebar' ? 'col-md-12' : 'col-md-9'; ?> <?php echo $sidebar=='sidebar_left' ? 'col-md-push-3' : '' ?>">

						<?php 

							if($layout == 'grid') {

								if($sidebar != 'no_sidebar' ) {
									echo '<div class="blog-masonry grid mb-50" data-col-sm="2" data-col-xs="1" data-vertical="30" data-horizontal="30">';
								} else {
									echo '<div class="blog-masonry grid mb-50" data-col-md="3" data-col-sm="2" data-col-xs="1" data-vertical="30" data-horizontal="30">';
								}

							} else {
								echo '<div class="blog-standard">';
							}

							if ( $query->have_posts() ) {

								while ( $query->have_posts() ) : $query->the_post();

									if( $layout == 'grid' ) {
										echo '<div class="grid-item">';
									}

									get_template_part('content');

									if( $layout == 'grid' ) {
										echo '</div>';
									}

								endwhile;

								wp_reset_postdata();

							} else {
								get_template_part('content-none');
							}

							echo '</div>';

						?>

						<?php 
						
							if ($paging != 'nopaging') {
								roark_blog::roark_paginate($query->max_num_pages); 
							}
							
						?>

					</div>

					<?php if ( $sidebar != 'no_sidebar' ) : ?>
					
						<div class="col-md-3 <?php echo $sidebar == 'sidebar_left' ? 'col-md-pull-9' : '' ?>">
							<?php get_template_part('sidebar'); ?>
						</div>

					<?php endif; ?>

				</div>

			</section>

			<?php $output = ob_get_clean();

			return $output;
		}

	}

	new roark_plugin_shortcode();
}
