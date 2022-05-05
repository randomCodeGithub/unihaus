<?php if (!defined('ABSPATH')) exit;
if (is_admin()) return; ?>

<section class="location container">
    <?php
    $location = get_field('location');
    if ($location) {
        $args = array('title' => $location['title'], 'tagline' => $location['tagline']);
        get_template_part('template-parts/title-and-tagline', null, $args);
    } ?>
    <div class="row">
        <div class="col-12">
            <?php
            $locationText = get_field('location_text');
            $additionalText = get_field('additional_text');
            ?>
            <?php if ($locationText) :  ?>
                <p class="location-text">
                    <?php
                    if (get_field('address', 'option')) {
                        echo str_replace('[address]', '<a target="_blank" href="https://www.google.com/maps/search/?api=1&query=' . get_bloginfo('name') . ' ' . get_field('address', 'option') . '">' . get_field('address', 'option') . '</a>', $locationText);
                    } else {
                        echo $locationText;
                    }
                    ?>
                </p>
            <?php endif ?>
            <?php if ($additionalText) :  ?>
                <p class="additional-text"><?php echo $additionalText ?></p>
            <?php endif ?>

            <?php if (get_field('show_waze_link') && get_field('waze_link', 'option')) :  ?>
                <a target="_blank" href="<?php the_field('waze_link', 'option') ?>" class="ic ic--waze text-decor-none"><span>Waze</span></a>
            <?php endif ?>

        </div>
        <div class="col-12">
            <div class="google-map">
                <!-- <?php if (get_field('show_google_map') && get_field('address', 'option')) :  ?>
                    <div style="width: 100%; height: 100%"><iframe scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;q=<?php the_field('address', 'option') ?>&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" width="100%" height="100%" frameborder="0"></iframe></div>
                <?php endif; ?> -->
                <?php if (get_field('google_map_shortcode')) : ?>
                    <?php echo do_shortcode(get_field('google_map_shortcode')) ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>