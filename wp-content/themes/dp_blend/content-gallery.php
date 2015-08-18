<?php

/**
 *
 * The template for displaying posts in the Gallery Post Format on index and archive pages
 *
 **/

global $dynamo_tpl,$post,$more;
$params = get_post_custom();
$showtitle = false;
$params_title = isset($params['dynamo-post-params-title']) ? esc_attr( $params['dynamo-post-params-title'][0] ) : 'Y';
$params_subheader_use =  isset( $params['dynamo-post-params-subheader_use'] ) ? esc_attr( $params['dynamo-post-params-subheader_use'][0] ) : 'Y';
if ($params_title == 'Y' && $params_subheader_use == 'N') $showtitle = true;
?>
		<?php if ( is_search() || is_archive() || is_tag() || is_home() ) { 
				 if (get_option($dynamo_tpl->name . '_archive_style','big')=='big') {get_template_part( 'article-blog-large');}
				 if (get_option($dynamo_tpl->name . '_archive_style','big')=='small') {get_template_part( 'article-blog-medium'); }
		} else { 
		?>       
        <!--If is single --> 
        <article id="post-<?php the_ID(); ?>" <?php post_class('large'); ?>>
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
	?>
		<?php
				// Load images
	$gallery = get_post_gallery( $post->ID, false );
	$images = explode(",", $gallery['ids']);
		         if($gallery): 
		dynamo_add_flex();
		?>
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

		dp_post_meta(); ?>
        <?php if (get_post_format() != 'link' && get_post_format() != 'quote' && get_post_format() != 'status' && $showtitle ){?>
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
        
		<section class="content">

			<?php $content = get_the_content();
			$content = preg_replace('/\[gallery ids=[^\]]+\]/', '',  $content );
			$content = apply_filters('the_content', $content );
			echo $content;
			?>			
			<?php dp_post_links(); ?>
		</section>
	
		<?php get_template_part( 'layouts/content.post.footer' ); ?>
	</article>
      <?php } ?>