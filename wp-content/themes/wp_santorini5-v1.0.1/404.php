<?php get_header(); ?>

<main id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 full">
				<h2 class="page-title"><?php _e('Page not found', 'ci_theme'); ?></h2>

				<div class="row">
					<div class="col-xs-12">
						<article class="entry">
							<div class="entry-content row">
								<div class="col-md-8 col-md-offset-2">
									<h1><?php _e('The page you were looking for can not be found! Perhaps try searching?', 'ci_theme'); ?></h1>
									<?php get_search_form(); ?>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>