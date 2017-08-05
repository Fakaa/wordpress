<h2 class="page-title">
	<?php
		if ( is_home() or is_singular('post') ) :
			_e('From the Blog', 'ci_theme');
		elseif ( is_page() ) :
			single_post_title();
		elseif ( is_category()):
			single_term_title();
		elseif ( is_tax() ):
			single_term_title();
		elseif ( is_month()):
			single_month_title();
		elseif ( is_search() ):
			_e('Search Results', 'ci_theme');
		elseif ( is_404() ):
			_e('Oops! 404', 'ci_theme');
		elseif ( is_single() ) :
			single_post_title();
		endif;
	?>
</h2>