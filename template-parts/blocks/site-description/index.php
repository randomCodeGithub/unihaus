<?php if (!defined('ABSPATH')) exit;if (is_admin()) return; ?>

<section class="site-description" style="visibility: hidden;">

    <div class="linear-gradient-left w-100 h-100"></div>

    <?php if (have_rows('images')) : ?>
        <div class="h-100 image-background">
            <div class="site-description-slider w-100">
                <?php while (have_rows('images')) : the_row();
                    $image = get_sub_field('image');
                ?>
                    <div class="slide-image w-100 h-100" style="background-image: url(<?php echo pdg_get_image_src($image, array(1200,1000)) ?>);"></div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <?php
                $title = get_field('title');
                $text = get_field('text');
                ?>
                <?php if ($title) :  ?>
                    <h1><?php echo $title; ?></h1>
                <?php endif ?>
                <?php if ($text) :  ?>
                    <?php echo $text; ?>
                <?php endif ?>

                <?php if (have_rows('buttons')) : ?>
                    <div class="btns">
                        <?php while (have_rows('buttons')) : the_row();
                            $buttonTitle = get_sub_field('button_title');
                            $buttonLink = get_sub_field('button_link');
                        ?>
                            <a href="<?php if ($buttonLink) echo $buttonLink; ?>
" class="uh-btn c--white text-decor-none"><?php if ($buttonTitle) echo $buttonTitle; ?>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>