<?php if ( is_singular('gallery') ) : ?>
<div class="item">
	<figure class="item-thumb">
		<a data-rel="prettyPhoto[gal]" href="<?php echo ci_get_image_src($post->ID, 'large'); ?>">
			<img src="<?php echo ci_get_image_src($post->ID, 'ci_thumb'); ?>">
			<div class="overlay"><i class="fa fa-search-plus"></i></div>
		</a>
	</figure>
</div>

<?php else : ?>

<div <?php post_class('item'); ?>>
	<figure class="item-thumb">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('ci_thumb'); ?>
		</a>

		<?php
			if ( get_post_type() == 'room' ) :
			$offer = get_post_meta($post->ID, 'ci_cpt_room_offer', true);
			if ( !empty($offer) ) :
		?>
			<span class="offer"><?php _e('Special Offer', 'ci_theme'); ?></span>
		<?php endif; endif; ?>
	</figure>

	<div class="item-content">
		<a class="item-title btn" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<?php
			if ( get_post_type() == 'room' ) :
				$price = get_post_meta($post->ID, 'ci_cpt_room_from', true);
		?>

				<p class="item-sub"><?php echo __('from', 'ci_theme') . ' ' . $price; ?></p>
			<?php endif; ?>
	</div>
</div>

<?php endif; ?>