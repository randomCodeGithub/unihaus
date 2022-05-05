<?php if (!defined('ABSPATH')) exit;if (is_admin()) return; ?>

<section class="partners container">
    <?php
    $partners = get_field('partners');
    if ($partners) {
        $args = array('title' => $partners['title'], 'tagline' => $partners['tagline']);
        get_template_part('template-parts/title-and-tagline', null, $args);
    }; ?>

    <?php if (have_rows('partners', 'option')) : ?>
        <div class="row partner-list">
            <?php while (have_rows('partners', 'option')) : the_row();
                $logo = get_sub_field('logo');

            ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="partner d-flex align-items-center">
                        <?php
                        pdg_img($logo, array(391, 223), array(
                            'class' => array('w-100'),
                            'crop' => false
                        ));
                        ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</section>