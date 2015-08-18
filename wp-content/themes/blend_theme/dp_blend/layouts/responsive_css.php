<?php 
	
	/**
	 *
	 * Template part loading the responsive CSS code
	 *
	 **/
	
	// create an access to the template main object
	global $dynamo_tpl;
	global $fullwidth;
	
	// disable direct access to the file	
	defined('DYNAMO_WP') or die('Access denied');
	
?>

<style type="text/css">
	<?php $boxed_template_width = (int)get_option($dynamo_tpl->name . '_template_width', 1230) ;
		 $vc_dp_page_width = (int)get_option($dynamo_tpl->name . '_template_width', 1230)+10;
		 $boxed_body_width = (int)get_option($dynamo_tpl->name . '_template_width', 1230)+40;
	 ?>
	.dp-page{max-width: <?php echo $boxed_template_width; ?>px;}
	.dp-page.vc {max-width: <?php echo $vc_dp_page_width; ?>px;}
	.boxed #dp-page-box {max-width: <?php echo $boxed_body_width; ?>px;}
	<?php if(
		get_option($dynamo_tpl->name . '_sidebar_position', 'right') != 'none' && 
		(is_active_sidebar('sidebar') || is_active_sidebar('woosidebar')) && 
		($fullwidth != true)
	) : ?>
	#dp-mainbody-columns > aside { width: <?php echo get_option($dynamo_tpl->name . '_sidebar_width', '30'); ?>%;}
	#dp-mainbody-columns > section { width: <?php echo 100 - get_option($dynamo_tpl->name . '_sidebar_width', '30'); ?>%; }
	#dp-mainbody-columns { background-position: <?php echo (get_option($dynamo_tpl->name . '_sidebar_position', 'right') == 'right') ? 100 - get_option($dynamo_tpl->name . '_sidebar_width', '30') : get_option($dynamo_tpl->name . '_sidebar_width', '30'); ?>% 0; }
	<?php else : ?>
	#dp-mainbody-columns > section { width: 100%; }
	<?php endif; ?>
	</style>