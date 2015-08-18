<?php

/**
 *
 * The default template for displaying content column in medium blog
 *
 **/

global $dynamo_tpl,$post,$more;

do {
if(get_post_meta(get_the_ID(), "_dynamo-featured-video", true) != '') { ?>
	<p>
	<?php echo wp_oembed_get( get_post_meta(get_the_ID(), "_dynamo-featured-video", true) ); ?>
	</p>
<?php break; }

if(has_post_thumbnail() && get_post_format() != 'gallery') { ?>
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
<?php break; }

if(get_post_format() == 'gallery') { 
	$gallery = get_post_gallery( $post->ID, false );
	$images = explode(",", $gallery['ids']);

       if($gallery && isset($gallery['ids'])){ 
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
		  	<?php } else {
			the_post_thumbnail();
			};
			 break; }


} while (0);
?>	

