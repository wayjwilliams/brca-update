<?php
	$absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
 	$wp_load = $absolute_path[0] . 'wp-load.php';
	require_once($wp_load);
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here", DPTPLNAME));
global $dynamo_tpl; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" /> 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js" type="text/javascript"></script>
	<script language="javascript" type="text/javascript" src="<?php echo home_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/dynamo_framework/tinymce/js/buttons_dialog.js"></script>
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
 </script>
 <script type="text/javascript">
   jQuery(document).ready(function(){
	jQuery(".icons-list li").click(function() {
	var icon = jQuery(this).data('icon');
	jQuery("#dp_button_icon").val(icon);
	jQuery(".preview-icon").html("<i class=\'"+icon+"\'></i>");
	});
  });
 </script>
    <base target="_self" />
<link href="<?php echo get_template_directory_uri(); ?>/css/back-end/jquery.selectBox.css" rel="stylesheet" type="text/css">
<link href="<?php echo get_template_directory_uri(); ?>/js/back-end/libraries/spectrum/spectrum.css" rel="stylesheet" type="text/css">
<link href="dialog_style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" id="vc-icon-manager-css" href="<?php echo get_template_directory_uri(); ?>/dynamo_framework/font_icon_manager/assets/css/icon-manager.css?ver=4.0" type="text/css" media="all">
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
#dp_button_url {width:222px;}
</style>
</head>
<body>

	<form name="<?php echo $dynamo_tpl->name .'_shortcode'; ?>" action="#">
	
<div class="panel_wrapper"> 
           
	       <table border="0" cellpadding="4" cellspacing="0">
				 <tr>
				   <td width="120"><label >Button text: </label></td>
				   <td>
				     <input type="text" name="dp_button_text" id="dp_button_text" class="width260">
			      </td>
                  </tr>
                  <tr>
				   <td><label>Icon: </label></td>
				   <td>
				   <input type="hidden" id="dp_button_icon" />
				   <?php echo get_dp_font_manager(); ?></td>
			      </tr>
           </table>
	       <table border="0" cellpadding="4" cellspacing="0">
           <br/>
	       <table border="0" cellpadding="4" cellspacing="0">
				 <tr>
				   <td align="right" nowrap="nowrap" ><label >Button URL:</label></td>
				   <td width="290"><input type="text" name="dp_button_url" id="dp_button_url"></td>
				   <td><label >Open in: </label></td>
				   <td><select name="dp_button_target" id="dp_button_target" class="width190" >
				       <option value="_self">The same window</option>
				       <option value="_blank">New window</option>
		           </select></td>
				     
         </tr>
				 <tr>
					<td align="right" nowrap="nowrap"><label >Select style: </label></td>
					<td><select name="dp_button_style" id="dp_button_style" class="width180" >
					  <optgroup label="Predefined Styles">
                      <option value="">Default</option>
                      <option value="dark">Dark</option>
					  <option value="light">Light</option>
					  <option value="white">White</option>
					  <option value="blue">Blue</option>
					  <option value="green">Green</option>
					  <option value="orange">Orange</option>
					  <option value="yellow">Yellow</option>
                      <option value="red">Red</option>
					  <option value="purple">Purple</option>
					  <option value="pink">Pink</option>
					  <option value="gray">Gray</option>
                      <option value="line">Default Bordered</option>
					  <option value="line-white">White Bordered</option>
					  <option value="line-dark">Dark Bordered</option>
					  <option value="line-blue">Blue Bordered</option>
					  <option value="line-green">Green Bordered</option>
					  <option value="line-orange">Orange Bordered</option>
					  <option value="line-yellow">Yellow Bordered</option>
					  <option value="line-red">Red Bordered</option>
					  <option value="line-purple">Purple Bordered</option>
					  <option value="line-pink">Pink Bordered</option>
					  <option value="line-gray">Gray Bordered</option>
                      </optgroup>
                       <optgroup label="Read more style ">
                      <option value="readon">Read more</option>
                      </optgroup>
                      <optgroup label="Select this for custom colors">
                      <option value="custom">Custom</option>
                      </optgroup>
				    </select></td>
					<td align="right"><label >Size: </label></td>
					<td><select name="dp_button_size" id="dp_button_size" class="width190" >
					  <option value="small">Small</option>
					  <option value="large">Large</option>
                      <option value="extralarge">Extra Large</option>
				    </select></td>
				  </tr>
				</table>
				<p class="usage">Select all options and click the "Insert" button to add it to your page. If you want to create a custom button, please select <strong>Style => Custom</strong> above and use the options below.</p>
                <fieldset>
				<legend>Custom Button Settings</legend>
                <table border="0" cellspacing="5" cellpadding="2">
  <tr>
    <td width="130" align="right"><label >Button color: </label></td>
    <td width="140"><input type="text"  size="27" id="button_bg"  value="#fefefe" /></td>
    <td width="60"><input type="text" id="button_bg_picker"  /></td>
  
    <td width="130" align="right"><label >Button text color: </label></td>
    <td width="140"><input type="text"  size="27" id="button_text"  value="#000000" /></td>
    <td width="60"><input type="text" id="button_text_picker"  /></td>
  </tr>
  
</table>
</fieldset>

  <script>
  addColorPicker('#button_bg', '#button_bg_picker', 'ffffff');
  addColorPicker('#button_text', '#button_text_picker', '000000');
 </script>
	
</div>
	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="<?php echo "Cancel"; ?>" onClick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="<?php echo "Insert"; ?>" onClick="insertShortcode();" />
		</div>
	</div>
</form>
</body>
</html>