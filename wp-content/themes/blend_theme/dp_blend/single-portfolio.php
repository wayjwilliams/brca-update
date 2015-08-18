<?php

/**
 *
 * Single page
 *
 **/

global $dynamo_tpl;
$fullwidth = true;
dp_load('header');
dp_load('before', null, array('sidebar' => false));
	$params_sharefacebook = get_option($dynamo_tpl->name . "_share_facebook","Y");
	$params_sharetwitter = get_option($dynamo_tpl->name . "_share_twitter","Y");
	$params_sharegoogle = get_option($dynamo_tpl->name . "_share_googleplus","N");
	$params_sharelinkedin = get_option($dynamo_tpl->name . "_share_linkedin","N");
	$params_sharepinterest = get_option($dynamo_tpl->name . "_share_pinterest","N");
	$params_sharereddit = get_option($dynamo_tpl->name . "_share_reddit","N");
	$params_shareemail = get_option($dynamo_tpl->name . "_share_email","N");
	$use_share = get_option($dynamo_tpl->name . "_enable_share_on_portfolio_single","Y");
	$share_title = get_option($dynamo_tpl->name . "_share_block_title","");
?>

<div id="dp-mainbody">
	<?php while ( have_posts() ) : the_post(); ?>
    <?php $first_embed = dp_get_first_embed_shortcode(get_the_content()); 
		  $toreplace =array('[embed]','[/embed]');
		  $first_embed_url = str_replace($toreplace,'',$first_embed);
		  $is_soundcloud = false;
		  if (strpos($first_embed_url,'soundcloud') !== false) {
    		$is_soundcloud = true;
		  }
	?>
    
	<?php $item_cats = get_the_terms($post->ID, 'portfolios');
		  if($item_cats):
			$count = count($item_cats);
			$cats = '';
			foreach($item_cats as $item_cat) {
				$cats .= $item_cat->name;
				if ($count > 1) $cats .= ', ';
				$count = $count -1;
			}
			endif;
	?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(is_page_template('template.fullwidth.php') ? ' page-fullwidth' : null); ?>>
        <ul class="item-nav">
            <?php previous_post_link("<li class='prev'> %link </li>", "<i class='Default-arrow-left9'></i>"); ?>
            <?php if (get_option($dynamo_tpl->name . '_portfolio_default_page') != '') : ?>
            <li class="all"><a href="<?php echo get_option($dynamo_tpl->name . '_portfolio_default_page'); ?>" title="<?php echo esc_attr__( 'All items', DPTPLNAME ) ?>"><i class="Default-th-large"></i></a></li>
            <?php endif ?>
            <?php next_post_link("<li class='next'> %link </li>", "<i class='Default-arrow-right9'></i>"); ?>
        </ul>
        <div class="clearboth"></div>
        <?php if (get_post_meta($post->ID, 'item_type', true)== 'c') { 	
		the_content();
		?>


		<?php } else {
		?>
		<?php if  (get_post_meta($post->ID, 'item_layout', true)== 'm') { 	?> 
        <div class="two_third">
        <header>
		<?php include('layouts/content.portfolio.header.php'); ?>
		</header>
      
       	<?php if (get_post_meta($post->ID, 'item_type', true)== 'v') : 	?>
        <?php if ( $first_embed_url != '') : ?>
        <?php 
		if ($is_soundcloud) {
		echo do_shortcode('[soundcloud url="'.$first_embed_url.'" params="color=00cc11&auto_play=false&hide_related=false&show_artwork=true" width="100%" height="166" iframe="true" /]');  
		} else {
		echo wp_oembed_get( $first_embed_url ); }?>
        <?php else :?>
        <div class="notification warning"><p><span>Warning! </span>This is a portfolio item <b>embed media</b> type. But you have not embed media in content. Please fill in this field.</p></div>
		<?php endif ?>
        <?php elseif (get_post_meta($post->ID, 'item_type', true)== 'g'):?>
        <?php dynamo_add_flex();?>
		<div class="content">
			<?php
				$gallery = get_post_gallery( $post->ID, false );
				$images = explode(",", $gallery['ids']);
			?>
			
			<?php if($gallery) { ?>
			<div id="gallery" class="flexgallery">
            
				<?php 
					$id = "flexslider_".mt_rand();
					$output = '<script type="text/javascript">'."\n";
					$output .= "   jQuery(window).load(function() {"."\n"; 
					$output .=  "jQuery('#".$id."').flexslider({"."\n";
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
                <div class="flexslider" id="<?php echo $id; ?>"><ul class="slides">
				<?php 
					foreach($images as $image) :
					$src = wp_get_attachment_image_src( $image, 'full' );
				?>
				<li><div>
					<img src="<?php echo $src[0]; ?>" />
					
				</div></li>
				<?php 
					endforeach;
				?>
			</ul></div>	
			</div>
		  	<?php } else { ?>
        <div class="notification warning"><p><span>Warning! </span> This is a portfolio item <b>gallery</b> type. But you have not create gallery in post content. </p></div>
            <?php }?>
		</div>
        
        <?php else : ?>
<?php        
$params = get_post_custom();
$params_image = isset($params['dynamo-post-params-featuredimg']) ? esc_attr( $params['dynamo-post-params-featuredimg'][0] ) : 'Y';
?>

<?php if(is_single() && $params_image == 'Y') : ?>
	<?php 
		// if there is a Featured Video
		if(get_post_meta(get_the_ID(), "_dynamo-featured-video", true) != '') : 
	?>
	
	<?php echo wp_oembed_get( get_post_meta(get_the_ID(), "_dynamo-featured-video", true) ); ?>
	
	<?php elseif(has_post_thumbnail()) : ?>
	<figure class="featured-image noscale">
		<?php the_post_thumbnail(); ?>
    <?php if (get_post_meta($post->ID, 'item_type', true)== 'm') :
		echo print_html_images(htmlspecialchars_decode(get_post_meta($post->ID, "item_addimages", true)),'all', '100%', '', '', false); 	
		endif
		?>
		<?php if(is_single()) : ?>
			<?php echo dp_post_thumbnail_caption(); ?>
		<?php endif; ?>
	</figure>
	<?php endif; ?>
<?php elseif(!is_single()) : ?>
	<?php 
		// if there is a Featured Video
		if(get_post_meta(get_the_ID(), "_dynamo-featured-video", true) != '') : 
	?>
	
	<?php echo wp_oembed_get( get_post_meta(get_the_ID(), "_dynamo-featured-video", true) ); ?>
	
	<?php elseif(has_post_thumbnail()) : ?>
	<div class="featured-image noscale">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
		
		<?php if(is_single()) : ?>
			<?php echo dp_post_thumbnail_caption(); ?>
		<?php endif; ?>
	</div>
    <?php if (get_post_meta($post->ID, 'item_type', true)== 'm') :
		echo print_html_images(htmlspecialchars_decode(get_post_meta($post->ID, "item_addimages", true)),'all', '100%', '', '', false); 	
		endif
		?>
	<?php endif; ?>
<?php endif; ?>
        <?php endif ?>
        </div>
        <div class="one_third_last">
        <div class="headline heading-line "><h3><?php echo __("Description", DPTPLNAME); ?></h3></div>
 
        <div class="content">
		<?php 
		$content = get_the_content();
		if (get_post_meta($post->ID, 'item_type', true)== 'v') $content = str_replace ( $first_embed,'',$content);
		$content = preg_replace('/\[gallery ids=[^\]]+\]/', '',  $content );
		$content = apply_filters('the_content', $content );
		echo $content;
	    ?>
        

        <ul class="item-details">
        <?php if( get_post_meta($post->ID, 'item_date', true) ): ?>
            <li><i class="icon-calendar51"></i><?php echo get_post_meta($post->ID, 'item_date', true); ?></li>
        <?php endif ?>
            <li><i class="icon-folder64"></i><?php echo $cats; ?></li>
        	<?php if( get_post_meta($post->ID, 'item_client', true) ): ?>
            <li><i class="icon-user91"></i><?php echo get_post_meta($post->ID, 'item_client', true); ?></li>
			<?php endif ?>
            <?php if( get_post_meta($post->ID, 'item_www', true) ): ?>
            <li><i class="icon-world86"></i><a href="<?php echo get_post_meta($post->ID, 'item_www', true); ?>"><?php echo get_post_meta($post->ID, 'item_www', true); ?></a></li>
            <?php endif ?>
          </ul>
        <?php if( get_post_meta($post->ID, 'item_date', true) || get_post_meta($post->ID, 'item_client', true) ) :
			 ?>
        <?php endif ?>
        <div class="clearboth"></div>		

        <?php if( get_post_meta($post->ID, 'item_link', true) ): ?>
        <div class="space30"></div>
        <p><a class="button_dp large color" href="<?php echo get_post_meta($post->ID, 'item_link', true); ?>" target="_blank"><span><?php echo  __("LAUNCH PROJECT", DPTPLNAME) ?></span></a></p>                
        <?php endif ?>
                <?php if ($use_share == "Y") { ?>
                <div class="portfolio-sharing-block">
                <?php if ($share_title != "") echo '<p>'.$share_title.'</p>'?>
                <div class="centered-block-outer"><div class="centered-block-middle"><div class="centered-block-inner">
				<?php dp_portfolio_item_social(get_the_ID(),$params_sharefacebook,$params_sharetwitter, $params_sharegoogle,$params_sharelinkedin,$params_sharepinterest,$params_sharereddit,$params_shareemail)?>
                </div></div></div>
                </div>
                <?php }?>

        </div>
        </div>
        <div class="clearboth"></div>
               

 		<?php }  else { ?>
 
        <div class = "media-full-wrap">
        <header>
		<?php include('layouts/content.portfolio.header.php'); ?>
		</header>
      
       	<?php if (get_post_meta($post->ID, 'item_type', true)== 'v') : 	?>
        <?php if ( $first_embed_url != '') : ?>
		<?php if ($is_soundcloud) {
		echo do_shortcode('[soundcloud url="'.$first_embed_url.'" params="color=00cc11&auto_play=false&hide_related=false&show_artwork=true" width="100%" height="166" iframe="true" /]');  
		} else {
		echo wp_oembed_get( $first_embed_url ); }?>
        <?php else :?>
        <div class="notification warning"><p><span>Warning! </span>This is a portfolio item <b>emed media</b> type. But you have not embed media in content. Please fill in this field.</p></div>
		<?php endif ?>
        <?php elseif (get_post_meta($post->ID, 'item_type', true)== 'g'):?>
        <?php dynamo_add_flex();?>
		<div class="content">
			<?php
				$gallery = get_post_gallery( $post->ID, false );
				$images = explode(",", $gallery['ids']);
			?>
			
			<?php if($gallery) { ?>
			<div id="gallery" class="flexgallery">
            
				<?php 
					$id = "flexslider_".mt_rand();
					$output = '<script type="text/javascript">'."\n";
					$output .= "   jQuery(window).load(function() {"."\n"; 
					$output .=  "jQuery('#".$id."').flexslider({"."\n";
					$output .=  '    animation: "slide",'."\n";
					$output .=  '    controlNav: false,'."\n";
					$output .=  '    slideshowSpeed:"5000",'."\n";
					$output .=  '    pauseOnHover: true,'."\n";
					$output .=  '    smoothHeight: true'."\n";
					$output .=  "  });"."\n";      
					$output .= "   });"."\n";
					$output .= "</script>"."\n";
					echo $output; 

				?>
                <div class="flexslider" id="<?php echo $id; ?>"><ul class="slides">
				<?php 
					foreach($images as $image) :
					$src = wp_get_attachment_image_src( $image, 'full' );
				?>
				<li><div>
					<img src="<?php echo $src[0]; ?>" />
					
				</div></li>
				<?php 
					endforeach;
				?>
			</ul></div>	
			</div>
		  	<?php } else { ?>
        <div class="notification warning"><p><span>Warning! </span> This is a portfolio item <b>gallery</b> type. But you have not create gallery in post content. </p></div>
            <?php }?>
		</div>
        
        <?php else : ?>
<?php        
$params = get_post_custom();
$params_image = isset($params['dynamo-post-params-featuredimg']) ? esc_attr( $params['dynamo-post-params-featuredimg'][0] ) : 'Y';
?>

<?php if(is_single() && $params_image == 'Y') : ?>
	<?php 
		// if there is a Featured Video
		if(get_post_meta(get_the_ID(), "_dynamo-featured-video", true) != '') : 
	?>
	
	<?php echo wp_oembed_get( get_post_meta(get_the_ID(), "_dynamo-featured-video", true) ); ?>
	
	<?php elseif(has_post_thumbnail()) : ?>
	<figure class="featured-image noscale">
		<?php the_post_thumbnail(); ?>
    <?php if (get_post_meta($post->ID, 'item_type', true)== 'm') :
		echo print_html_images(htmlspecialchars_decode(get_post_meta($post->ID, "item_addimages", true)),'all', '100%', '', '', false); 	
		endif
		?>
		<?php if(is_single()) : ?>
			<?php echo dp_post_thumbnail_caption(); ?>
		<?php endif; ?>
	</figure>
	<?php endif; ?>
<?php elseif(!is_single()) : ?>
	<?php 
		// if there is a Featured Video
		if(get_post_meta(get_the_ID(), "_dynamo-featured-video", true) != '') : 
	?>
	
	<?php echo wp_oembed_get( get_post_meta(get_the_ID(), "_dynamo-featured-video", true) ); ?>
	
	<?php elseif(has_post_thumbnail()) : ?>
	<div class="featured-image noscale">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
		
		<?php if(is_single()) : ?>
			<?php echo dp_post_thumbnail_caption(); ?>
		<?php endif; ?>
	</div>
    <?php if (get_post_meta($post->ID, 'item_type', true)== 'm') :
		echo print_html_images(htmlspecialchars_decode(get_post_meta($post->ID, "item_addimages", true)),'all', '100%', '', '', false); 	
		endif
		?>
	<?php endif; ?>
<?php endif; ?>
        <?php endif ?>
        </div>
        <div class="space60"></div>
        <div class="headline heading-line "><h3><?php echo __("Description", DPTPLNAME); ?></h3></div>
        <div class= "two_third">
        <div class="content">
        <?php $content = get_the_content();
		if (get_post_meta($post->ID, 'item_type', true)== 'v') $content = str_replace ( $first_embed,'',$content);
        $content = preg_replace('/\[gallery ids=[^\]]+\]/', '',  $content );
        $content = apply_filters('the_content', $content );
        echo $content;
		?>

        <?php
        if( get_post_meta($post->ID, 'item_link', true) ): ?>
        <div class="space10"></div>
        <p><a class="button_dp large color" href="<?php echo get_post_meta($post->ID, 'item_link', true); ?>" target="_blank"><span><?php echo  __("LAUNCH PROJECT", DPTPLNAME) ?></span></a></p>       
       
        <?php endif ?>
        <div class="clearboth"></div>

        </div>        
        </div>
        <div class="one_third_last">
        <div class="content">
        <ul class="item-details">
                               

        <?php if( get_post_meta($post->ID, 'item_date', true) ): ?>
            <li><i class="icon-calendar51"></i><?php echo get_post_meta($post->ID, 'item_date', true); ?></li>
        <?php endif ?>
            <li><i class="icon-folder64"></i><?php echo $cats; ?></li>
        	<?php if( get_post_meta($post->ID, 'item_client', true) ): ?>
            <li><i class="icon-user91"></i><?php echo get_post_meta($post->ID, 'item_client', true); ?></li>
			<?php endif ?>
            <?php if( get_post_meta($post->ID, 'item_www', true) ): ?>
            <li><i class="icon-world86"></i><a href="<?php echo get_post_meta($post->ID, 'item_www', true); ?>"><?php echo get_post_meta($post->ID, 'item_www', true); ?></a></li>
            <?php endif ?>
          </ul>
        <?php if( get_post_meta($post->ID, 'item_date', true) || get_post_meta($post->ID, 'item_client', true) ) :
			 ?>
        <?php endif ?>
        <div class="clearboth"></div>
                <?php if ($use_share == "Y") { ?>
                <div class="portfolio-sharing-block">
                <?php if ($share_title != "") echo '<p>'.$share_title.'</p>'?>
                <div class="centered-block-outer"><div class="centered-block-middle"><div class="centered-block-inner">
				<?php dp_portfolio_item_social(get_the_ID(),$params_sharefacebook,$params_sharetwitter, $params_sharegoogle,$params_sharelinkedin,$params_sharepinterest,$params_sharereddit,$params_shareemail)?>
                </div></div></div>
                </div>
                <?php }?>
		</div>
        </div>
        <div class="clearboth"></div>
 	<?php } }?> 
        
	<?php include('layouts/content.portfolio.footer.php'); ?>
	<?php if(get_option($dynamo_tpl->name . '_portfolio_show_comments_on_portfolio', 'Y') == 'Y') : ?>
    <?php comments_template( '', true ); ?>
	<?php endif; ?>
   

<?php endwhile; // end of the loop. ?>
</article>
<?php if (have_related_projects($post->ID)) { 
?>

 		<div class="headline heading-line "><h3><?php echo __("Related Projects", DPTPLNAME); ?></h3></div>

 <div class="related-projects">
        <?php dp_print_related_projects_grid($post->ID,10,4); ?>
   </div>
  <?php } ?>
        <div class="clearboth"></div>
        <div class="space70"></div>
   </div>


<?php

dp_load('after-nosidebar', null, array('sidebar' => false)); 
dp_load('footer');

// EOF