<?php if (!defined('ABSPATH')) exit;if (is_admin()) return; ?>

<section class="contacts container">
    <?php
    $contacts = get_field('contacts');
    if ($contacts) {
        $args = array('title' => $contacts['title'], 'tagline' => $contacts['tagline']);
        get_template_part('template-parts/title-and-tagline', null, $args);
    } ?>
    <div class="row">
        <div class="col-md-6 offset-lg-2 col-lg-4 email-col">
            <?php if (get_field('email', 'option')) : ?>
                <a href="mailto:<?php echo str_replace(' ', '', get_field('email', 'option')) ?>" class="email ic ic--email text-decor-none shadow">
                    <h4><?php the_field('email', 'option') ?></h4>
                </a>

            <?php endif; ?>
        </div>

        <div class="col-md-6 col-lg-4 phone-col">
            <?php if (get_field('phone', 'option')) : ?>
                <a href="tel:<?php echo str_replace(' ', '', get_field('phone', 'option')) ?>" class="phone ic ic--phone text-decor-none shadow">
                    <h4><?php the_field('phone', 'option') ?></h4>
                </a>
            <?php endif; ?>
        </div>
        <?php if (get_field('note')) : ?>
            <div class="col-lg-6 offset-lg-2 note">
                <p><?php the_field('note') ?></p>
            </div>
        <?php endif ?>
    </div>
</section>