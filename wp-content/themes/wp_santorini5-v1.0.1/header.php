<!doctype html>
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<title><?php ci_e_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php do_action('after_open_body_tag'); ?>

<div id="mobile-bar">
	<a class="menu-trigger" href="#mobilemenu"><i class="fa fa-bars"></i></a>
	<h1 class="mob-title"><?php bloginfo('name'); ?></h1>
</div>

<div id="page">
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<div class="row pre-head">
						<div class="col-sm-6">
							<div id="weather">
								<i class="ywicon"></i>
								<span id="ywloc"></span>
								<span id="ywtem"></span>
							</div>
						</div>

						<div class="col-sm-6">
							<?php dynamic_sidebar('header-widgets'); ?>
<!--							<div class="lang">-->
<!--								<a href="">Español</a>-->
<!--							</div>-->
						</div>
					</div> <!-- .row.pre-head -->
					<hr/>
					<nav class="nav row">
						<div class="col-sm-5">
							<?php
								wp_nav_menu( array(
									'theme_location' 	=> 'ci_main_menu_left',
									'fallback_cb' 		=> '',
									'container' 		=> '',
									'menu_id' 			=> '',
									'menu_class' 		=> 'navigation left-nav'
								));
							?>
						</div>

						<div class="col-sm-2">
							<?php ci_e_logo('<h1 class="logo ' . get_logo_class() . '">', '</h1>'); ?>
						</div>

						<div class="col-sm-5">
							<?php
								wp_nav_menu( array(
									'theme_location' 	=> 'ci_main_menu_right',
									'fallback_cb' 		=> '',
									'container' 		=> '',
									'menu_id' 			=> '',
									'menu_class' 		=> 'navigation right-nav'
								));
							?>
						</div>
					</nav>

					<div id="mobilemenu">
						<ul>
							<?php
								wp_nav_menu( array(
									'theme_location' 	=> 'ci_main_menu_left',
									'fallback_cb' 		=> '',
									'container' 		=> '',
									'menu_id' 			=> '',
									'menu_class' 		=> '',
									'items_wrap' => '%3$s'
								));

								wp_nav_menu( array(
									'theme_location' 	=> 'ci_main_menu_right',
									'fallback_cb' 		=> '',
									'container' 		=> '',
									'menu_id' 			=> '',
									'menu_class' 		=> '',
									'items_wrap' => '%3$s'
								));
							?>
						</ul>
					</div>
				</div> <!-- main container -->
			</div>
		</div>
	</header>