<?php if (!defined('ABSPATH')) exit; ?>

<?php get_template_part('template-parts/head'); ?>

<header class="site-header bgc--primary">
    <!-- Header content goes here -->
    <div class="d-lg-none background-color-area"></div>
    <div class="container">
        <div class="top-header d-none d-lg-flex justify-content-end">

            <?php
            // echo get_search_form();
            if (class_exists('woocommerce')) {
                get_template_part('template-parts/wc-cart');
            } ?>
            <div class="search-form search-form-desktop">
                <a href="javascript:void(0)" tabindex="1" class="ic ic--search text-decor-none js-search-desktop" style="font-size: 23px;"></a>
                <?php echo do_shortcode('[wpdreams_ajaxsearchlite]') ?>
            </div>
            <?php pdg_language_switcher(); ?>
        </div>

        <div class="row last-col">
            <div class="col-8 col-lg-3 d-flex">
                <div class="menu-btn position-relative ml-auto d-lg-none js-menu">
                    <span class="toggler"></span>
                </div>
                <div class="logo d-flex align-items-center d-lg-block">
                    <?php if ($logo_image =  get_field('logo', 'option')) : ?>
                        <a href="<?php echo home_url() ?>">
                            <?php
                            pdg_img($logo_image, 'full', array(
                                'class' => array('w-100'),
                                'fly' => false,
                                'crop' => false,
                                'svg_mode' => 2
                            ));
                            ?>
                        </a>
                    <?php endif ?>
                </div>
            </div>
            <div class="col-4 col-lg-9">
                <div class="bottom-header d-flex justify-content-lg-end">
                    <?php if (class_exists('woocommerce')) : ?>
                        <div class="d-flex d-lg-none align-items-end">
                            <?php get_template_part('template-parts/wc-cart'); ?>
                        </div>
                    <?php endif ?>
                    <div class="d-flex align-items-end d-lg-none">
                        <a href="javascript:void(0)" tabindex="2" class="ic ic--search text-decor-none js-search-mobile" style="font-size: 23px;"></a>
                        <div class="d-none d-lg-none search-area js-search-area">
                            <div class="search-form-mobile d-flex">
                                <?php echo do_shortcode('[wpdreams_ajaxsearchlite]') ?>
                            </div>
                        </div>
                    </div>
                    <div class="responsive-menu">
                        <div class="d-lg-none">
                            <?php pdg_language_switcher(); ?>
                        </div>
                        <?php pdg_nav('header', 'flex align-items-center'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="site-content">