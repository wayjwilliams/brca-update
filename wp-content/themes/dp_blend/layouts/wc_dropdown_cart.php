<?php

// disable direct access to the file	
defined('DYNAMO_WP') or die('Access denied');

global $dynamo_tpl,$woocommerce;

?>

   	    <!--   Begin Dropdown Cart -->
        <div class="dp_shopping_cart">
			<a class="dp_shopping_cart_btn" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><span class="dp_shopping_cart_btn_count"><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>
			<div class="shopping_cart_dropdown">
			<div class="shopping_cart_dropdown_inner">
				<?php
					$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
					$list_class = array( 'cart_list', 'product_list_widget' );
				?>
					<ul class="<?php echo implode(' ', $list_class); ?>">

						<?php if ( !$cart_is_empty ) : ?>

							<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

								$_product = $cart_item['data'];

								// Only display if allowed
								if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
									continue;
								}

								// Get price
								$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

								$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
								?>

								<li>
									<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

										<?php echo $_product->get_image(); ?>

										

									</a>
									<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?><br/>
									<?php echo $woocommerce->cart->get_item_data( $cart_item ); ?>

									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
								</li>

							<?php endforeach; ?>

						<?php else : ?>

							<li><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>

						<?php endif; ?>

					</ul>
				</div>
			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>
			
			<?php endif; ?>
                <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" target="_self" class="button_dp small color dropdowncartbtn"><span><?php _e( 'VIEW CART', 'woocommerce' ); ?></span></a>
                    <span class="total"><?php _e( 'Total', 'woocommerce' ); ?>: <span><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span></span>


			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>
			
			<?php endif; ?>
		</div>
	</div>
		<!--   End Dropdown Cart -->
