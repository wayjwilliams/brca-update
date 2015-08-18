<?php

/**
 *
 * The default template for displaying content column in medium blog
 *
 **/

global $dynamo_tpl,$post,$more;

?>	
        
        
        
        <?php if (get_post_format() != 'link' && get_post_format() != 'quote' && get_post_format() != 'status' ){?>
		<header>
        <h2>
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', DPTPLNAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a>
			<?php if(is_sticky()) : ?>
            <sup>
                <?php _e( 'Featured', DPTPLNAME ); ?>
            </sup>
            <?php endif; ?>
        </h2>
	
		</header>
     <?php } ?>
     <?php dp_post_meta(); ?>
		<section class="summary <?php echo get_post_format(); ?>">
        <?php
		$post_format = get_post_format();
		switch ($post_format) {
		   case 'link':
				$more = 0;
				echo '<i class="Default-link"></i>';
				the_content('');
				$more =1;
				 break;
		   case 'audio':
				$more = 0;
				the_content('');
				$more =1;
				 break;
		   case 'status':
				echo '<i class="Default-chat3"></i>';
				the_content('');
				$more =1;
				 break;
		   case 'video':
				$more = 0;
				the_content('');
				$more =1;
				 break;
		   case 'quote':
				echo '<i class="Default-quote-right"></i>';
				the_content('');
				$more =1;
				 break;
		   case 'gallery':
		   		the_excerpt(); 
				break;
		  default:		
		  the_excerpt(); 
		  }
		?>
		</section>
		<?php get_template_part( 'layouts/content.post.footer' ); ?>
