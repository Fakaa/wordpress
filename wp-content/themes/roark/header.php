<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />

		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
			roark_framework::roark_render_favicon(); 
		} ?>

		<?php wp_head(); ?>
		
	</head>
<body <?php body_class(); ?>>

	<?php roark_framework::roark_loader(); ?>

	<div id="page-wrap">
	
		<!-- HEADER -->
		<header id="header" class="mb-40">
			<div class="container">
				
				<?php if( class_exists('roark_framework') ) {
					roark_framework::roark_render_logo();
				} ?>

				<?php if ( has_nav_menu('roark-main-menu') ) : ?>
				<nav class="nav-menu">
					
					<?php if( class_exists('roark_framework') ) {
						roark_framework::roark_icon_social();
						roark_framework::roark_icon_search();
					} ?>
					
					<span class="toggle-menu"><i class="fa fa-bars"></i></span>
					
					<?php
						if ( is_page_template('template/portfolio.php') )
						{
							$setting = get_post_meta($post->ID, 'settings', true );
							if ( isset($setting['menu_specify']) && $setting['menu_specify'] != -1 )
							{
								$menuID = $setting['menu_specify'];
							}
						}

						if( !isset($menuID) && has_nav_menu('roark-main-menu') )
						{
							wp_nav_menu( array( 'theme_location' => 'roark-main-menu', 'menu_class' => 'menu', 'menu_id' => 'roark-menu', 'container'=> '') ); 
						}else{
							if ( isset($menuID) && !empty($menuID) )
							{
								wp_nav_menu( array( 'menu' => $menuID, 'menu_class' => 'menu', 'menu_id' => 'roark-menu', 'container'=> '') );
							}
						}
					?>
				</nav>
				<?php endif; ?>

			</div>
		</header>


<!-- livechat24-7.com widget -->  <script type = 'text/javascript'>window.$_liveChat247 || function(a, b) {b.$_liveChat247 = function(a, b) {var c = a.getElementsByTagName('head')[0];b._hostURL = 'https://www.livechat24-7.com';var d = a.createElement('script');d.src = b._hostURL + '/dashboard/liveChatIframe.js', d.type = 'text/javascript', c.appendChild(d), b._liveChat = {}, b._liveChat.profile = {accountId: '59845b026670b7016372eb8f'}}, b.$_liveChat247(a, b)}(document, window); </script> <!-- /livechat24-7.com widget --> 


		<!-- END / HEADER -->

		<!-- SEARCH FORM -->

		<?php if( class_exists('roark_framework') ) { 
			roark_framework::roark_popup_search_form(); 
			roark_framework::roark_popup_social(); 
		} ?>
		<!-- END / SEARCH FORM -->