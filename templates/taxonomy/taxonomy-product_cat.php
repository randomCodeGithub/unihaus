<?php

defined('ABSPATH') || exit;

get_header();

global $product;
global $post;
$terms = get_the_terms($post->ID, 'product_cat');
// print_r($terms);
$product_cat_id = null;
$product_cat_name = null;

foreach ($terms as $term) {
    $product_cat_id = $term->term_id;
    $product_cat_name = $term->name;
    break;
}
$categories = get_terms('product_cat');
$categoryId = 'product_cat_' . $product_cat_id;

$featuredProduct = get_field('featured_product', $categoryId);
if ($featuredProduct) : ?>
    <div class="container featured-product">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h4><?php echo esc_html($featuredProduct->post_title); ?></h4>
                <?php if ($productDescription = get_field('product_description', $categoryId))
                    echo $productDescription;
                ?>
                <a href="<?php echo get_permalink($featuredProduct->ID); ?>" class="uh-btn d-inline-block text-decor-none"><?php _e('Uzzināt vairāk', 'unihaus'); ?></a>
            </div>
            <div class="col-lg-6">
                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($featuredProduct->ID), 'single-post-thumbnail'); ?>

                <img src="<?php echo $image[0]; ?>" data-id="<?php echo $featuredProduct->ID; ?>">
            </div>
        </div>
    </div>
<?php endif;
$category = get_queried_object();
get_template_part('template-parts/breadcrumb');

$ProductTagline = get_field('product', $categoryId);
$args = array('title' => $product_cat_name, 'tagline' => $ProductTagline['tagline'], 'is_first_heading' => true);
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php get_template_part('template-parts/title-and-tagline', null, $args); ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-2" style="padding: 0;">
            <?php
            echo do_shortcode('[woof sid="auto_shortcode"redirect="'.get_permalink().'" autosubmit=1 ajax_redraw=1 is_ajax=1 autohide=0 taxonomies=product_cat:9]');
            ?>
        </div>
        <div class="col-lg-10">
            <?php global $wp_query;

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
