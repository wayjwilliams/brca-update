// Menu icon precview initiate

jQuery(document).ready(function(){
		jQuery('.edit-menu-item-icon').each(function(){
			if( jQuery(this).val().length != 0 ) {
			previewid = '#'+jQuery(this).data("preview");
			jQuery(previewid).html('<i class="'+ jQuery(this).val() + '"></i>');
    	}

		});
});


