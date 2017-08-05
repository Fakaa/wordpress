<?php
add_action( 'widgets_init', 'ci_widgets_init' );
if ( !function_exists('ci_widgets_init') ) :
	function ci_widgets_init() {

		register_sidebar(array(
			'name' => __( 'Blog Sidebar', 'ci_theme'),
			'id' => 'blog-sidebar',
			'description' => __( 'Widgets placed in this sidebar will appear in the blog pages.', 'ci_theme'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));

		register_sidebar(array(
			'name' => __( 'Header Top Right', 'ci_theme'),
			'id' => 'header-widgets',
			'description' => __( 'Widgets here will appear on the top right of your header. It is designed to either hold the language selection widget (from WPML) or the Socials Ignited plugin.', 'ci_theme'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));

		register_sidebar(array(
			'name' => __( 'Homepage #1 Fullwidth', 'ci_theme'),
			'id' => 'homepage-widgets-1',
			'description' => __( 'Full width widget area under the homepage slideshow.', 'ci_theme'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));

		register_sidebar(array(
			'name' => __( 'Homepage #2 Three Column', 'ci_theme'),
			'id' => 'homepage-widgets-2',
			'description' => __( 'Widgets split into three columns right after the first full width widget area .', 'ci_theme'),
			'before_widget' => '<div class="col-sm-4"><aside id="%1$s" class="widget %2$s group">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));


		register_sidebar(array(
			'name' => __( 'Homepage #3 Side', 'ci_theme'),
			'id' => 'homepage-widgets-3',
			'description' => __( 'Widgets in the sidebar next to the news block.', 'ci_theme'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));

		register_sidebar(array(
			'name' => __( 'Pages Sidebar', 'ci_theme'),
			'id' => 'page-sidebar',
			'description' => __( 'Widgets placed in this sidebar will appear in the static pages.', 'ci_theme'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));

		register_sidebar(array(
			'name' => __( 'Rooms Sidebar', 'ci_theme'),
			'id' => 'room-sidebar',
			'description' => __( 'Widgets placed in this sidebar will appear in the room pages.', 'ci_theme'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));

		register_sidebar(array(
			'name' => __( 'Room Inset Sidebar', 'ci_theme'),
			'id' => 'room-inset-sidebar',
			'description' => __( 'Placeholder for a full width widget area which will appear inset in your room listing and room pages.', 'ci_theme'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));

		register_sidebar(array(
			'name' => __( 'Services Sidebar', 'ci_theme'),
			'id' => 'service-sidebar',
			'description' => __( 'Widgets placed in this sidebar will appear in the service pages.', 'ci_theme'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));

		register_sidebar(array(
			'name' => __( 'Attractions Sidebar', 'ci_theme'),
			'id' => 'attraction-sidebar',
			'description' => __( 'Sidebar for the attractions pages.', 'ci_theme'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));

		register_sidebar(array(
			'name' => __( 'Contact/Location page Sidebar', 'ci_theme'),
			'id' => 'sidebar-contact',
			'description' => __( 'Sidebar for the "Contact Page" template.', 'ci_theme'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));

	}
endif;
?>