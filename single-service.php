<?php get_header(); ?>


<section class="taxonomy single-taxonomy">
    <?php get_template_part('template-parts/breadcrumb');
    $service = get_field('service');
    $args = array('title' => get_the_title(), 'tagline' => $service['tagline'], 'is_first_heading' => true);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php get_template_part('template-parts/title-and-tagline', null, $args); ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row about-taxonomy">
            <div class="col-lg-6">
                <div class="additional-text">
                    <?php
                    if ($text = get_field('text'))
                        echo $text;
                    ?>
                </div>
            </div>
            <div class="col-lg-6">
                <?php
                if ($images = get_field('gallery', $taxonomy)) : ?>
                    <div class="flexslider taxonomy-flexslider">
                        <ul class="slides">
                            <?php foreach ($images as $image) : ?>
                                <li style="background-image: url(<?php echo pdg_get_image_src($image, array(600, 400)) ?>);" class="img-block" data-thumb="<?php echo pdg_get_image_src($image, array(100, 100)) ?> ">
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="about-product container">
        <div class="row">
            <div class="col-12 tab-area">
                <?php if (have_rows('tabs')) :
                    $i = 1;
                ?>
                    <div class="taxonomy-tabs d-flex">
                        <?php while (have_rows('tabs')) : the_row();
                            $tabTitle = get_sub_field('tab_title');
                            $tabTitleAttr = sanitize_title($tabTitle);
                        ?>
                            <div class="tax-tab <?php if ($i == 1) echo 'active'; ?>" tab_content="<?php echo $tabTitleAttr ?>"><?php echo $tabTitle ?></div>
                        <?php $i++;
                        endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if (have_rows('tabs')) :
                $i = 1;
            ?>
                <div class="col-12">
                    <div class="taxonomy-tab-contents">
                        <?php while (have_rows('tabs')) : the_row();
                            $tabTitle = get_sub_field('tab_title');
                            $tabFullWidth = get_sub_field('tab_full_width');
                            $tabTitleAttr = sanitize_title($tabTitle);
                            $text = get_sub_field('text');
                        ?>

                            <div id="<?php echo $tabTitleAttr ?>" content_name="<?php echo $tabTitleAttr ?>" class="taxonomy-tab-content" style="<?php if ($i == 1) echo 'display: block;'; ?><?php if($tabFullWidth) echo 'width:100%;' ?>"
">
                                <?php echo $text ?>

                                <?php if (have_rows('documents')) : ?>
                                    <div class="documents">
                                        <?php while (have_rows('documents')) : the_row();
                                            $document = get_sub_field('document');
                                            $name = get_sub_field('name');
                                        ?>
                                            <?php if ($document) : ?>

                                                <div class="document">
                                                    <a href="<?php echo $document['url']; ?>" class="ic ic--download text-decor-none d-flex align-items-center"><span><?php echo $name ?></span></a>

                                                </div>
                                            <?php endif ?>

                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php $i++;
                        endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

</section>

<?php $relatedProducts = get_field('related');
if ($relatedProducts['products']) : ?>

    <section class="related-products">
        <div class="container">
            <div class="row">
                <?php
                if ($relatedProducts['title']) :
                    $args = array('title' => $relatedProducts['title'], 'tagline' => $relatedProducts['tagline']);
                ?>
                    <div class="col-12">
                        <?php get_template_part('template-parts/title-and-tagline', null, $args); ?>
                    </div>
                <?php endif; ?>
                <div class="col-12">
                    <ul class="d-flex flex-wrap">
                        <?php foreach ($relatedProducts['products'] as $product) :

                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($product); ?>
                            <?php wc_get_template_part('content', 'product');
                            ?>
                        <?php endforeach; ?>
                    </ul>

                </div>

            </div>
        </div>
    </section>
    <?php
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
<?php endif; ?>


<?php get_footer(); ?>