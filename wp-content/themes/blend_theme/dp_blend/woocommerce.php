<?php

/*
Template Name: WooCommerce
*/ 
global $dynamo_tpl;

$fullwidth = true;

if(get_option($dynamo_tpl->name . '_woocommerce_show_sidebar', 'N') == 'Y') :
	$fullwidth = false;
endif;
if(isset($_GET['listing_sidebar'])) {
if($_GET['listing_sidebar'] == "yes") $fullwidth = false;
if($_GET['listing_sidebar'] == "no") $fullwidth = true;
}
dp_load('header');
if($fullwidth == false) :
	dp_load('before-woocommerce');
else :
	dp_load('before-woocommerce', null, array('sidebar' => false));
endif;


?>

<div id="dp-mainbody">
	<?php do_action('woocommerce_before_main_content'); ?>

	<?php woocommerce_content(); ?>
	
	<?php do_action('woocommerce_after_main_content'); ?>
</div>
<?php

if($fullwidth == false) :
	dp_load('after');
else :
	dp_load('after', null, array('sidebar' => false));
endif;

dp_load('footer');

// EOF