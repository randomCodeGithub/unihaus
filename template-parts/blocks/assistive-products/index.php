<?php if (!defined('ABSPATH')) exit;
if (is_admin()) return;

$terms = get_terms(array(
    'taxonomy' => 'product_cat',
    'order' => 'ASC',
    'orderby' => 'ID',
    'hide_empty' => true,
    'parent' => 0
)); ?>

<?php
if (!is_wp_error($terms) && $terms) : ?>
    <section class="assistive-products">
        <div class="container">
            <?php $assistiveProducts = get_field('assistive_products'); ?>

            <?php if ($assistiveProducts) {
                $args = array('title' => $assistiveProducts['title'], 'tagline' => $assistiveProducts['tagline']);
                get_template_part('template-parts/title-and-tagline', null, $args);
            } ?>

            <div class="row">
                <?php foreach ($terms as $term) : ?>

                    <div class="col-6 col-lg-2">
                        <a href="<?php echo get_term_link($term) ?>" class="product d-block text-decor-none shadow">
                            <span class="ic ic--<?php the_field('icon', $term) ?>"></span>
                            <h6><?php echo $term->name ?></h6>
                        </a>
                    </div>

                <?php endforeach ?>
            </div>
        </div>
    </section>
<?php endif ?>