<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<div class="container">
	<h1><?php echo $product->name; ?></h1>

</div>

<div class="container">
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class('row', $product); ?>>
		<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action('woocommerce_before_single_product_summary');
		?>

		<div class="summary entry-summary col-lg-8">
			<div class="description">
				<div class="product-description">
					<?php echo the_content(); ?>
				</div>
				<?php

				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action('woocommerce_single_product_summary');
				?>

			</div>
		</div>


	</div>
</div>
<div class="about-product container">
	<div class="row">
		<div class="col-12">
			<div class="taxonomy">
				<h2><?php _e('Par produktu', 'woocommerce'); ?></h2>
				<div class="tab-area">
					<div class="taxonomy-tabs d-flex">
						<div class="tax-tab active" tab_content="tehniska-specifikacija"><?php _e('Tehniskā specifikācija', 'unihaus'); ?></div>
						<?php if (have_rows('videos')) : ?>
							<div class="tax-tab" tab_content="video"><?php _e('Video', 'unihaus'); ?></div>
						<?php endif;
						if (get_field('additional_equipment_text')) : ?>
							<div class="tax-tab" tab_content="papildus_aprikojums"><?php _e('Papildus aprīkojums', 'unihaus'); ?></div>
						<?php endif;
						if (have_rows('documents')) : ?>
							<div class="tax-tab" tab_content="tehniska-dokumentacija"><?php _e('Tehniskā dokumentācija', 'unihaus'); ?></div>
						<?php endif; ?>
						<!-- <div class="tax-tab" tab_content="izsniegsana-steidzamibas-karta">Izsniegšana steidzamības kārtā</div>
		
					<div class="tax-tab" tab_content="cenas">Cenas</div> -->

					</div>

				</div>

				<div class="taxonomy-tab-contents">

					<div id="tehniska-specifikacija" content_name="tehniska-specifikacija" class="taxonomy-tab-content w-100" style="display: block">
						<?php $product_attr = get_post_meta(get_the_ID(), '_product_attributes');
						?>
						<div class="attributes">
							<?php
							if (!empty($product_attr)) {
								foreach ($product_attr as $attr) {
									foreach ($attr as $attribute) {
										if ($attribute['is_visible'] == 1) : ?>
											<div class="attribute d-lg-flex">
												<div class="attribute-name">
													<?php echo wc_attribute_label($attribute['name']); ?>
												</div>
												<div class="attribute-value w-100">
													<?php $attrvalues = array(wc_get_product_terms(get_the_ID(), $attribute['name'], array('fields' => 'names')));
													if ($attribute['value']) {
														$attributeValue = str_replace('|', ' / ', $attribute['value']);
														echo $attributeValue;
													}

													foreach ($attrvalues as $row => $innerArray) {
														foreach ($innerArray as $innerRow => $value) { ?>
															<span><?php echo $value ?></span>
													<?php }
													}
													?>
												</div>
											</div>
							<?php endif;
									}
								}
							} ?>

						</div>

					</div>
					<?php if (have_rows('videos')) : ?>
						<div id="video" content_name="video" class="taxonomy-tab-content w-100">
							<?php
							while (have_rows('videos')) : the_row(); ?>
								<div class="video-wrapper">
									<?php echo get_sub_field('video_link'); ?>
								</div>
							<?php
							endwhile;
							?>
						</div>
					<?php endif;
					if (get_field('additional_equipment_text')) : ?>
						<div id="papildus_aprikojums" content_name="papildus_aprikojums" class="taxonomy-tab-content w-100">
							<div class="additional-equipment">
								<?php the_field('additional_equipment_text'); ?>
							</div>
						</div>
					<?php endif;
					if (have_rows('documents')) : ?>
						<div id="tehniska-dokumentacija" content_name="tehniska-dokumentacija" class="taxonomy-tab-content w-100">
							<div class="documents">
								<?php while (have_rows('documents')) : the_row();
									$document = get_sub_field('document');
									$name = get_sub_field('name');
								?>
									<?php if ($document) : ?>

										<div class="document">
											<a target="_blank" href="<?php echo $document['url']; ?>" class="ic ic--download text-decor-none d-flex align-items-start"><span><?php echo $name ?></span></a>

										</div>
									<?php endif ?>

								<?php endwhile; ?>
							</div>
						</div>
					<?php endif ?>

					<!-- <div id="izsniegsana-steidzamibas-karta" content_name="izsniegsana-steidzamibas-karta" class="taxonomy-tab-content">
					<p>test 2</p>
				</div>
	
				<div id="cenas" content_name="cenas" class="taxonomy-tab-content">
					<p>test 3</p>
				</div> -->
				</div>
			</div>

		</div>
	</div>
</div>


<?php do_action('woocommerce_after_single_product'); ?>