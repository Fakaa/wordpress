<html>
	<head>
		<title><?php _e( 'Form Preview', UFB_TD ); ?></title>
		<?php wp_head(); ?>
		<style>
			body:before{display:none !important;}
			body:after{display:none !important;}
			body{background:#F1F1F1 !important;}
		</style>

	</head>
	<body>
		<div class="ufb-preview-title-wrap">
			<div class="ufb-preview-title"><?php _e( 'Preview Mode', UFB_TD ); ?></div>
		</div>
		<div class="ufb-preview-note"><?php _e( 'This is just the basic preview and it may look different when used in frontend as per your theme\'s styles.', UFB_TD ); ?></div>
		<div class="ufb-form-preview-wrap">
			<?php
			$form_id = sanitize_text_field( $_GET['ufb_form_id'] );
			echo do_shortcode( '[ufb form_id="' . $form_id . '"]' );
			?>
		</div>
<?php wp_footer();?>
	</body>

</html>

