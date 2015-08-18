<?php

// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');

global $dynamo_tpl;

?>

<?php if(is_active_sidebar('aside')) : ?>
<div id="dp-dynamic-sidebar">
<i id="close-dynamic-sidebar" class="icon-times-circle"></i>
<div class="inner-wrap">
<?php dynamic_sidebar('aside'); ?>
</div>

</div>
<?php endif; ?>