<?php 
	
	/**
	 *
	 * Template elements after the page content
	 *
	 **/
	
	// create an access to the template main object
	global $dynamo_tpl;
	// disable direct access to the file	
	defined('DYNAMO_WP') or die('Access denied');
	
?>
		
			</div><!-- end of the #dp-content-wrap -->
			
			</section><!-- end of the mainbody section -->
		
			<?php 
			if(
				get_option($dynamo_tpl->name . '_sidebar_position', 'right') != 'none' && 
				(dp_is_active_sidebar('sidebar') || (dp_is_active_sidebar('woosidebar'))) && 
				(
					$args == null || 
					($args != null && $args['sidebar'] == true )
				)
			) : ?>
			<?php do_action('dynamowp_before_column'); ?>
			<aside id="dp-sidebar">
            <?php 
			if (class_exists('Woocommerce') && is_woocommerce()) { dp_dynamic_sidebar('woosidebar');} else {dp_dynamic_sidebar('sidebar');} ?>
			</aside>
			<?php do_action('dynamowp_after_column'); ?>
			<?php endif; ?>
		</section><!-- end of the #dp-mainbody-columns -->
</section><!-- end of the .dp-page-wrap section -->	


<div class="clearboth"></div>