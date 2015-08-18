<?php
$output = $el_class = $css = $parallax_bg = $video_bg = $video_webm = $video_mp4 = $video_ogv = $video_yt = $video_image = $use_raster = $start_at = $type = $mute = $mute_btn = $full_height = $content_placement = $no_paddings = '';
extract(shortcode_atts(array(
    'el_class'        => '',
	'el_id' => '',
	'type'            => 'grid',
	'useoverlay' => '',
	'overlaycolor' => '',
	'overlaypattern' => '',
	'parallax_bg'	  => '',
	'parallax_speed' => '',
	'video_bg'		  => '',
	'video_webm'      => '',
	'video_mp4'       => '',
	'video_ogv'       => '',
	'video_yt'        => '',
	'video_image'     => '',
	'use_raster'      => '',
	'start_at'        => '',
	'mute'			  => 'muted',
	'mute_btn'        => '',
        'full_height' => '',
        'content_placement' => '',
        'no_paddings' => '',
        'css' => ''
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);
$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
if (strtolower($no_paddings) == 'true') {
$css_classses[] = " no_columns_padding";
}
if ( ! empty( $full_height ) ) {
	$css_classes[] = ' vc_row-o-full-height';
	if ( ! empty( $content_placement ) ) {
		$css_classes[] = ' vc_row-o-content-' . $content_placement;
	}
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$row_id =uniqid("fws_");
if ( $el_id != ''  ) {
	$row_id = $el_id;
}

		$output .= '<div id="'.$row_id.'" class="'.$css_class.'">';
		 if (strtolower($useoverlay) == 'true') {
		 $overlaystyle = ' style="background-color:'.$overlaycolor.';background-image:url('.get_template_directory_uri().'/images/overlay_patterns/'.$overlaypattern.');"'; 
		 $output .= '<div class="row-overlay"'.$overlaystyle.'></div>';
		 }
		if(strtolower($parallax_bg) == 'true') {
		$output .= '<div class= "parallax-bg" style="pointer-events: none; background-attachment: fixed; background-color: rgba(0, 0, 0, 0); background-size: cover; background-repeat: no-repeat;" data-speed="'.$parallax_speed.'"></div>';
		}
        if ($video_bg == "html5videobg") { 
                $output .= '<div id="video-container">';
				
                $output .= '<video autoplay loop ';
				if ($mute == 'muted') $output .= 'muted '; 
				$output .= 'class="fillWidth video-'.$row_id.'">';
                if ($video_mp4 !='') {  
                $output .= '<source src="'.$video_mp4.'" type="video/mp4"/>';
                }
                if ($video_webm !='') {  
                $output .= '<source src="'.$video_webm .'" type="video/webm"/>';
                }
                if ($video_ogv !='') { 
                $output .= '<source src="<?php echo $video_ogv ?>" type="video/ogg"/>'; 
                }
                $output .= 'Your browser does not support the video tag. I suggest you upgrade your browser.'; 
                $output .= '</video>'; 
				if ($mute == 'muted') {
				if(strtolower($mute_btn) == 'true') {$output .= '<a class="dp-video-mute-button mute"></a>';}
				} else {
				if(strtolower($mute_btn) == 'true') {$output .= '<a class="dp-video-mute-button unmute"></a>';}
				}
                $output .= '</div>'; 
            if (strtolower($mute_btn) == 'true') { 
            $output .= '<script type="text/javascript">
            jQuery(document).ready(function(){
            jQuery("#'.$row_id.' .dp-video-mute-button").click(function(event){
                event.preventDefault();
                if( jQuery("#'.$row_id.' .dp-video-mute-button").hasClass("unmute") ) {
                                            jQuery(this).removeClass("unmute").addClass("mute");														
											if( jQuery(".video-'.$row_id.'").prop("muted") ) {
													  jQuery(".video-'.$row_id.'").prop("muted", false);
												} else {
												  jQuery(".video-'.$row_id.'").prop("muted", true);
												}
											  } else {
                                            jQuery(this).removeClass("mute").addClass("unmute");
											if( jQuery(".video-'.$row_id.'").prop("muted") ) {
													  jQuery(".video-'.$row_id.'").prop("muted", false);
												} else {
												  jQuery(".video-'.$row_id.'").prop("muted", true);
												}
                                        }
                });
            
            });
            </script>';		
                     }				
		}
		if ($video_bg == "ytvideobg" && $video_yt !="") {
			$video_options = "showControls:false, autoPlay:true, loop:true, quality:'default',opacity:1";
			if ($start_at !='') $video_options .=", startAt:".$start_at;
			if ($use_raster == 'use_raster') $video_options .= ", addRaster:true";
			if ($mute == 'muted') {
			 $video_options .= ", mute:true";
			 if(strtolower($mute_btn) == 'true') {$output .= '<a class="dp-video-mute-button mute"></a>';}
			 } else {
			 if(strtolower($mute_btn) == 'true') {$output .= '<a class="dp-video-mute-button unmute"></a>';}
			}
			
            if (strtolower($mute_btn) == 'true') { 
            $output .= '<script type="text/javascript">
            jQuery(document).ready(function(){
            jQuery("#'.$row_id.' .dp-video-mute-button").click(function(event){
                event.preventDefault();
                if( jQuery("#'.$row_id.' .dp-video-mute-button").hasClass("unmute") ) {
                                            jQuery(this).removeClass("unmute").addClass("mute");														
                                            jQuery("#video-'.$row_id.'").muteYTPVolume();
                                        } else {
                                            jQuery(this).removeClass("mute").addClass("unmute");
                                            jQuery("#video-'.$row_id.'").unmuteYTPVolume();
                                        }
                });
            
            });
            </script>';		
                     }
           ?>
            <a id="video-<?php echo $row_id ?>" class="mb_ytplayer" data-property="{videoURL:'<?php echo $video_yt;  ?>',containment:'#<?php echo $row_id ?>', <?php echo $video_options ?>}"></a>
		<?php	} 
	if(is_page_template('template.fullwidth.vc.php') &&  $type =='grid') $output .= '<div class="dp-page vc">';
	$output .= wpb_js_remove_wpautop($content);
	if(is_page_template('template.fullwidth.vc.php') &&  $type =='grid') $output .= '</div>';
	$output .= '</div>';


echo $output;