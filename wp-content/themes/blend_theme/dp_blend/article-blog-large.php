<?php

/**
 *
 * The default template for displaying content
 *
 **/

global $dynamo_tpl,$post,$more;
$postclasses = array(
		'bigimages'
	);

if (get_option($dynamo_tpl->name . '_postmeta_date_state','Y') == 'Y' && get_option($dynamo_tpl->name . '_postmeta_date_style','default') == 'big') {
array_push($postclasses, 'bigdate');
}
?>	
    <article id="post-<?php the_ID(); ?>" <?php post_class($postclasses); ?>>
    <?php if (get_option($dynamo_tpl->name . '_postmeta_date_state','Y') == 'Y' && get_option($dynamo_tpl->name . '_postmeta_date_style','default') == 'big') {  ?>
    <div class="bigdate-container">
    <div class="day">
    <?php echo mysql2date('j',get_post()->post_date); ?>
    </div>
    <div class="month">
    <?php echo mysql2date('M',get_post()->post_date); ?>
    </div>
    <div class="year">
    <?php echo mysql2date('Y',get_post()->post_date); ?>
    </div>
    <?php if(get_post_format() != '') : ?>
	 		<div class="format dp-format-<?php echo get_post_format(); ?>"></div>
	<?php endif; ?>	
    </div>
    <?php
    }
		// if there is a Featured Video
		if(get_post_meta(get_the_ID(), "_dynamo-featured-video", true) != '') : 
	?>
	<p>
	<?php echo wp_oembed_get( get_post_meta(get_the_ID(), "_dynamo-featured-video", true) ); ?>
	</p>
	<?php elseif(has_post_thumbnail() && get_post_format() != 'gallery') : ?>
	<figure class="featured-image">
		<a href="<?php the_permalink(); ?>">
        <div class="text-overlay"> 
		<div class="info">
        <span class="rdbutton"></span>
    	</div>
        </div>
		<?php the_post_thumbnail(); ?>
            
		</a>
	</figure>
    <div class="space40"></div>
	<?php endif; ?>
    <?php if (get_post_format() == 'gallery')  {  
				// Load images
	$gallery = get_post_gallery( $post->ID, false );
	$images = explode(",", $gallery['ids']);

			?>
        <?php if($gallery): 
		dynamo_add_flex();
		?>
        <div class="clearboth"></div>
			<div id="gallery" class="flexgallery">
                    			<?php 
					$gallery_id = "flexslider_".mt_rand();
					$output = '<script type="text/javascript">'."\n";
					$output .= "   jQuery(window).load(function() {"."\n"; 
					$output .=  "jQuery('#".$gallery_id."').flexslider({"."\n";
					$output .=  '    animation: "slide",'."\n";
					$output .=  '    slideshowSpeed:"5000",'."\n";
					$output .=  '    controlNav: false,'."\n";
					$output .=  '    pauseOnHover: true,'."\n";
					$output .=  '    smoothHeight: true'."\n";
					$output .=  "  });"."\n";      
					$output .= "   });"."\n";
					$output .= "</script>"."\n";
					echo $output; 
				?>

            <div class="flexslider" id="<?php echo $gallery_id; ?>"><ul class="slides">
				<?php 
					foreach($images as $image) : 
					$src = wp_get_attachment_image_src( $image, 'full' );
				?>
				<li><figure class="noscale">
				<img src="<?php echo $src[0]; ?>" />
				</figure></li>
				<?php 
					endforeach;
				?>
			</ul></div>
			</div>
		  	<?php endif;
				}
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
		   case 'status':
				echo '<i class="Default-chat3"></i>';
				the_content('');
				$more =1;
				 break;
		   case 'audio':
				$more = 0;
				the_content('');
				$more =1;
				 break;		   case 'video':
				$more = 0;
				the_excerpt();
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
	</article>