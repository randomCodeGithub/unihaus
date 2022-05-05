<?php if (!defined('ABSPATH')) exit;if (is_admin()) return; ?>

<?php
$terms = get_terms(array(
    'taxonomy' => 'service_category',
    'order' => 'ASC',
    'orderby' => 'ID',
    'hide_empty' => false,
    'parent' => 0,
));
if (!is_wp_error($terms) && $terms) : ?>
    <section class="services container">
        <?php
        if ($services = get_field('services')) {
            $args = array('title' => $services['title'], 'tagline' => $services['tagline']);
            get_template_part('template-parts/title-and-tagline', null, $args);
        } ?>
        <div class="row">
            <?php
            foreach ($terms as $term) : ?>

                <div class="col-md-6 col-lg-4 d-flex">
                    <a href="<?php echo get_term_link($term) ?>" class="service w-100 text-center text-decor-none shadow">
                        <div class="service-icon">
                            <span class="ic ic--<?php echo get_field('icon', $term) ?>"></span>
                        </div>
                        <h5><?php echo $term->name ?></h5>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </section>
<?php endif ?>