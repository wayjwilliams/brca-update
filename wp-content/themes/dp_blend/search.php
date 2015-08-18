<?php

/**
 *
 * Search page
 *
 **/

global $dynamo_tpl;

dp_load('header');
dp_load('before');

?>

<section id="dp-mainbody" class="search-page">
	<?php if ( have_posts() ) : ?>
		<?php 
			get_search_form(); 
			$founded = false;
		?>
        <div class="space20"></div>
		<div>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
			
				get_template_part( 'content', get_post_format() );
				$founded = true;
			?>
		<?php endwhile; ?>
		</div>
		<?php dp_content_nav(); ?>
	
		<?php if(!$founded) : ?>
		<h2>
			<?php __( 'Nothing Found', DPTPLNAME ); ?> 
     
		</h2>
		
		<section class="intro">
			<?php __( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', DPTPLNAME ); ?>
		</section>
		<?php endif; ?>
	
	<?php else : ?>				
		<h1 class="page-title">
			<?php __( 'Nothing Found', DPTPLNAME ); ?>
		</h1>
		
		<?php get_search_form(); ?>
		
		<section class="intro">
			<p><?php __( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', DPTPLNAME ); ?></p>
		</section>
	<?php endif; ?>
</section>

<?php

dp_load('after');
dp_load('footer');

// EOF