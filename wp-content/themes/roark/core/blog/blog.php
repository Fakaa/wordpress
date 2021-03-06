<?php 

	if ( ! defined( 'ABSPATH' ) ) {
	    exit;
	}

	if( !class_exists('roark_blog') ) { 

		class roark_blog extends roark_framework {

			function __construct() {
				add_action('roark_post_single_footer', array($this, 'roark_sharing_post'));
			}

			// Blog hero
			public static function roark_hero() { 

				if( is_category() ) {
					$title = esc_html__('Category: ', 'roark') . single_cat_title('', false);
				} elseif(is_author() ) {
					global $wp_query;
					$curauth = $wp_query->get_queried_object();
					$title = esc_html__('Author: ', 'roark') . $curauth->user_nicename;
				} elseif ( is_tag() ) {
					$title = esc_html__('Tags: ', 'roark') . single_tag_title('', false);
				} elseif ( is_archive() ) {
					if ( is_day() ) { 
						$title  = esc_html__('Daily: ', 'roark' ) . get_the_time('d');
				 	} elseif ( is_month() ) { 
						$title = esc_html__('Monthly: ', 'roark' ) . get_the_time( 'F Y' ); 
					} elseif ( is_year() ) { 
						$title = esc_html__('Yearly: ', 'roark' ) . get_the_time( 'Y' ); 
					} else { 
						$title =  esc_html__('Archives', 'roark' );
					}
				} elseif( is_search() ) {
					$title = esc_html__('Search: ', 'roark' ) . get_search_query(); 
				} else if(is_page()) {
					$title = single_post_title('', false);
				} else {
					$title = parent::$option['blog_title']; 
				} 

				if( !empty($title) ) : ?>

					<section class="roark-hero text-center">
						<div class="container">
							<div class="page-header">
								<div class="tb">
									<div class="tb-cell ver-middle">
										<h2 class="h2 page-title text-uppercase"><?php echo esc_html($title) ?></h2>
										<span class="divider"></span>
									</div>
								</div>
							</div>
						</div>
					</section>

				<?php endif;
			}

			// Blog excerpt length
			public static function roark_excerpt_length($limit='') {

				if (  empty($limit) )
				{
					if( isset( parent::$option['blog_excerpt'] )  && !empty( parent::$option['blog_excerpt'] )) {
						$limit = parent::$option['blog_excerpt'];
					} else {
						$limit = 55;
					}
				}	

				$excerpt = explode(' ', get_the_excerpt(), $limit);

			    if (count($excerpt)>=$limit) {

			        array_pop($excerpt);
			        $excerpt = implode(" ",$excerpt).'...';

			      } else {
			        $excerpt = implode(" ",$excerpt);
			      } 

			    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

			    return $excerpt;
			}

			// Blog meta date
			public static function roark_meta_date() { ?>
				<span class="meta-date">
					<span class="day"><?php the_time('d'); ?></span><span class="month"><?php the_time('M'); ?></span>
				</span>
				<?php
			}

			// Author Post Link
			public static function roark_meta_author() { ?>
				<span class="meta-author">
					<?php echo esc_html__('By ', 'roark'); ?><?php the_author_posts_link(); ?>
				</span>
				<?php
			}

			// Blog meta category
			public static function roark_meta_cat() {
			 	the_category(); 
			}

			// Blog meta comment
			public static function roark_meta_comment() { ?>

				<span class="meta-comment">
					<a href="<?php the_permalink() ?>#comments">
						<?php comments_number( esc_html__('No comment', 'roark'), esc_html__('1 comment', 'roark'), esc_html__('% comment', 'roark') ); ?>
					</a>
				</span>

				<?php
			}

			// Blog meta tags
			public static function roark_blog_meta_tag() {
				if( isset( parent::$option['post_meta']['blog_meta_tag'] ) && empty( parent::$option['post_meta']['blog_meta_tag'] ) ) {
				 	the_tags('<span class="meta-author">Tag: ', ',', '</span>'); 
				}
			}

			// Blog paginate
			public static function roark_paginate($max_num_pages = '') {
				global $wp_query;
				$big = 999999999; 
				$max_num_page = empty($max_num_pages) ? $wp_query->max_num_pages : $max_num_pages; ?>

				<div class="nav-post">
					<?php 
						echo paginate_links( array(
							'base' 			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' 		=> '?paged=%#%',
							'current' 		=> max( 1, get_query_var('paged') ),
							'total' 		=> $max_num_page,
							'type'			=> 'list',
							'prev_text'		=> '<i class="fa fa-angle-left"></i>',
							'next_text'		=> '<i class="fa fa-angle-right"></i>',
						) );
					?>
				</div>

				<?php
			}

			// Blog Setting Layout
			public static function roark_blog_setting() {

				$setting = array(
					'blog'				=> 'blog-standard',
					'class_content'		=> 'col-md-9',
					'class_sidebar'		=> 'col-md-3'
				);

				if( isset(parent::$option['blog_style']) && !empty(parent::$option['blog_style']) ) {
					$setting['blog'] = parent::$option['blog_style'];
				}

				if( isset(parent::$option['blog_sidebar']) && !empty(parent::$option['blog_sidebar']) ) {

					if( parent::$option['blog_sidebar'] == 'sidebar_left' ) {
						$setting['class_content'] = 'col-md-9 col-md-push-3';
						$setting['class_sidebar'] = 'col-md-3 col-md-pull-9';
					} elseif( parent::$option['blog_sidebar'] == 'no_sidebar' ) {
						$setting['class_content'] = 'col-md-12';
						$setting['class_sidebar'] = 'hidden';
					}

				}

				return $setting; 
			}

			public static function roark_blog_related() {
				if( !isset(parent::$option['post_meta']['blog_related_post']) || empty(parent::$option['post_meta']['blog_related_post']) ) {
					
				    global $post;
				    $orig_post = $post;
				    $posts_per_page = (isset(parent::$option['related_post_number']) && !empty(parent::$option['related_post_number']) ) ? parent::$option['related_post_number'] : 3;
				    $tags = wp_get_post_tags($post->ID);
				    if ($tags) :

				    	$tag_ids = array();

				    	foreach($tags as $individual_tag) {
				    		$tag_ids[] = $individual_tag->term_id;
			    		}

				    	$args = array(
						    'tag__in' 				=> $tag_ids,
						    'post__not_in' 			=> array($post->ID),
						    'posts_per_page'		=> $posts_per_page,
						    'ignore_sticky_posts'	=> 1
				    	);
				     
				    	$query = new wp_query( $args );

				 		if($query->have_posts() ) : ?>

				 			<div class="blog-related">
				 				<h4><?php echo esc_html__('You may also like', 'roark') ?></h4>

				 				<div class="related-gird">
							    	<?php while( $query->have_posts() ) : $query->the_post(); ?>
							     
								    	<div class="related-post">

								    		<?php if(has_post_thumbnail() ) : ?>
								    			<div class="img">
								    				<a href="<?php the_permalink(); ?>">
											    		 <div class="wil-imageCover" style="background-image: url(<?php the_post_thumbnail_url('large'); ?>)">
															<img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
														</div>
													</a>
									    		</div>
								    		<?php endif; ?>

								    		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								    		<span><?php the_time( get_option( 'date_format' ) ); ?></span>

								    	</div>
							     
							    	<?php endwhile; ?>
						    	</div>
							</div>

				    		<?php wp_reset_postdata();

				    	endif;
				    	
					    $post = $orig_post;

				    endif;
			    }
			}

			// Share Post
			function roark_sharing_post() {
				if( isset(parent::$option['post_meta']['blog_share_post']) && parent::$option['post_meta']['blog_share_post'] == '1' ) {
				    if ( class_exists('WilokeSharingPost') ) {
				    	echo '<div class="post-footer"><div class="post-share">';
				    	if(has_filter('post_share_before')) {
				    		$label = apply_filters( 'post_share_before');
				    		echo $label;
				    	}
				        echo do_shortcode('[wiloke_sharing_post]');
				        echo '</div></div>';
				    }
				}
			}
		}

		new roark_blog();
	}