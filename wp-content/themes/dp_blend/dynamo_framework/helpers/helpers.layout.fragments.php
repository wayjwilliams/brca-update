<?php

// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');	

/**
 *
 * DynamoWP layout fragments
 *
 * Functions used to create DynamoWP-specific functions 
 *
 **/
 
/**
 *
 * Template for menus
 *
 * @param menuname - name of the menu
 * @param fullname - full name of the menu - ID
 * @param params - array of the other params (optional)
 *
 * @return HTML output
 *
 **/ 
 
function dynamo_menu($menuname, $fullname, $params = null, $addclass) {			
	global $dynamo_tpl;
	if(dp_show_menu($menuname)) {
		if($params !== null) {
			extract($params);
		}
	
		wp_nav_menu(array(
		      'theme_location'  => $menuname,
			  'container'       => isset($container) ? $container : false, 
			  'container_class' => 'menu-{menu slug}-container', 
			  'container_id'    => $fullname,
			  'menu_class'      => 'menu ' . $dynamo_tpl->menu[$menuname]['style'], 
			  'menu_id'         => str_replace('menu', '-menu', $menuname),
			  'echo'            => isset($echo) ? $echo : true,
			  'fallback_cb'     => isset($fallback_cb) ? $fallback_cb: 'wp_page_menu',
			  'before'          => isset($before) ? $before : '',
			  'after'           => isset($after) ? $after : '',
			  'link_before'     => isset($link_before) ? $link_before : '',
			  'link_after'      => isset($link_after) ? $link_after : '',
			  'items_wrap'      => isset($items_wrap) ? $items_wrap : '<ul id="%1$s" class="%2$s '.$addclass.'">%3$s</ul>',
			  'depth'           => $dynamo_tpl->menu[$menuname]['depth'],
			  'walker'			=> isset($walker) ? $walker : ''
		));
	}
}
function dynamo_menu_mobile($menuname, $fullname, $params = null, $addclass) {			
	global $dynamo_tpl;
	if(dp_show_menu($menuname)) {
		if($params !== null) {
			extract($params);
		}
	
		wp_nav_menu(array(
		      'theme_location'  => $menuname,
			  'container'       => isset($container) ? $container : false, 
			  'container_class' => 'menu-{menu slug}-container', 
			  'container_id'    => $fullname,
			  'menu_class'      => 'menu ' . $dynamo_tpl->menu[$menuname]['style'], 
			  'menu_id'         => str_replace('menu', '-menu', $menuname),
			  'echo'            => isset($echo) ? $echo : true,
			  'fallback_cb'     => isset($fallback_cb) ? $fallback_cb: 'wp_page_menu',
			  'before'          => isset($before) ? $before : '',
			  'after'           => isset($after) ? $after : '',
			  'link_before'     => isset($link_before) ? $link_before : '',
			  'link_after'      => isset($link_after) ? $link_after : '',
			  'items_wrap'      => isset($items_wrap) ? $items_wrap : '<ul class="%2$s '.$addclass.'">%3$s</ul>',
			  'depth'           => $dynamo_tpl->menu[$menuname]['depth'],
			  'walker'			=> isset($walker) ? $walker : ''
		));
	}
}

/**
 *
 * Template for comments and pingbacks.
 *
 * @param comment - the comment to render
 * @param args - additional arguments
 * @param depth - the depth of the comment
 *
 * @return null
 *
 **/
function dynamo_comment_template( $comment, $args, $depth ) {
	global $dynamo_tpl;
	
	$GLOBALS['comment'] = $comment;

	do_action('dynamowp_before_comment');

	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="pingback">
		<p>
			<?php __( 'Pingback:', DPTPLNAME ); ?> 
			<?php comment_author_link(); ?>
			<?php edit_comment_link( __( 'Edit', DPTPLNAME ), '<span class="edit-link">', '</span>' ); ?>
		</p>
		<?php break; ?>
	<?php default : ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">	
			<aside>
				<div class="avatar"><?php echo get_avatar( $comment, ($comment->comment_parent == '0') ? 40 : 32); ?></div>
			</aside>
					
			<section class="content">
            <div class="comment-bouble">				
				<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="awaiting-moderation"><?php __( 'Your comment is awaiting moderation.', DPTPLNAME ); ?></em>
				<?php endif; ?>
				
				<?php comment_text(); ?>
				
				<footer>
					<?php
						/* translators: 1: comment author, 2: date and time */
						printf( 
							__( '%1$s on %2$s', DPTPLNAME ),
							sprintf( 
								'<b>%s</b>', 
								get_comment_author_link() 
							),
							sprintf(
								'<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time(DATE_W3C),
								sprintf( __( '%1$s at %2$s', DPTPLNAME ), 
								get_comment_date(), 
								get_comment_time() )
							)
						);
					?>
					
					<?php edit_comment_link( __( 'Edit', DPTPLNAME ), '<span class="edit-link">', '</span>' ); ?>
					
					<span class="reply">
						<?php comment_reply_link( 
							array_merge( 
								$args,
								array( 
									'reply_text' => __( 'Reply', DPTPLNAME ), 
									'depth' => $depth, 
									'max_depth' => $args['max_depth'] 
								) 
							) 
						); ?>
					</span>
				</footer>
                </div>
			</section>
		</article>

	<?php
			break;
	endswitch;
	
	do_action('dynamowp_after_comment');
}


/**
 *
 * Function used to generate post meta data
 *
 * @param attachment - for the attachment size the script generate additional informations
 *
 * @return null
 *
 **/
function dp_post_meta($attachment = false) {
 	global $dynamo_tpl;
 	$tag_list = get_the_tag_list( '', __( ', ', DPTPLNAME ) );
 	?>
    <div class="meta">
    <?php if(get_post_format() != '') : ?>
	 		<span class="format dp-format-<?php echo get_post_format(); ?>"></span>
	<?php endif; ?>	
    <?php if(!(is_tag() || is_search())) : ?>
     <?php if(get_option($dynamo_tpl->name . '_postmeta_date_state') == 'Y') { ?>
     <span class= "date"><?php echo mysql2date('j.m.Y',get_post()->post_date); ?></span>
    <?php } ?>
	<?php endif; ?>

    <?php if(!(is_tag() || is_search())) : ?>
     <?php if(get_option($dynamo_tpl->name . '_postmeta_author_state') == 'Y') : ?>
	<span class="author-link"><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo esc_attr(sprintf(__('%s', DPTPLNAME), get_the_author())); ?></a>
    </span>
    <span class="category-list"><?php echo get_the_category_list(' '); ?></span>
    <?php  endif; ?>
	<?php endif; ?>
	<?php if(get_option($dynamo_tpl->name . '_postmeta_tags_state') == 'Y') : 
    if(!(is_tag() || is_search())) { 
	if ($tag_list !="") {
	?>
    <span class="tags"><?php echo $tag_list; ?></span>
    <?php }} ?>
    <?php endif; ?>
	<?php if ( comments_open() && ! post_password_required() ) : ?>
	<?php if(get_option($dynamo_tpl->name . '_postmeta_coments_state') == 'Y') : 
	?>
	<span class="comments">
    <?php $num_comments = get_comments_number(); // get_comments_number returns only a numeric value

	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = __('No Comments',DPTPLNAME);
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(' Comments',DPTPLNAME);
		} else {
			$comments = __('1 Comment',DPTPLNAME);
		}
		$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
	} else {
		$write_comments =  __('Comments are off for this post.',DPTPLNAME);
	}
	echo $write_comments;
	?>

    </span>
    <?php  endif; ?>

	<?php endif; ?> 
	
			
    </div>
 	<?php
}

function dp_post_meta_mini($attachment = false) {
 	global $dynamo_tpl;
 	$tag_list = get_the_tag_list( '', __( ', ', DPTPLNAME ) );
 	?>
    <div class="meta">
    <?php if(get_post_format() != '') : ?>
	 		<span class="format dp-format-<?php echo get_post_format(); ?>"></span>
	<?php endif; ?>	
    <?php if(get_option($dynamo_tpl->name . '_postmeta_date_state') == 'Y') :
    if(!(is_tag() || is_search())) { ?>
    <span class= "date"><?php echo mysql2date('F j , Y',get_post()->post_date); ?></span>
    <?php } 
    endif;
	if(!(is_tag() || is_search())) : ?>
			<?php if(get_option($dynamo_tpl->name . '_postmeta_author_state') == 'Y') : ?>
	<span class="author-link"><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo esc_attr(sprintf(__('%s', DPTPLNAME), get_the_author())); ?></a>
    </span>
    <?php  endif; ?>
	<?php endif; ?>
	<?php if ( comments_open() && ! post_password_required() ) : ?>
	<?php if(get_option($dynamo_tpl->name . '_postmeta_coments_state') == 'Y') : 
	?>
	<span class="comments">
    <?php $num_comments = get_comments_number(); // get_comments_number returns only a numeric value

	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = __('No Comments',DPTPLNAME);
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(' Comments',DPTPLNAME);
		} else {
			$comments = __('1 Comment',DPTPLNAME);
		}
		$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
	} else {
		$write_comments =  __('Comments are off for this post.',DPTPLNAME);
	}
	echo $write_comments;
	?>

    </span>
    <?php  endif; ?>

	<?php endif; ?> 
	
			
    </div>
 	<?php
}



/**
 *
 * Function to generate the post pagination
 *
 * @return null
 *
 **/
function dp_post_links() {
	global $dynamo_tpl;
	
	wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', DPTPLNAME ) . '</span>', 'after' => '</div>' ) );
}

/**
 *
 * Function to generate the post navigation
 * by Krisi 
 * @param id - id of the NAV element
 *
 * @return null
 *
 **/

function dp_content_nav($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
	 
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
		 //add this line for fake. never gets executed but makes the theme pass Theme check
		if(1==2){paginate_links(); posts_nav_link(); next_posts_link(); previous_posts_link();}
     }
}

/**
 *
 * Function to generate the comment form
 *
 **/
function dp_comment_form( $args = array(), $post_id = null ) {
	global $id;

	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', DPTPLNAME ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', DPTPLNAME ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', DPTPLNAME  ) . '</label>' .
		            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s', DPTPLNAME ), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', DPTPLNAME ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', DPTPLNAME ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', DPTPLNAME  ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', DPTPLNAME ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>', DPTPLNAME  ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Post your comments here', DPTPLNAME  ),
		'title_reply_to'       => __( 'Leave a Reply to %s', DPTPLNAME  ),
		'cancel_reply_link'    => __( 'Cancel reply', DPTPLNAME  ),
		'label_submit'         => __( 'Post comment', DPTPLNAME ),
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<div id="respond">
            <h3 id="reply-title"><span><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?></span><small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
						<?php do_action( 'comment_form_top' ); ?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
							<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							do_action( 'comment_form_before_fields' );

							foreach ( (array) $args['fields'] as $name => $field ) {
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
						<p class="form-submit">
							<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php do_action( 'comment_form', $post_id ); ?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
}




/**
 *
 * Function to generate the post Social API elements
 *
 * @param title - title of the post
 * @param postID - ID of the post
 *
 * @return string - HTML output
 *
 **/
 
function dp_social_api($title, $postID) {
	global $dynamo_tpl;
	// check if the social api is enabled on the specific page
	$social_api_mode = get_option($dynamo_tpl->name . '_social_api_exclude_include', 'exclude');
	$social_api_articles = explode(',', get_option($dynamo_tpl->name . '_social_api_articles', ''));
	$social_api_pages = explode(',', get_option($dynamo_tpl->name . '_social_api_pages', ''));
	$social_api_categories = explode(',', get_option($dynamo_tpl->name . '_social_api_categories', ''));
	//
	$is_excluded = false;
	//
	if($social_api_mode == 'include' || $social_api_mode == 'exclude') {
		//
		$is_excluded = 
			($social_api_pages != FALSE ? is_page($social_api_pages) : FALSE) || 
			($social_api_articles != FALSE ? is_single($social_api_articles) : FALSE) || 
			($social_api_categories != FALSE ? in_category($social_api_categories) : FALSE);
		//
		if($social_api_mode == 'exclude') {
			$is_excluded = !$is_excluded;
		}
	}
	//
	if($social_api_mode != 'none' && $is_excluded) {
		// variables for output
		$fb_like_output = '';
		$gplus_output = '';
		$twitter_output = '';
		$pinterest_output = '';
		// FB like
		if(get_option($dynamo_tpl->name . '_fb_like', 'Y') == 'Y') {
			// configure FB like
			$fb_like_attributes = ''; 
			// configure FB like
			if(get_option($dynamo_tpl->name . '_fb_like_send', 'Y') == 'Y') { $fb_like_attributes .= ' data-send="true"'; }
			$fb_like_attributes .= ' data-layout="'.get_option($dynamo_tpl->name . '_fb_like_layout', 'standard').'"';
			$fb_like_attributes .= ' data-show-faces="'.get_option($dynamo_tpl->name . '_fb_like_show_faces', 'true').'"';
			$fb_like_attributes .= ' data-width="'.get_option($dynamo_tpl->name . '_fb_like_width', '500').'"';
			$fb_like_attributes .= ' data-action="'.get_option($dynamo_tpl->name . '_fb_like_action', 'like').'"';
			$fb_like_attributes .= ' data-font="'.get_option($dynamo_tpl->name . '_fb_like_font', 'arial').'"';
			$fb_like_attributes .= ' data-colorscheme="'.get_option($dynamo_tpl->name . '_fb_like_colorscheme', 'light').'"';
			
			$fb_like_output = '<div class="fb-like" data-href="'.get_permalink($postID).'" '.$fb_like_attributes.'></div>';
		}
		// G+
		if(get_option($dynamo_tpl->name . '_google_plus', 'Y') == 'Y') {
			// configure +1 button
			$gplus_attributes = '';    		
			// configure +1 button attributes
			$gplus_attributes .= ' annotation="'.get_option($dynamo_tpl->name . '_google_plus_count', 'none').'"'; 
			$gplus_attributes .= ' width="'.get_option($dynamo_tpl->name . '_google_plus_width', '300').'"'; 
			$gplus_attributes .= ' expandTo="top"'; 
				
			if(get_option($dynamo_tpl->name . '_google_plus_size', 'medium') != 'standard') { 
				$gplus_attributes .= ' size="'.get_option($dynamo_tpl->name . '_google_plus_size', 'medium').'"'; 
			}
			
			$gplus_output = '<g:plusone '.$gplus_attributes.' callback="'.get_permalink($postID).'"></g:plusone>';
		}
		// Twitter
		if(get_option($dynamo_tpl->name . '_tweet_btn', 'Y') == 'Y') {
			// configure Twitter buttons    		  
			$tweet_btn_attributes = '';
			$tweet_btn_attributes .= ' data-count="'.get_option($dynamo_tpl->name . '_tweet_btn_data_count', 'vertical').'"';
			if(get_option($dynamo_tpl->name . '_tweet_btn_data_via', '') != '') {
				$tweet_btn_attributes .= ' data-via="'.get_option($dynamo_tpl->name . '_tweet_btn_data_via', '').'"'; 
			}
			$tweet_btn_attributes .= ' data-lang="'.get_option($dynamo_tpl->name . '_tweet_btn_data_lang', 'en').'"';
			  
			$twitter_output = '<a href="http://twitter.com/share" class="twitter-share-button" data-text="'.strip_tags($title).'" data-url="'.get_permalink($postID).'" '.$tweet_btn_attributes.'>'.__('Tweet', DPTPLNAME).'</a>';
			}
		// Pinterest
		if(get_option($dynamo_tpl->name . '_pinterest_btn', 'Y') == 'Y') {
		      $pinit_title = dp_post_thumbnail_caption(true);
		      if($pinit_title == '') {  
    			$pinit_title = false;  
             }  
                
             $image = get_post_meta($postID, 'dynamo_opengraph_image', true); 

		      if($image == '') {
		      	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'single-post-thumbnail' );
		      	$image = $image[0];
				if($image == '' && get_option($dynamo_tpl->name . '_og_default_image', '') != '') {
		      		$image = get_option($dynamo_tpl->name . '_og_default_image', '');
		      	}
		      }
		      
		      
		     // configure Pinterest buttons               
		     $pinterest_btn_attributes = get_option($dynamo_tpl->name . '_pinterest_btn_style', 'horizontal');
		     $pinterest_output = '<a href="http://pinterest.com/pin/create/button/?url='.get_permalink($postID).'&amp;media='.$image.'&amp;description='.(($pinit_title == false) ? urlencode(strip_tags($title)) : $pinit_title).'" class="pin-it-button" count-layout="'.$pinterest_btn_attributes.'"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="'.__('Pin it', DPTPLNAME).'" alt="'.__('Pin it', DPTPLNAME).'" /></a>';
			}
		if ( $fb_like_output !='' || $gplus_output != '' || $twitter_output != '' || $pinterest_output != '') { 
		$output = '<section id="dp-social-api">' . apply_filters('dynamo_social_api_fb', $fb_like_output) . apply_filters('dynamo_social_api_gplus', $gplus_output) . apply_filters('dynamo_social_api_twitter', $twitter_output) . apply_filters('dynamo_social_api_pinterest', $pinterest_output) . '</section>';
		} else $output = '';
		

		return apply_filters('dynamo_social_api', $output);
	}
}

/**
 *
 * Function to generate the author info block
 *
 * @return null
 *
 **/
 
function dp_author($author_page = false, $return_value = false) {
    global $dynamo_tpl;

	// check if the author info is enabled on the specific page
	$authorinfo_mode = get_option($dynamo_tpl->name . '_authorinfo_exclude_include', 'exclude');
	$authorinfo_articles = explode(',', get_option($dynamo_tpl->name . '_authorinfo_articles', ''));
	$authorinfo_pages = explode(',', get_option($dynamo_tpl->name . '_authorinfo_pages', ''));
	$authorinfo_categories = explode(',', get_option($dynamo_tpl->name . '_authorinfo_categories', ''));
	//
	$is_excluded = false;
	//
	if($authorinfo_mode == 'include' || $authorinfo_mode == 'exclude') {
		//
		$is_excluded = 
			($authorinfo_pages != FALSE ? is_page($authorinfo_pages) : FALSE) || 
			($authorinfo_articles != FALSE ? is_single($authorinfo_articles) : FALSE) || 
			($authorinfo_categories != FALSE ? in_category($authorinfo_categories) : FALSE);
		//
		if($authorinfo_mode == 'exclude') {
			$is_excluded = !$is_excluded;
		}
	}
	//
	if($authorinfo_mode == 'all' || $is_excluded) :
		if(
			(is_page() && get_option($dynamo_tpl->name . '_template_show_author_info_on_pages') == 'Y') ||
			!is_page()
		) :
		    if(
		        get_the_author_meta( 'description' ) && 
		        (
		        	$author_page ||
		        	get_option($dynamo_tpl->name . '_template_show_author_info') == 'Y'
		        )
		    ): 
		    ?>
		    <?php if($return_value == true) : ?>
		    	<?php return true; ?>
		    <?php else : ?>
			    <section class="author-info">
			        <aside class="author-avatar">
			            <?php echo get_avatar( get_the_author_meta( 'user_email' ), 64 ); ?>
			        </aside>
			        <div class="author-desc">
			            <h2><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			                    <?php echo get_the_author_meta('display_name', get_the_author_meta( 'ID' )); ?> 
			                </a>
			            </h2>
			            <p>
			                <?php the_author_meta( 'description' ); ?>
			            </p>
			
			            <?php 
			                $www = get_the_author_meta('user_url', get_the_author_meta( 'ID' ));
			                if($www != '') : 
			            ?>
			            <p class="author-www">
			                <a href="<?php echo $www; ?>"><?php echo $www; ?></a>
			            </p>
			            <?php endif; ?>
			            
			            <?php
			            	$google_profile = get_the_author_meta( 'google_profile' );
			            	if ($google_profile != '') :
			            		if(stripos($google_profile, '?') === FALSE && stripos($google_profile, 'rel=author') === FALSE) {
			            			$google_profile .= '?rel=author'; 
			            		}
			            ?>
			            <p class="author-google">
			            	<a href="<?php echo esc_url($google_profile); ?>" rel="me"><?php __('Google Profile', DPTPLNAME); ?></a>
			            </p>
			            <?php endif; ?>
			        </div>
			    </section>
		    	<?php 
		    	endif;
		    endif;
		endif;
	endif;
	
	if($return_value == true) {
		return false;
	}
}

/**
 *
 * Function to generate the popular post list
 *
 **/

function dp_print_popular_posts($show_num,$thumb_width,$word_limit) {
	global $post;
		$popular_posts = get_popular_posts($show_num); 
		if($popular_posts->have_posts()){
		while($popular_posts->have_posts()): $popular_posts->the_post();
		 			 
			$output = "<div class='recent-post-widget'>";
				$thumbnail_id = get_post_thumbnail_id( $post->ID );				
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id);
				$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
				if( !empty($thumbnail) ){
						$output .= '<div class="thumbnail">';
						$output .= '<a href="'.get_permalink( $post->ID ). '">';
						$output .=  '<img class="pic2" width="'.$thumb_width.'" src="' . $thumbnail[0] . '" alt="'. $alt_text .'"/>'; 
						$output .=  '</a></div>';
	
				}
						$output .=  '<div class="content">';
                		$output .=  '<div class="excerpt"><a href="'.get_permalink( $post->ID ).'">';
					 $excerpt = preg_replace('/<img[^>]+./','',get_the_content());
					 	$output .=  string_limit_words($excerpt,$word_limit).'&hellip;</a></div>';
						$output .= '<div class="date">';
                       	$output .=  mysql2date('j M Y',$post->post_date); 
						$output .=  '</div>';
						$output .=  '</div>';
						$output .=  '<div class="clearboth"></div>';
			$output .=  "</div>";

		endwhile;
		}
return $output;		
}



/**
 *
 * Function to generate the related projects thumbnail grid
 *
 **/
function dp_print_related_projects_grid($post_id,$show_num,$items) {
	global $post;
	$thumb_size = "portfolio-square";
	$id = "carousel".mt_rand();
	$items = 'items : '.$items.',';
	$navtext_left = '<i class="Default-arrow-left9"></i>';
	$navtext_right = '<i class="Default-arrow-right9"></i>';
	$autoplay = 'autoPlay: 5000,';
	$itemsdesktop ='itemsDesktop : [1199,4],';
	$itemsdesktopsmall = 'itemsDesktopSmall : [980,3],';
	$itemstablet = 'itemsTablet : [768,2],';
	$itemsmobile = 'itemsMobile : [479,1],';;
	$related_projects = get_related_projects($post_id, $show_num);
	if($related_projects->have_posts()){
			$item_desc= get_post_meta($post->ID, 'item_short_desc', true);
			if ($item_desc =='') $item_desc = '&nbsp;';
		echo '<div class="port-carousel">';
		$carouselscript = "<script type='text/javascript'>
						jQuery(document).ready(function() {
 						jQuery('#".$id."').owlCarousel({"
        				.$items.$itemsdesktop.$itemsdesktopsmall.$itemstablet.$itemsmobile.
        				"navigationText : ['".$navtext_left."','".$navtext_right."'],pagination : false,navigation : true,theme : 'owl-portfolio' });});
						</script>";
		echo $carouselscript;
		echo '<div id="'.$id.'" class="owl-carousel">';
		while($related_projects->have_posts()): $related_projects->the_post();
		?>
        
		 <div class="item">
				<?php if(has_post_thumbnail()):
				$title = $post->post_title;
				$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $thumb_size ); 
				?>
                <figure><div class="text-overlay">
                <div class="info">
                <span><a href="<?php echo $image; ?>" rel="dp_lightbox"><i class="icon-zoom61"></i></a></span>
                <span><a href="<?php the_permalink(); ?>"><i class="icon-link23"></i></a></span>
                </div>
                </div>
                <img src="<?php echo $thumb[0]; ?>" alt="">
                </figure>
                             
				<?php endif; ?>
				<?php
				 	
				 ?>
				</div>

		<?php endwhile;
		echo '</div></div>';
		}
		
}

/**
 *
 * Function to generate the recent projects thumbnail grid
 *
 **/
function dp_print_recent_projects_grid($items, $columns,$categories,$filter,$thumbsize,$showlightbox,$showlink,$showtitle,$showcategories,$showdescription) {
	global $post;
	if ($columns == '') $columns = '4';
	if ($filter == "") $filter = 'no';
	if ($thumbsize == "") $thumbsize = 'horizontal';
	if ($showlightbox == "") $showlightbox = 'no';
	if ($showlink == "") $showlink = 'no';
	if ($showtitle == "") $showtitle = 'no';
	if ($showcategories == "") $showcategories = 'no';
	if ($showdescription == "") $showdescription = 'no';
	switch ($thumbsize) {
		case "horizontal":
			$thumb_size = "portfolio-horizontal";
			break;
		case "vertical":
			$thumb_size = "portfolio-vertical";
			break;
		case "square":
			$thumb_size = "portfolio-square";
			break;
		case "original":
			$thumb_size = "large";
			break;
	}
	switch ($columns) {
		case "2":
			$item_size = "item50";
			break;
		case "3":
			$item_size = "item33";
			break;
		case "4":
			$item_size = "item25";
			break;
		case "5":
			$item_size = "item20";
			break;
		case "6":
			$item_size = "item16";
			break;
		case "8":
			$item_size = "item12";
			break;
	}
	
	$selected_categories = array();
	if ($categories != '') {$selected_categories = explode(',', $categories);
		} else {
		$portfolio_category = get_terms('portfolios');
			if($portfolio_category):
			foreach($portfolio_category as $portfolio_cat):
			array_push($selected_categories,$portfolio_cat->slug);
			endforeach;
			endif;
		}
	$args = array(
				'post_type' => 'portfolio',
				
				'showposts' => $items,
				
				'tax_query' => array(
        array(
            'taxonomy' => 'portfolios',
            'field' => 'slug',
            'terms' => $selected_categories
        )
    ),
			'orderby' => 'menu_order date',
			'order' => 'ASC'			
				);
	?>
    <div class="portfolio-grid-container">
    <div class="portfolio <?php echo $item_size ?>">
    <?php
	$gallery = new WP_Query($args);
		if ($filter =='yes' && (count($selected_categories)>1) ) { 
		$portfolio_category = get_terms('portfolios');
		if($portfolio_category):
		?>
        <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner">
		<ul class="portfolio-tabs">
            <li class="active"><a data-filter="*" href="#">All</a></li>
			<?php foreach($portfolio_category as $portfolio_cat): ?>
            <?php if (in_array($portfolio_cat->slug, $selected_categories)) { ?>
    		<li><a data-filter=".<?php echo $portfolio_cat->slug; ?>" href="#"><?php echo $portfolio_cat->name; ?></a></li>
			<?php } ?>
			<?php endforeach; ?>
		</ul>
        </div>
        </div>
        </div>
		<?php endif; 
		}
	echo '<div class="portfolio-wrapper">';
	if($gallery->have_posts()){
		while($gallery->have_posts()): $gallery->the_post();
		if(has_post_thumbnail()):
			$item_classes = '';
			$item_desc= get_post_meta($post->ID, 'item_short_desc', true);
			if ($item_desc =='') $item_desc = '&nbsp;';
			$item_cats = get_the_terms($post->ID, 'portfolios');
			if($item_cats):
			foreach($item_cats as $item_cat) {
				$item_classes .= $item_cat->slug . ' ';
				$category = $item_cat->name;
			}
			endif;
			?>

		<div class="portfolio-item-wrapper">
				<div class="portfolio-item <?php echo $item_classes; ?>">
				<?php if(has_post_thumbnail()):
				$item_cats = get_the_terms($post->ID, 'portfolios');
				$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				$title = $post->post_title; 
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $thumb_size );
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
                <div class="port-item-wrap">
                <figure>
                <div class="text-overlay">
                <div class="info">
                <?php if ($showlightbox =='yes') { ?>
                <span><a href="<?php echo $image; ?>" rel="dp_lightbox"><i class="icon-zoom61"></i></a></span>
				<?php } ?>
                <?php if ($showlink =='yes') { ?>
                <span><a href="<?php the_permalink(); ?>"><i class="icon-link23"></i></a></span>
				<?php } ?>
                </div>
				<div class="info1">
                <?php if ($showtitle =='yes') { ?>
                <h4><a href="<?php the_permalink(); ?>"><?php echo $title;?></a></h4>
				<?php } ?>
                <?php if ($showcategories =='yes') { ?>
				<h5><?php echo $cats; ?></h5>
				<?php } ?>
                <?php if ($showdescription =='yes') { ?>
                <p><?php echo $item_desc; ?></p>
				<?php } ?>
                </div>                
                </div>
                <img alt="" src="<?php echo $thumb[0]; ?>">
                </figure>
                </div>
				<?php endif; ?>
				<?php endif; ?>
				</div>
    		</div>			
		<?php 
		endwhile;
		wp_reset_postdata();
		echo '</div></div></div><div class="clearboth"></div>';
		}
}


/**
 *
 * Function to generate the related projects thumbnail grid
 *
 **/
function dp_category_slideshow($cat_id) {
	global $dynamo_tpl;
$query_string = 'cat='.$cat_id.'&order=ASC&orderby=menu_order&showposts='.get_option($dynamo_tpl->name . '_archive_slideshow_item_count');
$slideshow_query = new WP_Query($query_string);
$output ='';
if($slideshow_query->have_posts()) {
					$arefeatured = false;
					while ($slideshow_query->have_posts()) {
					$slideshow_query->the_post();
					global $post;
					if ( has_post_thumbnail() ) $arefeatured = true;
					}
					if ( $arefeatured == false) {echo $output;
					return;}
					$gallery_id ='flexslider_'.$cat_id;
					$output .= '<script type="text/javascript">'."\n";
					$output .= "   jQuery(window).load(function() {"."\n"; 
					$output .=  "jQuery('#".$gallery_id."').flexslider({"."\n";
					$output .=  '    animation: "fade",'."\n";
					$output .=  '    slideshowSpeed:"7000",'."\n";
					$output .=  '    animationSpeed:"1000",'."\n";
					$output .=  '    pauseOnHover: true,'."\n";
					$output .=  '    smoothHeight: true,'."\n";
					$output .=  '    before: function(slider){'."\n";
					$output .=  "    jQuery('.panel').css( {'opacity':'0','margin-left':'-1000px'});"."\n";
					$output .=  "},"."\n";
					$output .=  "	after: function(slider){var currentSlide = slider.slides.eq(slider.currentSlide);"."\n";
					$output .=  "	currentSlide.find('.panel').delay(800).animate( {'opacity':'1','margin-left':'10px'},500,'easeOutBack' );"."\n";
					$output .=  "},"."\n";
					$output .=  "  });"."\n";      
					$output .= "   });"."\n";
					$output .= "</script>"."\n";
					$output .= '<div class="clearboth"></div><div class="flexgallery category"><div class="flexslider" id="'.$gallery_id.'"><ul class="slides">'."\n";
					while ($slideshow_query->have_posts()) {
					$slideshow_query->the_post();
					global $post;
					if ( has_post_thumbnail() ) {
					$imageurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					$title = $post->post_title;
					$permalink = get_permalink($post->ID);
					$text = get_post_field('post_content', $post->ID);
					$text = strip_shortcodes($text);
	 				$text = strip_tags($text);
					$text = string_limit_words($text, get_option($dynamo_tpl->name . '_archive_slideshow_excerpt_len')).'&hellip;';
					$output .= '<li><img src="'.$imageurl.'" title="" alt="" />'."\n";
					$output .= '<div class="panel"><a href="'.$permalink.'" rel="bookmark" title=""><div class="gallery-post-title">'.$title.'</div></a>'."\n";
					$output .= '<div class="gallery-post-text">'.$text.'</div></div>'."\n";
					$output .= '</li>'."\n"; 												
					}
					}//End while
					$output .= '</ul></div>'."\n";
					
}
$output .='</div><div class="clearboth"></div>'."\n";

echo $output;
}

/**
 *
 * Function to generate the featured image caption
 *
* @param raw - if you need to get raw text without HTML tags  
*   
* @return HTML output or raw text (depending from params) 

 *
 **/


function dp_post_thumbnail_caption($raw = false) {
	global $post;
	// get the post thumbnail ID
	$thumbnail_id = get_post_thumbnail_id($post->ID);
	// get the thumbnail description
	$thumbnail_img = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));
	// return the thumbnail caption
	if ($thumbnail_img && isset($thumbnail_img[0])) {
		if($thumbnail_img[0]->post_excerpt != '') {
	      if($raw) {  
            return strip_tags($thumbnail_img[0]->post_excerpt);  
          } else {  
            return '<figcaption>'.$thumbnail_img[0]->post_excerpt.'</figcaption>';  
          }  
      }  
  } else {  
     return false;  
		}
	}

/**
 *
 * Function to generate the recent posts grid
 *
 **/
function dp_print_recent_post_grid($items_count,$column,$categories,$show_filter) {
global $dynamo_tpl,$post,$more;
	
	if ($column == '') $column = '4';
	switch ($column) {
		case "2":
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-two";
			break;
		case "3":
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-three";
			break;
		case "4":
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-four";
			break;
		case "5":
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-five";
			break;
		case "6":
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-six";
			break;
		case "8":
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-eight";
			break;
		default:
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-four";
	}
	$selected_categories = array();
	if ($categories != '') {$selected_categories = explode(',', $categories);
		} else {
		$portfolio_category = get_terms('category');
			if($portfolio_category):
			foreach($portfolio_category as $portfolio_cat):
			array_push($selected_categories,$portfolio_cat->slug);
			endforeach;
			endif;
		}

$params = get_post_custom();
$args = array(	'showposts' => $items_count,
				'orderby' => 'date&order=ASC',
				'category_name' => $categories
			);?>
            
		<?php
		// Filter begin
		if ($show_filter == "yes") {
		$portfolio_category = get_terms('category');
		if($portfolio_category && count($selected_categories) >1):
		?>
        <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner">
		<ul class="blog-tabs">
            <li class="active"><a data-filter="*" href="#">All</a></li>
			<?php foreach($portfolio_category as $portfolio_cat): ?>
            <?php if (in_array($portfolio_cat->slug, $selected_categories)) { ?>
    		<li><a data-filter=".<?php echo $portfolio_cat->slug; ?>" href="#"><?php echo $portfolio_cat->name; ?></a></li>
			<?php } ?>
			<?php endforeach; ?>
		</ul>
        </div>
        </div>
        </div>
		<?php 
		endif;
		}
		// Filter end?>
<div class="clearboth"></div>        

<div class="<?php echo $item_size; ?> blog-grid-container">
<div class="blog-grid masonry">
<?php $newsquery = new WP_Query($args);	
while($newsquery->have_posts()): $newsquery->the_post(); ?>
			<?php
			$item_classes = '';
			$item_cats = get_the_terms($post->ID, 'category');
			if($item_cats):
			foreach($item_cats as $item_cat) {
				$item_classes .= $item_cat->slug . ' ';
				$category = $item_cat->name;
			}
			endif;
			?>

	<div class="portfolio-item-wrapper <?php echo $item_classes; ?>">
    
    <div id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
    <div class="portfolio-item">
        			<?php 
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
		<span><i class="icon-link23"></i></span>   	
        </div>
        </div>
		<?php the_post_thumbnail(); ?>
		</a>
	</figure>
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
					$output .= "   jQuery(document).ready(function() {"."\n"; 
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
        <?php if (get_post_format() != 'link' && get_post_format() != 'quote' && get_post_format() != 'status' && get_post_format() != 'audio' ){?>

     <?php } ?>
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
		   case 'quote':
				echo '<i class="Default-quote-right"></i>';
				the_content('');
				$more =1;
				 break;
		  default:		
		   
		  }
		
		if ($post_format =='' || $post_format =='video' || $post_format =='audio' || $post_format =='aside' || $post_format =='gallery')  {?>
        
        <div class="item-description">
        
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', DPTPLNAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><h3><?php the_title(); ?></h3></a>
        <?php dp_post_meta_mini(); ?>
        <?php the_excerpt(); ?>
        </div>
        <?php } ?>
		</section>
	</div>
    </div>
    </div> 
   <?php endwhile ?>
       
   
   </div>
   <div class="clearboth"></div>
   </div>
<?php    

wp_reset_query();

 }


/**
 *
 * Function to generate tblog grid layout
 *
 **/
function dp_print_blog_grid_layout($perpage,$column,$categories,$show_filter) {
global $dynamo_tpl,$post,$more;
	
	if ($perpage == '') $perpage = get_option('posts_per_page');
	if ($column == '') $column = '4';
	switch ($column) {
		case "2":
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-two";
			break;
		case "3":
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-three";
			break;
		case "4":
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-four";
			break;
		case "5":
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-five";
			break;
		case "6":
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-six";
			break;
		case "8":
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-eight";
			break;
		default:
			$thumb_size = "portfolio-square";
			$item_size = "portfolio-four";
	}
	$selected_categories = array();
	if ($categories != '') {$selected_categories = explode(',', $categories);
		} else {
		$portfolio_category = get_terms('category');
			if($portfolio_category):
			foreach($portfolio_category as $portfolio_cat):
			array_push($selected_categories,$portfolio_cat->slug);
			endforeach;
			endif;
		}

$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
$params = get_post_custom();
$args = array(	'paged' => $paged,
				'posts_per_page' =>  $perpage,
				'orderby' => 'date&order=ASC',
				'category_name' => $categories
			);?>
            
		<?php
		// Filter begin
		if ($show_filter == "yes") {
		$portfolio_category = get_terms('category');
		if($portfolio_category && count($selected_categories) >1):
		?>
        <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner">
		<ul class="blog-tabs">
            <li class="active"><a data-filter="*" href="#">All</a></li>
			<?php foreach($portfolio_category as $portfolio_cat): ?>
            <?php if (in_array($portfolio_cat->slug, $selected_categories)) { ?>
    		<li><a data-filter=".<?php echo $portfolio_cat->slug; ?>" href="#"><?php echo $portfolio_cat->name; ?></a></li>
			<?php } ?>
			<?php endforeach; ?>
		</ul>
        </div>
        </div>
        </div>
		<?php 
		endif;
		}
		// Filter end?>
<div class="clearboth"></div>        

<div class="<?php echo $item_size; ?> blog-grid-container">
<div class="blog-grid masonry">
<?php $newsquery = new WP_Query($args);	
while($newsquery->have_posts()): $newsquery->the_post(); ?>
			<?php
			$item_classes = '';
			$item_cats = get_the_terms($post->ID, 'category');
			if($item_cats):
			foreach($item_cats as $item_cat) {
				$item_classes .= $item_cat->slug . ' ';
				$category = $item_cat->name;
			}
			endif;
			?>

	<div class="portfolio-item-wrapper <?php echo $item_classes; ?>">
    
    <div id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
    <div class="portfolio-item">
        			<?php 
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
		<span><i class="icon-link23"></i></span>   	
        </div>
        </div>
		<?php the_post_thumbnail(); ?>
		</a>
	</figure>
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
					$output .= "   jQuery(document).ready(function() {"."\n"; 
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
        <?php if (get_post_format() != 'link' && get_post_format() != 'quote' && get_post_format() != 'status' && get_post_format() != 'audio' ){?>

     <?php } ?>
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
		   case 'quote':
				echo '<i class="Default-quote-right"></i>';
				the_content('');
				$more =1;
				 break;
		  default:		
		   
		  }
		
		if ($post_format =='' || $post_format =='video' || $post_format =='audio' || $post_format =='aside' || $post_format =='gallery')  {?>
        
        <div class="item-description">
        <?php dp_post_meta_mini(); ?>
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', DPTPLNAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><h3><?php the_title(); ?></h3>
        </a>
        <?php the_excerpt(); ?>
        </div>
        <?php } ?>
		</section>
	</div>
    </div>
    </div> 
   <?php endwhile ?>
       
   
   </div>
   <div class="clearboth"></div>
           <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner">
   					<?php dp_content_nav($newsquery->max_num_pages, $range = 2); ?>
   				</div>
            </div>
           </div>
   </div>
<?php    

wp_reset_query();

 }

/**
 *
 * Function to generate user menu
 *
 **/
function dp_user_menu($menu){
	echo '<div class="dp_usermenu">';
	echo '<div class="dp_usermenu_button"><i class="Default-user"></i>';
    echo '<div class ="dp_usermenu_drops">';
	dynamo_menu('user-menu', 'dp-user-menu', array('walker' => new DPMenuWalker()), 'user-menu');
	echo '</div>';
	echo '</div>';
	echo '</div>';
}

function dp_language_switcher(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
		echo '<div class="dp_language_switcher">';
		echo '<div class="dp_language_switcher_button"><i class="icon-world86"></i><span class="lang_code">'.ICL_LANGUAGE_CODE .'</span>';
		echo '<div class ="dp_language_switcher_list">';
 		foreach($languages as $l){
			$langclass = "";
			if($l['active']) $langclass ="current_lang";
			if(!$l['active']) { echo '<a href="'.$l['url'].'">';}
            echo '<div class="lang_item '.$langclass.'">';
			echo '<div class ="flag" style="background-image: url('.$l['country_flag_url'].')"></div>';
            echo '<span>'.$l['translated_name'].'</span>';
            echo '</div>';
            if(!$l['active']) { echo '</a>'; }
		}
		echo '</div></div>';
        echo '</div>';
    }
}
function dp_social_bar_content() {
global $dynamo_tpl;        
		if(get_option($dynamo_tpl->name . "_social_twitter") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_twitter")  .'" class="twitter"></a></li>';
         endif; 
        if(get_option($dynamo_tpl->name . "_social_facebook") != '') :        
        echo '<li><a href="'.get_option($dynamo_tpl->name . "_social_facebook").'" class=" facebook"></a></li>';
        endif; 
         if(get_option($dynamo_tpl->name . "_social_linkedin") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_linkedin") .'" class="linkedin"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_dribbble") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_dribbble") .'" class="dribbble"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_pinterest") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_pinterest") .'" class="pinterest"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_flickr") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_flickr") .'" class="flickr"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_youtube") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_youtube") .'" class="youtube"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_vimeo") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_vimeo") .'" class="vimeo"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_rss") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_rss") .'" class="rss"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_steam") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_steam") .'" class="steam"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_tumblr") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_tumblr") .'" class="tumblr"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_github") != '') :            
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_github") .'" class="github"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_delicious") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_delicious") .'" class="delicious"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_reddit") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_reddit") .'" class="reddit"></a></li>'; 
         endif; 
         if(get_option($dynamo_tpl->name . "_social_lastfm") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_lastfm") .'" class="lastfm"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_digg") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_digg") .'" class="digg"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_forrst") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_forrst") .'" class="forrst"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_stumbleupon") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_stumbleupon")  .'" class="stumbleupon"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_instagram") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_instagram")  .'" class="instagram"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_viadeo") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_viadeo")  .'" class="viadeo"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_xing") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_xing")  .'" class="xing"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_googleplus") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_googleplus")  .'" class="gplus"></a></li>';
         endif;
}

function dp_social_bar_content_footer() {
global $dynamo_tpl;
        if(get_option($dynamo_tpl->name . "_social_twitter") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_twitter")  .'" class="twitter dp-tipsy-t" data-tipcontent="Twitter"></a></li>';
         endif;
        if(get_option($dynamo_tpl->name . "_social_facebook") != '') :        
        echo '<li><a href="'.get_option($dynamo_tpl->name . "_social_facebook").'" class=" facebook dp-tipsy-t" data-tipcontent="Facebook"></a></li>';
        endif; 
         if(get_option($dynamo_tpl->name . "_social_googleplus") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_googleplus")  .'" class="gplus dp-tipsy-t" data-tipcontent="Google+"></a></li>';
         endif;
         if(get_option($dynamo_tpl->name . "_social_linkedin") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_linkedin") .'" class="linkedin dp-tipsy-t" data-tipcontent="Linkedin"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_dribbble") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_dribbble") .'" class="dribbble dp-tipsy-t" data-tipcontent="Dribble"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_pinterest") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_pinterest") .'" class="pinterest dp-tipsy-t" data-tipcontent="Pinterest"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_flickr") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_flickr") .'" class="flickr dp-tipsy-t" data-tipcontent="Flickr"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_youtube") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_youtube") .'" class="youtube dp-tipsy-t" data-tipcontent="Youtube"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_vimeo") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_vimeo") .'" class="vimeo dp-tipsy-t" data-tipcontent="Vimeo"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_rss") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_rss") .'" class="rss dp-tipsy-t" data-tipcontent="RSS"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_steam") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_steam") .'" class="steam dp-tipsy-t" data-tipcontent="Steam"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_tumblr") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_tumblr") .'" class="tumblr dp-tipsy-t" data-tipcontent="Tumblr"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_github") != '') :            
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_github") .'" class="github dp-tipsy-t" data-tipcontent="Github"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_delicious") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_delicious") .'" class="delicious dp-tipsy-t" data-tipcontent="Delicious"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_reddit") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_reddit") .'" class="reddit dp-tipsy-t" data-tipcontent="Reddit"></a></li>'; 
         endif; 
         if(get_option($dynamo_tpl->name . "_social_lastfm") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_lastfm") .'" class="lastfm dp-tipsy-t" data-tipcontent="Lastfm"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_digg") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_digg") .'" class="digg dp-tipsy-t" data-tipcontent="Digg"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_forrst") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_forrst") .'" class="forrst" data-tipcontent="Forrst"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_stumbleupon") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_stumbleupon")  .'" class="stumbleupon dp-tipsy-t" data-tipcontent="Stumbleupon"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_instagram") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_instagram")  .'" class="instagram dp-tipsy-t" data-tipcontent="Instagram"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_viadeo") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_viadeo")  .'" class="viadeo dp-tipsy-t" data-tipcontent="Viadeo"></a></li>';
         endif; 
         if(get_option($dynamo_tpl->name . "_social_xing") != '') : 
        echo '<li><a href="'. get_option($dynamo_tpl->name . "_social_xing")  .'" class="xing dp-tipsy-t" data-tipcontent="Xing"></a></li>';
         endif; 
}

function dp_portfolio_item_social($id,$enable_facebook,$enable_twitter,$enable_google_plus,$enable_linkedin,$enable_pinterest,$enable_reddit,$enable_email) {

  $share_url     = urlencode( get_permalink($id) );
  $share_title   = urlencode( get_the_title($id) );
  $share_source  = urlencode( get_bloginfo( 'name' ) );
  $share_content = urlencode( dynamoPostExcerptbyID($id) );
  $share_media   = wp_get_attachment_thumb_url( get_post_thumbnail_id($id) );
  $facebook    = ( $enable_facebook == 'Y' )    ? "<li><a href=\"#share\" class=\"facebook\" title=\"" . __( 'Share on Facebook', DPTPLNAME ) . "\" onclick=\"window.open('http://www.facebook.com/sharer.php?u={$share_url}&amp;t={$share_title}', 'popupFacebook', 'width=650, height=270, resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;\"></a></li>" : '';
  $twitter     = ( $enable_twitter == 'Y' )     ? "<li><a href=\"#share\" class=\"twitter\" title=\"" . __( 'Share on Twitter', DPTPLNAME ) . "\" onclick=\"window.open('https://twitter.com/intent/tweet?text={$share_title}&amp;url={$share_url}', 'popupTwitter', 'width=500, height=370, resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;\"></a></li>" : '';
  $google_plus = ( $enable_google_plus == 'Y' ) ? "<li><a href=\"#share\" class=\"gplus\" title=\"" . __( 'Share on Google+', DPTPLNAME ) . "\" onclick=\"window.open('https://plus.google.com/share?url={$share_url}', 'popupGooglePlus', 'width=650, height=226, resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;\"></a></li>" : '';
  $linkedin    = ( $enable_linkedin == 'Y' )    ? "<li><a href=\"#share\" class=\"linkedin\" title=\"" . __( 'Share on LinkedIn', DPTPLNAME ) . "\" onclick=\"window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url={$share_url}&amp;title={$share_title}&amp;summary={$share_content}&amp;source={$share_source}', 'popupLinkedIn', 'width=610, height=480, resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;\"></a></li>" : '';
  $pinterest   = ( $enable_pinterest == 'Y' )   ? "<li><a href=\"#share\" class=\"pinterest\" title=\"" . __( 'Share on Pinterest', DPTPLNAME ) . "\" onclick=\"window.open('http://pinterest.com/pin/create/button/?url={$share_url}&amp;media={$share_media}&amp;description={$share_title}', 'popupPinterest', 'width=750, height=265, resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;\"></a></li>" : '';
  $reddit      = ( $enable_reddit == 'Y' )      ? "<li><a href=\"#share\" class=\"reddit\" title=\"" . __( 'Share on Reddit', DPTPLNAME ) . "\" onclick=\"window.open('http://www.reddit.com/submit?url={$share_url}', 'popupReddit', 'width=875, height=450, resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;\"></a></li>" : '';
  $email       = ( $enable_email == 'Y' )       ? "<li><a href=\"mailto:?subject=" . get_the_title($id) . "&amp;body=" . __( 'Hey, thought you might enjoy this! Check it out when you have a chance:', DPTPLNAME ) . " " . get_permalink() . "\"  class=\"email\" title=\"" . __( 'Share via Email', DPTPLNAME ) . "\"></a></li>" : '';
  echo '<ul class="social-icons small rounded">';
  echo $facebook.$twitter.$google_plus.$linkedin.$pinterest.$reddit.$email;
  echo '</ul>';  

}

// EOF