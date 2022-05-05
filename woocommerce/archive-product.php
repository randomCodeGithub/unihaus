<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header();

global $product;
global $post;
$terms = get_the_terms($post->ID, 'product_cat');
$product_cat_id = null;
$product_cat_name = null;
if (is_array($terms) || is_object($terms)) {
	foreach ($terms as $term) {
		$product_cat_id = $term->term_id;
		$product_cat_name = $term->name;
		break;
	}
}
$categories = get_terms('product_cat');
$categoryId = 'product_cat_' . $product_cat_id;

$featuredProduct = get_field('featured_product', $categoryId);
if ($featuredProduct) : ?>
	<div class="container featured-product">
		<div class="row align-items-center">
			<div class="col-lg-6">
				<h4><?php echo esc_html($featuredProduct->post_title); ?></h4>
				<?php
				if (!empty($featuredProduct->post_excerpt)) {
					echo '<p>' . $featuredProduct->post_excerpt . '</p>';
				}
				?>
				<a href="<?php echo get_permalink($featuredProduct->ID); ?>" class="uh-btn d-inline-block text-decor-none"><?php _e('Uzzināt vairāk', 'unihaus'); ?></a>
			</div>
			<?php if (has_post_thumbnail($featuredProduct)) : ?>
				<div class="col-lg-6">
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($featuredProduct->ID), 'single-post-thumbnail'); ?>

					<img src="<?php echo $image[0]; ?>">
				</div>
			<?php endif ?>
		</div>
	</div>
<?php endif;
$category = get_queried_object();
get_template_part('template-parts/breadcrumb');
// print_r(wc_get_attribute($post->ID));
// echo get_the_archive_title();
$ProductTagline = get_field('product', $categoryId);
$args = array('title' => $product_cat_name, 'tagline' => $ProductTagline['tagline'], 'is_first_heading' => true);
?>
<div class="container">
	<?php get_template_part('template-parts/title-and-tagline', null, $args); ?>
</div>

<?php global $wp_query; ?>
<div class="container">
	<div class="product-count">
		<?php
		if ($wp_query->found_posts > 0) {
			$productCountName = ($wp_query->found_posts > 1) ? __('produkti', 'unihaus') : __('produkts', 'unihaus');
			echo $wp_query->found_posts . ' ' . $productCountName;
		} else {
			echo '0' . ' ' . __('produkti', 'unihaus');
		}
		?>
	</div>
	<div class="row">
		<div class="col-category">
			<div>
				<?php //echo do_shortcode('[woof sid="auto_shortcode" autohide=0]');
				echo do_shortcode('[facetwp facet="categories"]');
				echo do_shortcode('[facetwp facet="tes"]');
				?>
			</div>
		</div>
		<div class="col-products">
			<?php
			if (woocommerce_product_loop()) {

				woocommerce_product_loop_start();

				if (wc_get_loop_prop('total')) {
			?>
					<div class="row" data-lm-wrap="products">
						<?php
						while (have_posts()) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 */
							do_action('woocommerce_shop_loop');
							wc_get_template_part('content', 'product');
						} ?>
					</div>
					<?php
					$currentPage = (get_query_var('paged')) ? get_query_var('paged') : 1;
					if ($currentPage != $wp_query->max_num_pages) : ?>
						<div class="text-center">
							<button class="uh-btn js-pdg-load-more" data-lm-id="products">
								<?php _e('Ielādēt vairāk', 'unihaus'); ?>
							</button>
						</div>
						<script>
							var pdg_load_more = {
								'products': {
									args: '<?php echo json_encode($wp_query->query_vars); ?>',
									page: <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>,
									max: <?php echo $wp_query->max_num_pages; ?>,
									lang: '<?php echo ICL_LANGUAGE_CODE; ?>',
									tpl: 'template-parts/product'
								}
							};
						</script>
					<?php endif; ?>
			<?php
				}

				woocommerce_product_loop_end();

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action('woocommerce_after_shop_loop');
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action('woocommerce_no_products_found');
			}
			?>
		</div>
	</div>
</div>
<?php
do_action('woocommerce_after_main_content');

get_footer();
