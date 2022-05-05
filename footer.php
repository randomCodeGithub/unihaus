<?php if (!defined('ABSPATH')) exit; ?>

</div>

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <?php if ($footer_image =  get_field('footer_logo', 'option')) : ?>
                <div class="col-12">
                    <div class="footer-logo">
                        <img src="<?php echo pdg_get_image_src($footer_image); ?>" alt="">
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-6">
                <?php if (get_field('google_map_shortcode', 'option')) : ?>
                    <div style="width: 100%" class="map">
                        <?php echo do_shortcode(get_field('google_map_shortcode', 'option')) ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="col-lg-3">
                <div class="about-us">
                    <?php if (get_field('about_company', 'option')) : ?>
                        <p><?php the_field('about_company', 'option') ?></p>
                    <?php endif; ?>
                    <?php if (get_field('address', 'option')) : ?>
                        <p><?php the_field('address', 'option') ?><?php if (get_field('post_code', 'option')) echo ', ' . get_field('post_code', 'option'); ?>
                        </p>
                    <?php endif;
                    if (get_field('waze_link', 'option')) : ?>
                        <a target="_blank" href="<?php the_field('waze_link', 'option') ?>" class="ic ic--waze text-decor-none"><span>Waze</span></a>
                    <?php endif ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="footer-contacts">
                    <?php if (get_field('phone', 'option')) : ?>
                        <p><b><?php _e('Tālrunis:', 'unihaus'); ?></b> <a target="_blank" href="tel:<?php echo str_replace(' ', '', get_field('phone', 'option')) ?>"><?php the_field('phone', 'option') ?></a></p>
                    <?php endif ?>
                    <?php if (get_field('email', 'option')) : ?>
                        <p><b><?php _e('E-pasts:', 'unihaus'); ?></b> <a target="_blank" href="mailto:<?php echo str_replace(' ', '', get_field('email', 'option')) ?>"><?php the_field('email', 'option') ?></a></p>
                    <?php endif ?>
                    <?php if (get_field('working_days', 'option')) : ?>
                        <p><b><?php _e('Darba laiks:', 'unihaus'); ?> </b><?php the_field('working_days', 'option') ?></p>
                    <?php endif ?>
                    <?php if (get_field('working_hours', 'option')) : ?>
                        <p><?php the_field('working_hours', 'option') ?></p>
                    <?php endif ?>

                    <?php if (get_field('requisites_link', 'option')) : ?>
                        <a href="<?php the_field('requisites_link', 'option') ?>" class="requisites"><?php _e('Rekvizīti', 'unihaus'); ?></a>
                    <?php endif ?>
                    <?php get_template_part('template-parts/social-nav'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <?php $privacyPolicyLink = get_privacy_policy_url(); ?>
                    <?php if (!empty($privacyPolicyLink)) : ?>
                        <a class="text-decor-none" href="<?php echo $privacyPolicyLink ?>"><?php _e('Privātuma politika', 'unihaus'); ?></a>
                    <?php endif ?>
                </div>
                <div class="col-lg-4">
                    <?php get_template_part('template-parts/copyright'); ?>
                </div>
                <div class="col-lg-4">
                    <?php get_template_part('template-parts/developer'); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer content goes here -->

</footer>

<?php get_template_part('template-parts/foot'); ?>