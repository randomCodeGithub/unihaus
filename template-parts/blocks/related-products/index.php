<?php if (!defined('ABSPATH')) exit;
if (is_admin()) return; ?>

<?php $relatedProductsList = get_field('products');

if ($relatedProductsList) : ?>
    <section class="related-products container">
        <?php
        $relatedProducts = get_field('related_products');
        if ($relatedProducts) {
            $args = array('title' => $relatedProducts['title'], 'tagline' => $relatedProducts['tagline']);
            get_template_part('template-parts/title-and-tagline', null, $args);
        }; ?>
        <div class="row">
            <div class="col-12">
                <ul class="d-flex flex-wrap">
                    <?php foreach ($relatedProductsList as $product) :
                        setup_postdata($product); ?>
                        <?php wc_get_template_part('content', 'product');
                        ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php
            // Reset the global post object so that the rest of the page works correctly.
            wp_reset_postdata(); ?>

        </div>
        <?php if (get_field('btn_link')) : ?>
            <div class="row">
                <a href="<?php the_field('btn_link') ?>" class="uh-btn text-decor-none"><?php _e('Skatīt visus', 'unihaus'); ?></a>
            </div>
        <?php endif ?>
    </section>

<?php endif; ?>