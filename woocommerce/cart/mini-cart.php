<?php

/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<?php if (!WC()->cart->is_empty()) : ?>
		<p class="mini-cart__name ta--center"><?php _e('Pasūtījumu grozs', 'unihaus'); ?></p>
		<div class="mini-cart-wrapper">
			<?php
			do_action('woocommerce_before_mini_cart_contents');

			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
				$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
				$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

				if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
					$product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
					$thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
					$product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
					$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
			?>
					<div class="mini-cart-item d-flex align-items-center">
						<div class="mini-cart__thumb">
							<?php if (empty($product_permalink)) : ?>
								<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
								?>
							<?php else : ?>
								<a href="<?php echo esc_url($product_permalink); ?>">
									<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
									?>
								</a>
							<?php endif; ?>
						</div>
						<div class="mini-cart__desc">
							<?php if (empty($product_permalink)) : ?>
								<?php echo wp_kses_post($product_name); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
								?>
							<?php else : ?>
								<a href="<?php echo esc_url($product_permalink); ?>" class="text-decor-none">
									<p>
										<?php echo wp_kses_post($product_name); ?>
									</p>
								</a>
							<?php endif; ?>
							<p class="quantity"><?php echo $cart_item['quantity']; ?> gab</p>
						</div>
						<div class="mini-cart__price">
							<?php
							$product_price_single = $cart_item['data']->get_price();
							$product_price_total = $product_price_single * $cart_item['quantity'];
							?>
							<?php echo $product_price_total . ' ' . get_woocommerce_currency_symbol() ?></div>

					</div>
			<?php
				}
			}

			do_action('woocommerce_mini_cart_contents');
			?>

		</div>

		<p class="woocommerce-mini-cart__total total ta--right">
			<?php
			/**
			 * Hook: woocommerce_widget_shopping_cart_total.
			 *
			 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
			 */
			do_action('woocommerce_widget_shopping_cart_total');
			?>
		</p>

		<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

		<p class="woocommerce-mini-cart__buttons buttons ta--right"><?php do_action('woocommerce_widget_shopping_cart_buttons'); ?></p>

		<?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>

	<?php else : ?>

		<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e('No products in the cart.', 'woocommerce'); ?></p>

	<?php endif; ?>

	<?php do_action('woocommerce_after_mini_cart'); ?>

	