<?php

// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');

global $dynamo_tpl;

?>

<?php if(get_option($dynamo_tpl->name . '_header_search', 'Y') == 'Y') : ?>
<div class="search-overlay">
		<div class="overlay-close"><i class="icon-times-circle"></i></div>
        	<div class="dp-page">
                    <form method="get" id="searchform" action="<?php echo get_site_url(); ?>">
                    <input type="text" class="field" name="s" id="s" placeholder="Start typing..." value="">
                    </form>            
            		</div>
            </div>
<?php endif; ?>