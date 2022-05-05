<?php if (!defined('ABSPATH')) exit; ?>

<?php get_header(); ?>

<section class="c-404 container text-center">
    <h1 class="c-404__title">404</h1>

    <h5><?php _e('Lapa netika atrasta!', 'unihaus'); ?></h5>

    <p class="c-404__message"><?php _e('Radusies kāda tehniska kļūda, vai arī šī lapa vairs nav pieejama.', 'unihaus'); ?></p>

    <div class="c-404__btn-wrap">
        <a class="uh-btn d-inline-block text-decor-none" href="<?php echo esc_url(home_url()); ?>">
            <?php _e('Uz sākumlapu', 'unihaus'); ?>
        </a>
    </div>
</section>

<?php get_footer(); ?>