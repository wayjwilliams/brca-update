<?php
	$absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
 	$wp_load = $absolute_path[0] . 'wp-load.php';
	require_once($wp_load);
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here", DPTPLNAME));
global $dynamo_tpl; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js" type="text/javascript"></script>
	<script language="javascript" type="text/javascript" src="<?php echo home_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/back-end/jquery.selectBox.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/back-end/dp_selectBox.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/back-end/libraries/spectrum/spectrum.js"></script>
    <script>
 function addColorPicker(inputField, colorSelector, defaultColor) {
	jQuery(colorSelector).spectrum({
    showAlpha: true,
    showInput: true,
	preferredFormat: "hex",
	chooseText: "Select"
	});
	jQuery(colorSelector).spectrum("set", defaultColor);
	jQuery(colorSelector).change(function() {
	jQuery(inputField).attr('value',jQuery(colorSelector).spectrum("get"));	
	})
	jQuery(inputField).change(function() {
		newColor = jQuery(inputField).val();
		jQuery(colorSelector).spectrum("set", newColor);
		}
	)
    }(jQuery)
function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function insertIcon() {
	
	var shortcodeText;
	var size = document.getElementById('dp_icon_boxes_size').value;
	var badge = document.getElementById('dp_icon_boxes_badge').value;
	var badgecolor = document.getElementById('badge_bg').value;
	var iconcolor = document.getElementById('icon_color').value;
	var icon =  document.getElementById('dp_icon_boxes_icon').value;
	if (icon == '') icon = 'icon-wordpress';
		shortcodeText = "[icon size='"+size+"' color='"+iconcolor+"' icon='"+icon+"' ";
		if (badge >=1) {
			switch (badge) {
			  case "1":
				badge = 'rounded';
				break;
			  case "2":
				badge = 'squared';
				break;
			  case "3":
				badge = 'diamond';
				break;
			  case "4":
				badge = 'rounded outlined';
				break;
			  case "5":
				badge = 'squared outlined';
				break;
			  case "6":
				badge = 'diamond outlined';
				break;
			  default:
				badge = '';
			}

		shortcodeText = shortcodeText+"badge='badge "+badge+"' " +"badgecolor='"+badgecolor+"'";	
		}	
		shortcodeText = shortcodeText +"]";		
		tinyMCEPopup.editor.insertContent(shortcodeText);		
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	return;
} </script>
   <script type="text/javascript">
   jQuery(document).ready(function(){
	jQuery(".icons-list li").click(function() {
	var icon = jQuery(this).data('icon');
	jQuery("#dp_icon_boxes_icon").val(icon);
	jQuery(".preview-icon").html("<i class=\'"+icon+"\'></i>");
	});
  });

	</script>
 <script type="text/javascript">
	jQuery(document).ready( function () {
		jQuery('#dp_icon_boxes_badge').change(function(){
			if ( jQuery(this).val() == '0' ) {
				  jQuery("#badgecolor_panel").slideUp("fast");
			}
			if ( jQuery(this).val() >= '1' ) {
				 jQuery("#badgecolor_panel").slideDown("slow");
			}
		});
		
	});
	</script>
    <base target="_self" />
   
<link href="<?php echo get_template_directory_uri(); ?>/css/back-end/jquery.selectBox.css" rel="stylesheet" type="text/css">
<link href="<?php echo get_template_directory_uri(); ?>/js/back-end/libraries/spectrum/spectrum.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" id="vc-icon-manager-css" href="<?php echo get_template_directory_uri(); ?>/dynamo_framework/font_icon_manager/assets/css/icon-manager.css?ver=4.0" type="text/css" media="all">
<link href="dialog_style.css" rel="stylesheet" type="text/css">
<?php $fonts = get_option('dp_font_icons');
				$upload_dir = wp_upload_dir(); 

				if(is_array($fonts))
				{
					foreach($fonts as $font => $info)
					{
					echo '<link rel="stylesheet" href="'.$upload_dir['baseurl'].'/dp_font_icons/'.$info['style'].'">';	
					}
				}
?>
<style type="text/css">
.smile_icon {padding-left:3px;}
</style>

</head>
<body>

	<form name="<?php echo get_template_directory_uri().'_shortcode'; ?>" action="#">
	
    <div class="panel_wrapper height300">
                  <table border="0" cellpadding="4" cellspacing="0">
                <tr>
					<td nowrap="nowrap" width="130"><label for="dp_icon_boxes_size" >Select icon size:</label></td>
					<td> 
                    
                    <select name="dp_icon_boxes_size" id="dp_icon_boxes_size" class="width120">
                    		<option value="small">Small Icon </option>
                    		<option value="medium">Medium Icon </option>
                            <option value="large">Large Icon</option>
                            <option value="extralarge">Extra Large Icon</option>
                    </select>
					
					</td>
				  </tr>
                  <tr>
				   <td nowrap="nowrap"  width="240"><label >Select icon: </label></td>
				   <td>
				   <input type="hidden" id="dp_icon_boxes_icon" />
				   <?php echo get_dp_font_manager(); ?></td>
                </tr>
                  </table>
				<table border="0" cellpadding="4" cellspacing="0">
                  <tr>
					<td nowrap="nowrap" width="240"><label for="dp_icon_boxes_iconcolor" >Select icon color:</label></td>
					                
    				<td width="140"><input type="text" size="27" id="icon_color"  value="#555555" /></td>
    				<td width="60"><input type="text" id="icon_color_picker"  /></td>
				  </tr>
				</td>
				  </tr>
                  <tr>
					<td nowrap="nowrap"><label for="dp_icon_boxes_badge" >Icon Badge:</label></td>
					<td> 
                    
                    <select name="dp_icon_boxes_badge" id="dp_icon_boxes_badge" class="width120">
                    		<option value="0">No</option>
                            <option value="1">Rounded</option>
                            <option value="2">Squared</option>
                            <option value="3">Diamond</option>
                            <option value="4">Rounded Outlined</option>
                            <option value="5">Squared Outlined</option>
                            <option value="6">Diamond Outlined</option>
                    </select>
					
					</td>
				  </tr>
                  </table>
<div id="badgecolor_panel" style="display:none">
				<table border="0" cellpadding="4" cellspacing="0">
                  <tr>
					<td nowrap="nowrap" width="240"><label for="dp_icon_boxes_badgecolor" >Select Badge Color:</label></td>
					                
    				<td width="140"><input type="text"  size="27" id="badge_bg"  value="#D95B33" /></td>
    				<td width="60"><input type="text" id="badge_bg_picker"  /></td>
				  </tr>
					</td>
				  </tr>
                  </table>
</div>                  
                  
                   
<p class="usage">Select all shortcode options and click the "Insert" button to add it to your page.</p>
			
				<script>
  				addColorPicker('#badge_bg', '#badge_bg_picker', '999999');
  				addColorPicker('#icon_color', '#icon_color_picker', '555555');
 				</script>			
			
		
		
		
		
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="<?php echo "Cancel"; ?>" onClick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="<?php echo "Insert"; ?>" onClick="insertIcon();" />
		</div>
	</div>
</form>
</body>
</html>