<?php

/**
 *
 * 404 Page
 *
 **/
 
global $dynamo_tpl; 
$fullwidth = true;
dp_load('header');
dp_load('before', null, array('sidebar' => false));

?>
<div id="dp-mainbody" class="page404">
	<h1><?php _e( '404', DPTPLNAME); ?></h1>
    <h3>Oops! Page Not Found</h3>
    <p>
		<?php _e( 'The page you are looking for does not exist; it may have been moved, or removed altogether. You might want to try the search function. Alternatively, return to the front page. ', DPTPLNAME); ?>
	</p>
	
    <p><a href="<?php echo home_url(); ?>" target="_self" class="button_dp line-white large"><span><i class="ss-left"></i> Back to Home Page</span></a></p>
    <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner">
        <ul class="social-bar rounded">
        <?php dp_social_bar_content(); ?>
        </ul>
        </div>
        </div>
        </div>
</div>

<?php

dp_load('after-nosidebar', null, array('sidebar' => false));
dp_load('footer');

// EOF