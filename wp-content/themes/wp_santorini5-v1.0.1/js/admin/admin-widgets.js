jQuery(document).ready(function($) {

	"use strict";

	//Post Types Widget
	if( $('div[id*="ci_post_type_widget"]').length > 0 ) {

		$('.widgets-holder-wrap').on('change', 'select[id*="ci_post_type_widget"][name*="\\[post_type_name\\]"]', function(){

			var post_type_dropdown = $(this);

			$.ajax({
				type: "post",
				url: ThemeWidget.ajaxurl,
				data: {
					action: 'ci_widget_post_type_ajax_get_posts',
					post_type_name: $(this).val(),
					name_field: post_type_dropdown.siblings('.ci_widget_post_type_posts_dropdown').children('select').attr('name')
				},
				dataType: 'text',
				beforeSend: function() {
					post_type_dropdown.siblings('.loading_posts').show();
				},
				success: function(response){
					if(response != '') {
						post_type_dropdown.siblings('.ci_widget_post_type_posts_dropdown').html(response);
					}
					else {
						post_type_dropdown.siblings('.ci_widget_post_type_posts_dropdown').children('select').html('');
					}

					post_type_dropdown.siblings('.loading_posts').hide();

				}
			});//ajax

		});
	}

});