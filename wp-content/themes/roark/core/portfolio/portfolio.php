<?php 
	if (!defined('ABSPATH')) {
	  die("You don't have sufficient permission to access this page");
	}

	if (!class_exists('roark_portfolio')) {
		
		class roark_portfolio extends roark_framework { 

			function __construct(){
				
			}

			public static function portfolio_info() {

				global $post;
				$info = get_post_meta($post->ID, 'portfolio_info', true);
				if( isset( $info['description'] ) && !empty( $info['description'] ) ) : ?>
                    <h3 class="h6"><i class="fa fa-angle-right"></i> <?php echo esc_html__('Description', 'roark') ?></h3>
                    <div class="descritption">
                    	<?php echo wp_kses_post($info['description']); ?>
                    </div>
                <?php endif ?>
				
				<?php if( isset( $info['client'] ) && !empty( $info['client'] ) ) : ?>
	                <h3 class="h6"><i class="fa fa-angle-right"></i> <?php echo esc_html__('Clients', 'roark') ?></h3>
	                <div class="client-portfolio">
	                	<?php echo wp_kses_post($info['client'] ); ?>
	                </div>
	            <?php endif; ?>

	            <?php if( isset( $info['tasks'] ) && !empty( $info['tasks'] ) ) : ?>
                    <h3 class="h6"><i class="fa fa-angle-right"></i> <?php echo esc_html__('Tasks', 'roark') ?></h3>
                    <p><em>“<?php echo esc_html( $info['tasks'] ); ?>”</em></p>
                <?php endif; ?>

                <h3 class="h6"><i class="fa fa-angle-right"></i> <?php echo esc_html__('Info', 'roark') ?></h3>

                <ul>

                    <?php
						if( isset( $info['date'] ) && !empty( $info['date'] ) ) :
							$dateFormat = get_option('date_format');
                        $date = date($dateFormat, $info['date']);
					?>
                        <li><?php printf(esc_html__('+ %s', 'roark'), $date ); ?></li>
                    <?php endif; ?>
                    
                    <li><?php printf(esc_html__('+ By: %s', 'roark'), get_the_author() ); ?></li>

                    <?php $terms = get_the_terms( $post->ID, 'category-portfolio' );

                        if ( $terms && !is_wp_error( $terms ) ) :

                            if( count($terms) > 0) : ?>
                                <li>
                                    <?php 
                                        echo esc_html__('+ In: ', 'roark'); 
                                        foreach ( $terms as $term ) : ?>
                                            <a title="<?php echo esc_html( $term->name ); ?>"><?php echo esc_html( $term->name ); ?></a>
                                        <?php endforeach;
                                    ?>
                                </li>
                            <?php endif;

                        endif; 
                    ?>
                    
                </ul>

				<?php 
					if( isset(parent::$option['portfolio_single_social']) && parent::$option['portfolio_single_social'] == '1' ) {
                		do_shortcode('[wiloke_sharing_post]');
                	}
             	?>

                <?php if( isset($info['url']) && !empty($info['url']) ) : ?>
                	<?php $button_text = isset(parent::$option['portfolio_text_visit']) ? parent::$option['portfolio_text_visit'] : 'Visit project'; ?>
                    <a href="<?php echo esc_url( $info['url'] ); ?>" class="btn" target="_blank"><?php echo esc_html($button_text); ?></a>
                <?php endif;
			}

			public static function portfolio_paginate() {


				if( !isset(parent::$option['portfolio_nav']) ||  parent::$option['portfolio_nav'] == '0') {
					$prev_post = get_previous_post();
		            $next_post = get_next_post();

		            if( !empty($prev_post) || !empty($next_post) ) : ?>

		                <div class="nav-portfolio mb-35">

		                    <?php if ( !empty( $next_post ) ) : 
		                        $att_id = get_post_thumbnail_id($next_post->ID);
		                        $src = wp_get_attachment_image_src( $att_id, array(570, 56) ); ?> 
		                        <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="bg-scroll nav-right text-right fl" style="background-image: url(<?php echo esc_url($src[0]); ?>)"><span><?php echo esc_html__('‹ Previous', 'roark') ?></span></a> 
		                    <?php endif; ?>

		                    <?php if ( !empty( $prev_post ) ) : 
		                        $att_id = get_post_thumbnail_id($prev_post->ID);
		                        $src = wp_get_attachment_image_src( $att_id, array(570, 56) ); ?> 
		                        <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="bg-scroll nav-left text-left fr" style="background-image: url(<?php echo esc_url($src[0]); ?>)"><span><?php echo esc_html__('Next ›', 'roark') ?></span></a> 
		                    <?php endif; ?>

		                    <?php 

		                        if( isset(parent::$option['portfolio_url']) && !empty(parent::$option['portfolio_url']) ) : ?>
		                            <a href="<?php echo esc_url(parent::$option['portfolio_url']); ?>" class="center-block" title="<?php echo esc_html__('Home Page Portfolio', 'roark') ?>"><span></span></a>
		                        <?php endif;
		                    ?>
		                    

		                </div>

		            <?php endif;
	            }
			}

			public static function portfolio_setting() {

				$setting = array(
					'class_content' => 'col-md-8',
					'class_sidebar'	=> 'col-md-4'
				);

				if( isset( parent::$option['portfolio_sidebar'] ) ) {
					if( parent::$option['portfolio_sidebar'] == 'sidebar_left' ) {
						$setting['class_content'] = 'col-md-8 col-md-push-4';
						$setting['class_sidebar'] = 'col-md-4 col-md-pull-8';
					} else if(parent::$option['portfolio_sidebar'] == 'full_width') {
						$setting['class_content'] = 'col-xs-12 mb-30';
						$setting['class_sidebar'] = 'col-xs-12 mb-30';
					} else if(parent::$option['portfolio_sidebar'] == 'no_sidebar') {
						$setting['class_content'] = 'col-xs-12 mb-30';
						$setting['class_sidebar'] = 'no_sidebar';
					}
				}

				return $setting;
			}

			public static function portfolio_heading_single() {

				if(!isset(parent::$option['portfolio_single_heading']) || empty(parent::$option['portfolio_single_heading'])) :

					global $post;

					$attachment = get_post_meta($post->ID, 'portfolio_single', true);
					
					if( isset($attachment['header_img_id']) && !empty($attachment['header_img_id']) ) :

						$param = array(
							'title'					=> $post->post_title,
							'align'					=> 'text-center',
							'bg_img'				=> $attachment['header_img_id'],
							'bg_overlay'			=> 'rgba(255,255,255,0.3)',
						);

						$attribute = roark_array_to_attributes($param); ?>

						<div class="mb-40">
							<?php if(class_exists('roark_plugin_shortcode')) {
								echo do_shortcode('[roark_shortcode_banner '. $attribute .']');
							} ?>
						</div>

					<?php endif;
				endif;
				
			}

			public static function roark_portfolio_related() {
				
				if( isset(parent::$option['portfolio_related']) && !empty(parent::$option['portfolio_related']) ) : 

					global $post;
				    $orig_post = $post;
				    $terms = wp_get_post_terms($post->ID, 'category-portfolio', array("fields" => "ids"));
				    $title = isset(parent::$option['related_title']) ? parent::$option['related_title'] : '';
				    
				    if ($terms) :

				    	$args = array(
				    		'post_type'				=> 'portfolio',
						    'post__not_in' 			=> array($post->ID),
						    'posts_per_page'		=> 3,
						    'ignore_sticky_posts'	=> 1,
						    'tax_query'				=> array(
								array(
				  					'taxonomy' 	=> 'category-portfolio',
				  					'field' 	=> 'term_id', 
				  					'terms' 	=> $terms
			  					)
							)
				    	);
				     
				    	$query = new wp_query($args);

				 		if( $query->have_posts() ) : ?>
							
				 			<div class="related-project mt-70">

								<?php if( !empty($title) ) : ?>
									<h4 class="related-project-title"><?php echo esc_html($title); ?></h4>
								<?php endif; ?>

				 				<div class="portfolio-isotop grid style2 effet-fade caption-middle" data-vertical="0" data-horizontal="0" data-col-lg="3" data-col-md="3" data-col-sm="2" data-col-xs="1">

									<div class="grid-size"></div>

									<?php 
										$index = 0;
									?>

									<?php while($query->have_posts()) : $query->the_post(); ?>

										<div class="grid-item">

										    <div class="portfolio-item">

										        <a href="<?php the_permalink(); ?>">
										        
													<?php if(has_post_thumbnail() ) : ?>
											            <div class="img">
											                <div class="wil-imageCover" style="background-image: url(<?php the_post_thumbnail_url('large'); ?>)">
																<img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
															</div>	            
										                </div>
									            	<?php endif; ?>

										            <div class="caption">
										                <div class="tb">
										                    <div class="tb-cell">
								                        		<h2><?php the_title(); ?></h2>
								                        		<span class="hr"></span>
								                        		<span class="cat">Marketing, Photography</span>
										                    </div>
										                </div>
										            </div>
											            
										        </a>

										    </div>

										</div>

										<?php $index++; ?>

									<?php endwhile; ?>
									
								</div>

							</div>

				    		<?php wp_reset_postdata();

				    	endif;
				    	
					    $post = $orig_post;

				    endif;
				endif;

			}
		}

		new roark_portfolio();
	}
