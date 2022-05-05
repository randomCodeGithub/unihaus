<?php

/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
// do_action( 'woocommerce_cart_is_empty' );

if (wc_get_page_id('shop') > 0) : ?>
	<section class="cart-empty text-center">
		<div class="ic ic--cart"></div>
		<h4><?php _e('Jūsu grozs ir tukšs!', 'woocommerce') ?></h4>
		<p><?php _e('Iesakām apmeklēt mūsu preču katalogu.', 'woocommerce') ?></p>
		<p class="return-to-shop">
			<?php 
			$page = get_page_by_path('paliglidzekli');
			$pageLink = get_page_link($page);
			?>
			<a class="uh-btn d-inline-block text-decor-none" href="<?php echo $pageLink ?>">
				<?php
				/**
				 * Filter "Return To Shop" text.
				 *
				 * @since 4.6.0
				 * @param string $default_text Default text.
				 */
				echo esc_html(apply_filters('woocommerce_return_to_shop_text', __('Uz preču katalogu', 'woocommerce')));
				?>
			</a>
		</p>

	</section>
<?php endif; ?>