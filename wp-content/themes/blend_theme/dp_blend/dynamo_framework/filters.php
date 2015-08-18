<?php

/**
 *
 * Function used to generate the template full title
 *
 * @return null
 *
 **/
function dp_title() {
	global $paged, $page, $post,$wp_locale;
	// access to the template object
	global $dynamo_tpl;
	$m = get_query_var('m');
	$year = get_query_var('year');
	$monthnum = get_query_var('monthnum');
	$day = get_query_var('day');
	$search = get_query_var('s');
	$t_sep = '/';
	$title = '';
	// If there is a post
	if ( is_single() || ( is_home() && !is_front_page() ) || ( is_page() && !is_front_page() ) ) {
		$title = single_post_title( '', false );
	}
	// If there's a post type archive
	if ( is_post_type_archive() ) {
		$post_type = get_query_var( 'post_type' );
		if ( is_array( $post_type ) )
			$post_type = reset( $post_type );
		$post_type_object = get_post_type_object( $post_type );
		if ( ! $post_type_object->has_archive )
			$title = post_type_archive_title( '', false );
	}
	// If there's a category or tag
	if ( is_category() || is_tag() ) {
		$title = single_term_title( '', false );
	}
	// If there's a taxonomy
	if ( is_tax() ) {
		$term = get_queried_object();
		if ( $term ) {
			$tax = get_taxonomy( $term->taxonomy );
			$title = single_term_title( $tax->labels->name . $t_sep, false );
		}
	}

	// If there's an author
	if ( is_author() && ! is_post_type_archive() ) {
		$author = get_queried_object();
		if ( $author )
			$title = $author->display_name;
	}

	// Post type archives with has_archive should override terms.
	if ( is_post_type_archive() && $post_type_object->has_archive )
		$title = post_type_archive_title( '', false );
	// If there's a month
	if ( is_archive() && !empty($m) ) {
		$my_year = substr($m, 0, 4);
		$my_month = $wp_locale->get_month(substr($m, 4, 2));
		$my_day = intval(substr($m, 6, 2));
		$title = $my_year . ( $my_month ? $t_sep . $my_month : '' ) . ( $my_day ? $t_sep . $my_day : '' );
	}

	// If there's a year
	if ( is_archive() && !empty($year) ) {
		$title = $year;
		if ( !empty($monthnum) )
			$title .= $t_sep . $wp_locale->get_month($monthnum);
		if ( !empty($day) )
			$title .= $t_sep . zeroise($day, 2);
	}

	// If it's a search
	if ( is_search() ) {
		/* translators: 1: separator, 2: search phrase */
		$title = sprintf(__('Search Results %1$s %2$s',DPTPLNAME), $t_sep, strip_tags($search));
	}

	// If it's a 404 page
	if ( is_404() ) {
		$title = __('Page not found',DPTPLNAME);
	}

	$first_part = dp_blog_name();
	$second_part = $title;
	if (is_home() || is_front_page()) $second_part = dp_blog_desc();
	$sep = ' '.get_option($dynamo_tpl->name . '_seo_separator_in_title','&raquo;').' ';
	if (get_option($dynamo_tpl->name .'_seo_use_blogname_in_title') == 'Y' && (!is_home() || !is_front_page()) ) {$title = $first_part.$sep.$second_part;
	} else {
	$title =$second_part;
	}
	return $title;
}
add_filter( 'wp_title', 'dp_title', 10, 2 );



// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');	

/**
 *
 * Function used to add the Google Profile URL in the user profile
 *
 * @param methods - array of the contact methods
 *
 * @return the updated arra of the contact methods
 *
 **/

function dynamo_google_profile( $methods ) {
  // Add the Google Profile URL field
  $methods['google_profile'] = __('Google Profile URL', DPTPLNAME);
  // return the updated contact methods
  return $methods;
}

add_filter( 'user_contactmethods', 'dynamo_google_profile', 10, 1);



/**
 *
 * Functions used to generate post excerpt
 *
 * @return HTML output
 *
 **/

function dynamo_excerpt($text) {
    return $text;
}


add_filter( 'get_the_excerpt', 'dynamo_excerpt', 999 );



function dynamo_excerpt_length($length) {
    global $dynamo_tpl;
    return get_option($dynamo_tpl->name . '_excerpt_len', 55);
}


add_filter( 'excerpt_length', 'dynamo_excerpt_length', 999 );


/**
 *
 * Function used for disable widget titles if the first character is "#"
 *
 *
 **/
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
	if ( substr ( $widget_title, 0, 1 ) == '#' )
		return;
	else 
		return ( $widget_title );
}



/**
 *
 * Function used in the attachment page image links
 *
 * @return the additional class in the links
 *
 **/


function dynamo_img_link_class( $link )
{
    $class = 'next_image_link' === current_filter() ? 'next' : 'prev';


    return str_replace( '<a ', '<a class="btn-nav nav-'.$class.'"', $link );
}


add_filter( 'previous_image_link', 'dynamo_img_link_class' );
add_filter( 'next_image_link',     'dynamo_img_link_class' );

/**
 *
 * Function used to add target="_blank" in the comments links
 *
 * @return comment code
 *
 **/


if(get_option($dynamo_tpl->name . '_comments_autoblank', 'Y') == 'Y') {
	function dynamo_comments_autoblank($text) {
		$return = str_replace('<a', '<a target="_blank"', $text);
		return $return;
	}


	add_filter('comment_text', 'dynamo_comments_autoblank');
}


/**
 *
 * Code used to disable autolinking in comments
 *
 **/
 
if(get_option($dynamo_tpl->name . '_comments_autolinking', 'Y') == 'N') {
	remove_filter('comment_text', 'make_clickable', 9);
}

// EOF