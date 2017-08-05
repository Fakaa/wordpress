jQuery(document).ready(function($) {

	//
	// Room edit scripts
	//
	
	// Repeating fields
	if($('#ci_cpt_room_meta').length > 0) {
		$('#ci_cpt_room_meta .amenities .inside').sortable();
		$('#amenities-add-field').click( function() {
			$('.amenities .inside').append('<p class="amenities-field"><input type="text" name="ci_cpt_room_amenities[]" /> <a href="#" class="amenities-remove button">' + ThemeText.remove_me + '</a></p>');
			return false;		
		});
		$('#ci_cpt_room_meta').on('click', '.amenities-remove', function() {
			$(this).parent('p').remove();
			return false;
		});
	}

}); 
