<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>

<section class="cart-empty text-center">
	<?php
	if ($order) :

		do_action('woocommerce_before_thankyou', $order->get_id());
	?>

		<?php if ($order->has_status('failed')) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
				<?php if (is_user_logged_in()) : ?>
					<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<div class="ic ic--cart-checkmark"></div>
			<h4><?php _e('Paldies, Jūsu pasūtījums ir saņemts.', 'woocommerce') ?></h4>
			<p><?php _e('Sazināsimies ar Jums <span>1</span> darba dienas laikā.', 'woocommerce') ?></p>
			<p class="return-to-shop">
				<a class="uh-btn d-inline-block text-decor-none" href="<?php echo get_home_url() ?>">
					<?php _e('Uz sākumlapu', 'unihaus') ?>
				</a>
			</p>

		<?php endif; ?>

	<?php else : ?>

		<div class="ic ic--cart-checkmark"></div>
		<h4><?php _e('Paldies, Jūsu pasūtījums ir saņemts.', 'woocommerce') ?></h4>
		<p><?php _e('Sazināsimies ar Jums <span>1</span> darba dienas laikā.', 'woocommerce') ?></p>
		<p class="return-to-shop">
			<a class="uh-btn d-inline-block text-decor-none" href="<?php echo get_home_url() ?>">
				<?php _e('Uz sākumlapu', 'unihaus') ?>
			</a>
		</p>

	<?php endif; ?>

</section>