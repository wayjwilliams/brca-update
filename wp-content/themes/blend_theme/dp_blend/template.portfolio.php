<?php

/*
Template Name: Portfolio (with sidebar)
*/
 
global $dynamo_tpl;


dp_load('header');
dp_load('before');
	$params = get_post_custom();
	$params_columncount = isset( $params['dynamo-portfolio-params-columns'] ) ? esc_attr( $params['dynamo-portfolio-params-columns'][0] ) : '4';
	$params_gridstyle = isset( $params['dynamo-portfolio-params-gridstyle'] ) ? esc_attr( $params['dynamo-portfolio-params-gridstyle'][0] ) : 'classic';
	$params_usefilter = isset( $params['dynamo-portfolio-params-usefilter'] ) ? esc_attr( $params['dynamo-portfolio-params-usefilter'][0] ) : 'Y';
	$params_category = isset($params['dynamo-portfolio-params-category']) ? esc_attr( $params['dynamo-portfolio-params-category'][0] ) : '';
	$params_perpage = isset($params['dynamo-portfolio-params-perpage']) ? esc_attr( $params['dynamo-portfolio-params-perpage'][0] ) : '';
	$params_thumbsize = isset($params['dynamo-portfolio-params-thumbsize']) ? esc_attr( $params['dynamo-portfolio-params-thumbsize'][0] ) : 'Y';
	$params_lightboxicon = isset($params['dynamo-portfolio-params-lightboxicon']) ? esc_attr( $params['dynamo-portfolio-params-lightboxicon'][0] ) : 'N';
	$params_linkicon = isset($params['dynamo-portfolio-params-linkicon']) ? esc_attr( $params['dynamo-portfolio-params-linkicon'][0] ) : 'N';
	$params_sharefacebook = get_option($dynamo_tpl->name . "_share_facebook","Y");
	$params_sharetwitter = get_option($dynamo_tpl->name . "_share_twitter","Y");
	$params_sharegoogle = get_option($dynamo_tpl->name . "_share_googleplus","N");
	$params_sharelinkedin = get_option($dynamo_tpl->name . "_share_linkedin","N");
	$params_sharepinterest = get_option($dynamo_tpl->name . "_share_pinterest","N");
	$params_sharereddit = get_option($dynamo_tpl->name . "_share_reddit","N");
	$params_shareemail = get_option($dynamo_tpl->name . "_share_email","N");
	$use_share = get_option($dynamo_tpl->name . "_enable_share_on_portfolio_pages","Y");
	$add_style = '';
	
	
	switch ($params_columncount) {
		case "2":
			$add_style .= "item50";
			break;
		case "3":
			$add_style .= "item33";
			break;
		case "4":
		$add_style .= "item25";
			break;
		case "5":
		$add_style .= "item20";
			break;
		case "6":
		$add_style .= "item16";
			break;
		default:
		$add_style .= "item20";
        break;
	}
	if ($params_gridstyle == 'classic' || $params_gridstyle == 'grid') $add_style .= ' withmargin';
	switch ($params_gridstyle) {
		case "classic":
			$add_style .= " classic";
			break;
		case "grid":
			$add_style .= " gridstyle";
			break;
		case "gridnomargin":
		$add_style .= " gridstyle";
			break;
		default:
		$add_style .= " gridstyle";
        break;
	}
	switch ($params_thumbsize) {
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
		default:
			$thumb_size = "portfolio-horizontal";
        break;
	}
	$selected_categories = array();
	if ($params_category != '') {$selected_categories = explode(',', $params_category);
	if (count($selected_categories)<2) $params_usefilter = "N";
		} else {
		$portfolio_category = get_terms('portfolios');
			if($portfolio_category):
			foreach($portfolio_category as $portfolio_cat):
			array_push($selected_categories,$portfolio_cat->slug);
			endforeach;
			endif;
		}
	if ($params_perpage != "") {$item_per_page = $params_perpage;} else 
	{$item_per_page = get_option($dynamo_tpl->name . "_portfolio_items_per_page");}
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(
				'post_type' => 'portfolio',
				'paged' => $paged,
				'posts_per_page' => $item_per_page,
				'orderby' => 'menu_order date',
				'order' => 'ASC',
				'tax_query' => array(
        array(
            'taxonomy' => 'portfolios',
            'field' => 'slug',
            'terms' => $selected_categories
        )
    )
						
				);
			$gallery = new WP_Query($args);

?>

<section id="dp-mainbody" class="portfolio <?php echo $add_style;?>">
<?php the_post(); ?>
<section class="content">
		<?php the_content(); ?>
		
		<?php dp_post_links(); ?>
	</section>
		<?php
		$portfolio_category = get_terms('portfolios');
		if($portfolio_category && $params_usefilter == 'Y'):
		?>
        <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner">
		<ul class="portfolio-tabs">
            <li class="active"><a data-filter="*" href="#"><?php _e('All', DPTPLNAME); ?></a></li>
			<?php foreach($portfolio_category as $portfolio_cat): ?>
            <?php if (in_array($portfolio_cat->slug, $selected_categories)) { ?>
    		<li><a data-filter=".<?php echo $portfolio_cat->slug; ?>" href="#"><?php echo $portfolio_cat->name; ?></a></li>
			<?php } ?>
			<?php endforeach; ?>
		</ul>
        </div>
        </div>
        </div>
		<?php endif; ?>
<div class="portfolio-wrapper">
			<?php
			while($gallery->have_posts()): $gallery->the_post();
				if(has_post_thumbnail()):
			?>
			<?php
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
				$title = $post->post_title;
				$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
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
				<figure><div class="text-overlay">
                <div class="info">
                <?php if ($params_lightboxicon == "Y") { ?>
                <span><a href="<?php echo $image; ?>" rel="dp_lightbox"><i class="icon-zoom61"></i></a></span>
                <?php } ?>
                <?php if ($params_linkicon == "Y") { ?>
                <span><a href="<?php the_permalink(); ?>"><i class="icon-link23"></i></a></span>
                <?php } ?>
                
                
                </div>
                <div class="info1">
                <?php if ($params_gridstyle != "classic") {?>
                <a href="<?php the_permalink(); ?>"><h4><?php echo $title; ?></h4></a>
                <h5><?php echo $cats;?></h5>
                <?php }?>
                </div>
                </div>
                <img src="<?php echo $thumb[0]; ?>" alt="">
                </figure>
                <?php if ($params_gridstyle == "classic") {?>  
                <div class="item-description">
                                   <a href="<?php the_permalink(); ?>"><h5><?php echo $title ?></h5></a>
                                   <span><?php echo $item_desc ?></span>
                <?php if ($use_share == "Y") { ?>
                                   <div class="portfolio-sharing"><div class="centered-block-outer"><div class="centered-block-middle"><div class="centered-block-inner"><?php dp_portfolio_item_social(get_the_ID(),$params_sharefacebook,$params_sharetwitter, $params_sharegoogle,$params_sharelinkedin,$params_sharepinterest,$params_sharereddit,$params_shareemail)?></div>
                </div></div></div>
                <?php }?>
                </div>
                <?php }?>
				<?php endif; ?>
				<?php
				 	
				 ?>
                 
				</div>
    		</div>
    
			<?php endif; endwhile; ?> 
			
		</div>
        <div class="clearboth"></div>
        <div class="space20"></div>
        <div class="centered-block-outer"><div class="centered-block-middle"><div class="centered-block-inner">
       	<?php dp_content_nav($gallery->max_num_pages, $range = 2); ?>
        </div></div></div>
       	
        <div class="clearboth"></div><div class="space30"></div>
        <?php include('layouts/content.portfolio.footer.php'); ?>
        </section>
        <div class="space40"></div>
<?php

dp_load('after');
dp_load('footer');

// EOF