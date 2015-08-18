 <script type="text/javascript">
	jQuery(window).load( function () {
		jQuery("#addimages_slide_panel").hide();

		if ( jQuery('#item_type').val() == 'm' ) {
				  jQuery("#addimages_slide_panel").slideDown("slow");
			}
		jQuery('#item_type').change(function(){
			if ( jQuery(this).val() == 'i' ) {
				  jQuery("#addimages_slide_panel").slideUp("slow");
				  jQuery("#custom_slide_panel").slideDown("slow");
			}
			if ( jQuery(this).val() == 'g' ) {
				  jQuery("#addimages_slide_panel").slideUp("slow");
				  jQuery("#custom_slide_panel").slideDown("slow");
			}
			if ( jQuery(this).val() == 'v' ) {
				  jQuery("#addimages_slide_panel").slideUp("slow");
				  jQuery("#custom_slide_panel").slideDown("slow");
			}
			if ( jQuery(this).val() == 'm' ) {
				  jQuery("#addimages_slide_panel").slideDown("slow");
				  jQuery("#custom_slide_panel").slideDown("slow");
			}
			if ( jQuery(this).val() == 'c' ) {
				  jQuery("#custom_slide_panel").slideUp("slow");
			}
		});
	});
	</script>
<?php 
$values = get_post_custom( $post->ID );
$item_short_desc = isset( $values['item_short_desc'] ) ? esc_attr( $values['item_short_desc'][0] ) : '';
$item_layout = isset( $values['item_layout'] ) ? esc_attr( $values['item_layout'][0] ) : '';
$item_type = isset( $values['item_type'] ) ? esc_attr( $values['item_type'][0] ) : '';
$item_addimages = isset( $values['item_addimages'] ) ? esc_attr( $values['item_addimages'][0] ) : '';
$item_video = isset( $values['item_video'] ) ? esc_attr( $values['item_video'][0] ) : '';    
$item_link = isset( $values['item_link'] ) ? esc_attr( $values['item_link'][0] ) : ''; 
$item_client = isset( $values['item_client'] ) ? esc_attr( $values['item_client'][0] ) : '';
$item_date = isset( $values['item_date'] ) ? esc_attr( $values['item_date'][0] ) : '';
$item_www = isset( $values['item_www'] ) ? esc_attr( $values['item_www'][0] ) : '';
 ?>
<div class="my_meta_control">
	<label><?php _e("Define item short description <span>Will be used as subtitle in portfolio grid view</span>", DPTPLNAME); ?></label>
	<p>
		<input type="text" name="item_short_desc" id="item_short_desc" value="<?php echo $item_short_desc ?>"/>
	</p>
	<label><?php _e("Define media holder size <span>This settings have no affect when you select custom item type bellow</span>", DPTPLNAME); ?></label>
       <p>
        <select name="item_layout" id="item_layout" class="width180">
                            <option value="m" <?php if ($item_layout == "m") echo 'selected'; ?> ><?php _e("Medium", DPTPLNAME); ?></option>
                            <option value="f" <?php if ($item_layout == "f") echo 'selected'; ?>><?php _e("Full width", DPTPLNAME); ?></option>
        </select>
        </p>
	<label><?php _e("Define the type of portfolio item <span>(This choice determines the type of displayable content)</span>", DPTPLNAME); ?></label>
	
	<p class="note"><i><b>Note!</b><br/>An ''<b>Single image portfolio item</b>'' will be use fetured image as thumb and main image in single portfolio view.<br/>An ''<b>Multiple image portfolio item</b>'' will be use fetured image as thumb and main image in single portfolio view. Will be displayed also additional images (entered bellow) in single item view  <br/>An ''<b>Gallery portfolio item</b>'' vill be use featured image of post as thumb and  post gallery as source for slideshow in single portfolio view.<br/>An ''<b>Embed media item</b>'' will be use featured image as thumbnail and first embeded media (video, audio) in single portfolio view. <br/>An ''<b>Custom portfolio item</b>'' will be use featured image as thumbnail and free formated content (entered above) in single portfolio view. </i></p>
       <p>
        <select name="item_type" id="item_type" class="width180">
                            <option value="i" <?php if ($item_type == "i") echo 'selected'; ?> ><?php _e("Single Image", DPTPLNAME); ?></option>
                            <option value="m" <?php if ($item_type == "m") echo 'selected'; ?>><?php _e("Multiple image", DPTPLNAME); ?></option>
							<option value="g" <?php if ($item_type == "g") echo 'selected'; ?> ><?php _e("Gallery", DPTPLNAME); ?></option>
                            <option value="v" <?php if ($item_type == "v") echo 'selected'; ?>><?php _e("Embeded media", DPTPLNAME); ?></option>
                            <option value="c" <?php if ($item_type == "c") echo 'selected'; ?>><?php _e("Custom", DPTPLNAME); ?></option>

        </select>
        </p>
 <div id="custom_slide_panel">       
 <div id="addimages_slide_panel">	
 <label><?php _e("Item additional images <span>(only for multiple images item type)</span>", DPTPLNAME); ?></label>
 <?php _e("<span>Enter additional images for this item using media button.</span>", DPTPLNAME); ?>
	<p>
    <?php 
	wp_editor( htmlspecialchars_decode($item_addimages), 'item_addimages',$settings = array( 'media_buttons' => true,'textarea_rows' => 6)); ?>
		
	</p>
 </div>
<label><?php _e("Date of project <span>(optional)</span>", DPTPLNAME); ?></label>
	<p>
		<input type="text" name="item_date" id="item_date" value="<?php echo $item_date ?>"/>
	</p>	
<label><?php _e("Client name <span>(optional)</span>", DPTPLNAME); ?></label>
	<p>
		<input type="text" name="item_client" id="item_client" value="<?php echo $item_client ?>"/>
	</p>
<label><?php _e("WWW <span>(optional)</span>", DPTPLNAME); ?></label>
	<p>
		<input type="text" name="item_www" id="item_www" value="<?php echo $item_www ?>"/>
	</p>
<label><?php _e("Launch project URL <span>(optional)</span>", DPTPLNAME); ?></label>
	<p>
		<input type="text" name="item_link" id="item_link" value="<?php echo $item_link ?>"/>
	</p>
</div>
    </div>