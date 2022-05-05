<?php

/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
	return;
}

global $product;

$columns           = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
		'woocommerce-product-gallery--columns-' . absint($columns),
		'images',
	)
);
?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?> col-lg-4" data-columns="<?php echo esc_attr($columns); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<!-- <figure class="woocommerce-product-gallery__wrapper">
		<?php
		if ($post_thumbnail_id) {
			$html = wc_get_gallery_image_html($post_thumbnail_id, true);
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'woocommerce'));
			$html .= '</div>';
		}

		echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

		do_action('woocommerce_product_thumbnails');
		?>
	</figure> -->
	<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->ID), 'single-post-thumbnail');
	if (has_post_thumbnail($product->ID)) : ?>
		<div id="slider" class="flexslider single-flexslider">
			<ul class="slides slide-carousel">
				<li data-fancybox="images" data-src="<?php echo $image[0] ?>" style="background-image: url(<?php echo $image[0] ?>);" class="img-block">
					<img src="<?php echo $image[0] ?>" style="display: none;" alt="">
				</li>
				<?php
				$attachment_ids = $product->get_gallery_image_ids();
				foreach ($attachment_ids as $attachment_id) : ?>
					<li data-fancybox="images" data-src="<?php echo wp_get_attachment_url($attachment_id) ?>" style="background-image: url(<?php echo wp_get_attachment_url($attachment_id) ?>);" class="img-block">
						<img src="<?php echo wp_get_attachment_url($attachment_id) ?>" style="display: none;" alt="">
					</li>
					<?php endforeach;
				if (have_rows('videos')) :
					while (have_rows('videos')) : the_row(); ?>
						<li><?php echo get_sub_field('video_link'); ?></li>
				<?php endwhile;
				endif; ?>
			</ul>
		</div>
		<div id="carousel" class="flexslider">
			<ul class="slides d-flex slide-controll flex-control-thumbs">
				<li class="thumb-slide d-flex align-items-center">
					<img src="<?php echo $image[0] ?>">
				</li>
				<?php
				foreach ($attachment_ids as $attachment_id) : ?>
					<li class="thumb-slide d-flex align-items-center">
						<img src="<?php echo wp_get_attachment_url($attachment_id) ?>">
					</li>
					<?php endforeach;
				if (have_rows('videos')) :
					while (have_rows('videos')) : the_row(); ?>
						<li class="thumb-slide video d-flex align-items-center">
							<img src="<?php echo $image[0] ?>">
							<span class="ic ic--play-button d-flex justify-content-center align-items-center"></span>
						</li>
					<?php endwhile; ?>
				<?php endif ?>
			</ul>
		</div>
	<?php endif; ?>
</div>