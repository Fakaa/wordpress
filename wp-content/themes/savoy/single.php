<?php
	global $nm_theme_options, $post;
	
	$show_sidebar = ( $nm_theme_options['single_post_sidebar'] != 'none' ) ? true : false;
	$post_column_class = ( $show_sidebar ) ? 'col col-md-8 col-sm-12 col-xs-12' : 'nm-post-col';
	
	// Get post thumbnail
	$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );

    $share_links = apply_filters( 'nm_post_share_links', array(
        '<a href="//www.facebook.com/sharer.php?u=' . esc_url( get_permalink() ) . '" target="_blank" title="' . esc_html__( 'Share on Facebook', 'nm-framework' ) . '"><i class="nm-font nm-font-facebook"></i></a>',
        '<a href="//twitter.com/share?url=' . esc_url( get_permalink() ) . '" target="_blank" title="' . esc_html__( 'Share on Twitter', 'nm-framework' ) . '"><i class="nm-font nm-font-twitter"></i></a>',
        '<a href="//pinterest.com/pin/create/button/?url=' . esc_url( get_permalink() ) . '&amp;media=' . esc_url( $post_thumbnail[0] ) . '&amp;description=' . urlencode( get_the_title() ) . '" target="_blank" title="' . esc_html__( 'Pin on Pinterest', 'nm-framework' ) . '"><i class="nm-font nm-font-pinterest"></i></a>'
    ) );
?>

<?php get_header(); ?>
		
<div class="nm-post nm-post-sidebar-<?php echo esc_attr( $nm_theme_options['single_post_sidebar'] ); ?>">

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>    	
	
	<div class="nm-post-body">
        <div class="nm-row">
            <div class="nm-post-content-col <?php echo $post_column_class; ?>">
                <header class="nm-post-header">
                    <?php
                        if ( $nm_theme_options['single_post_display_featured_image'] && has_post_thumbnail() ) {
                            the_post_thumbnail( 'nm_blog_list' );
                        }
                    ?>

                    <h1><?php the_title(); ?></h1>

                    <div class="nm-post-meta">
                        <span><?php esc_html_e( 'By', 'nm-framework' ); ?> <?php the_author_posts_link(); ?> <?php esc_html_e( 'on', 'nm-framework' ); ?> <?php the_date(); ?></span>
                    </div>
                </header>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="nm-post-content entry-content clear">
                        <?php the_content(); ?>
                        <?php
                            wp_link_pages( array(
                                'before' 		=> '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'nm-framework' ) . '</span>',
                                'after' 		=> '</div>',
                                'link_before'	=> '<span>',
                                'link_after'	=> '</span>'
                            ) );
                        ?>
                    </div>
                </article>

                <?php
                    $has_meta = false;
                    $meta_output = '';
                    $categories_list = get_the_category_list( ', ' );
                    $tag_list = get_the_tag_list( '', ', ' );

                    if ( $categories_list ) {
                        $has_meta = true;

                        $meta_output = esc_html__( 'Posted in ', 'nm-framework' ) . $categories_list;

                        if ( $tag_list ) {
                            $meta_output .= esc_html__( ' and tagged ', 'nm-framework' ) . $tag_list;
                        }

                        $meta_output .= '.';
                    } else {
                        if ( $tag_list ) {
                            $has_meta = true;

                            $meta_output = esc_html__( 'Tagged ', 'nm-framework' ) . $tag_list . '.';
                        }
                    }

                    if ( $has_meta ) {
                        echo '<div class="nm-single-post-meta">' . $meta_output . '</div>';
                    }
                ?>

                <div class="nm-post-share">
                    <span><?php esc_html_e( 'Share', 'nm-framework' ); ?></span>
                    <?php
                        foreach ( $share_links as $link ) {
                            echo $link;
                        }
                    ?>
                </div>

                <div class="nm-post-pagination">
                    <div class="nm-post-prev">
                        <?php next_post_link( '%link', '<span>' . esc_html__( '&larr;&nbsp; Newer', 'nm-framework' ) . '</span><span class="subtitle">%title</span>', false ); ?>
                    </div>
                    <div class="nm-post-next">
                        <?php previous_post_link( '%link', '<span>' . esc_html__( 'Older &nbsp;&rarr;', 'nm-framework' ) . '</span><span class="subtitle">%title</span>', false ); ?>
                    </div>
                </div>
            </div>

            <?php if ( $show_sidebar ) : ?>
            <div class="nm-post-sidebar-col col-md-4 col-sm-12 col-xs-12">
                <?php get_sidebar(); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
		
	<?php endwhile; ?>
		   
<?php else : ?>

	<div class="col col-xs-8 centered">
		<?php get_template_part( 'content', 'none' ); ?>
	</div>
	
<?php endif; ?>

<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
?>
	<div class="nm-comments">
		<div class="nm-row">
			<div class="<?php echo $post_column_class; ?>">
				<?php comments_template(); ?>
			</div>
		</div>
	</div>
<?php endif; ?>
    
</div>

<?php get_footer(); ?>
