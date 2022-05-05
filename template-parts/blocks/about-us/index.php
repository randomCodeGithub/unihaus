<?php if (!defined('ABSPATH')) exit;if (is_admin()) return; ?>
<section class="about-us container">

    <?php $aboutUs = get_field('about_us');

    if ($aboutUs['title'] || $aboutUs['tagline']) {
        $args = array('title' => $aboutUs['title'], 'tagline' => $aboutUs['tagline']);
        get_template_part('template-parts/title-and-tagline', null, $args);
    } ?>
    <div class="row">
        <?php 
        $imageColumn = get_field('image_column');
        $contentColumn = get_field('content_column');
        ?>
        <div class="<?php echo ($imageColumn) ? "col-lg-".$imageColumn['width']."" : 'col-lg-6'; ?>">
            <?php if ($image = get_field('image')) : ?>
                <?php
                pdg_img($image, array(600, 400), array(
                    'class' => array('w-100'),
                    'fly' => true,
                    'crop' => true
                ));
                ?>
            <?php endif ?>
        </div>
        <div class="<?php echo ($contentColumn) ? "col-lg-".$contentColumn['width']."" : 'col-lg-6'; ?>">
            <?php $anotherContent = get_field('another_content'); ?>
            <div class="what-we-do">
                <?php if ($anotherContent['text']) : ?>

                    <?php echo $anotherContent['text']; ?>
                <?php endif; ?>
                <?php if ($anotherContent['btn_link']) : ?>
                    <a href="<?php echo $anotherContent['btn_link'] ?>" class="uh-btn d-inline-block c--white text-decor-none"><?php _e('Uzzināt vairāk', 'unihaus'); ?></a>
                <?php endif; ?>

            </div>

        </div>
    </div>
</section>