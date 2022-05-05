<?php get_header(); ?>


<section class="taxonomy">
    <?php
    $taxonomy = get_queried_object();
    get_template_part('template-parts/breadcrumb');
    // print_r($taxonomy);
    $termTagline = get_field('service_categories_tagline', $taxonomy);
    $args = array('title' => $taxonomy->name, 'tagline' => $termTagline, 'is_first_heading' => true);
    $page = get_page_by_path('pakalpojumi');
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
            <div class="col-12">
                <?php if (!empty($taxonomy->description)) : ?>
                    <p class="description"><?php echo $taxonomy->description ?></p>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <div class="additional-text">
                    <?php
                    if ($text = get_field('text', $taxonomy))
                        echo $text;
                    ?>

                </div>
                <?php

                $subcat_args = array(
                    'child_of' => $taxonomy->term_id,
                    'taxonomy' => $taxonomy->taxonomy,
                    'hide_empty' => 0,
                    'hierarchical' => true,
                    'depth'  => 1,
                );
                $sub_categories = get_categories($subcat_args);

                $posts_array = new WP_Query(array(
                    'post_type' => 'service',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'service_category',
                            'field'    => 'slug',
                            'include_children' => false,
                            'terms'    => $taxonomy,
                        )
                    ),
                )); ?>
                <?php if ($posts_array->have_posts() || $sub_categories) : ?>
                    <div class="taxonomy-posts d-none d-lg-flex flex-wrap">
                        <?php
                        // CATEGORY POSTS
                        if ($posts_array->have_posts()) :
                            while ($posts_array->have_posts()) :
                                $posts_array->the_post(); ?>
                                <a href="<?php echo get_permalink() ?>" class="uh-btn d-inline-block text-decor-none"><?php _e('Skatīt', 'unihaus'); ?> <?php the_title(); ?></a>
                            <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();

                        // CATEGORY CHILDREN
                        if ($sub_categories) :
                            foreach ($sub_categories as $child) : ?>
                                <a href="<?php echo get_term_link($child) ?>" class="uh-btn d-inline-block text-decor-none"><?php _e('Skatīt', 'unihaus'); ?> <?php echo $child->name ?></a>
                        <?php
                            endforeach;
                        endif;

                        ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">

                <?php
                if ($images = get_field('gallery', $taxonomy)) : ?>
                    <div class="flexslider taxonomy-flexslider">
                        <ul class="slides">
                            <?php foreach ($images as $image) : ?>
                                <li style="background-image: url(<?php echo pdg_get_image_src($image, array(1000, 800), true, false) ?>);" class="img-block" data-thumb="<?php echo pdg_get_image_src($image, array(100, 100)) ?> ">
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if ($posts_array->have_posts() || $sub_categories) : ?>
                    <div class="taxonomy-posts d-flex d-lg-none flex-wrap">
                        <?php
                        // CATEGORY POSTS
                        if ($posts_array->have_posts()) :
                            while ($posts_array->have_posts()) :
                                $posts_array->the_post(); ?>
                                <a href="<?php echo get_permalink() ?>" class="uh-btn d-inline-block text-decor-none"><?php _e('Skatīt', 'unihaus'); ?> <?php the_title(); ?></a>
                            <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();

                        // CATEGORY CHILDREN
                        if ($sub_categories) :
                            foreach ($sub_categories as $child) : ?>
                                <a href="<?php echo get_term_link($child) ?>" class="uh-btn d-inline-block text-decor-none"><?php _e('Skatīt', 'unihaus'); ?> <?php echo $child->name ?></a>
                        <?php
                            endforeach;
                        endif;

                        ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="about-product container">
        <div class="row">
            <div class="col-12 tab-area">
                <?php if (have_rows('tabs', $taxonomy)) :
                    $i = 1;
                ?>
                    <div class="taxonomy-tabs d-flex">
                        <?php while (have_rows('tabs', $taxonomy)) : the_row();
                            $tabTitle = get_sub_field('tab_title');
                            $tabTitleAttr = sanitize_title($tabTitle);
                        ?>
                            <div class="tax-tab <?php if ($i == 1) echo 'active'; ?>" tab_content="<?php echo $tabTitleAttr ?>"><?php echo $tabTitle ?></div>

                        <?php $i++;
                        endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if (have_rows('tabs', $taxonomy)) :
                $i = 1;
            ?>
                <div class="col-12">
                    <div class="taxonomy-tab-contents">
                        <?php while (have_rows('tabs', $taxonomy)) : the_row();
                            $tabTitle = get_sub_field('tab_title');
                            $tabFullWidth = get_sub_field('tab_full_width');
                            $tabTitleAttr = sanitize_title($tabTitle);
                            $text = get_sub_field('text');
                        ?>

                            <div id="<?php echo $tabTitleAttr ?>" content_name="<?php echo $tabTitleAttr ?>" class="taxonomy-tab-content" style="<?php if ($i == 1) echo 'display: block;'; ?><?php if ($tabFullWidth) echo 'width:100%;' ?>">
                                <?php echo $text ?>

                                <?php if (have_rows('documents')) : ?>
                                    <div class="documents">
                                        <?php while (have_rows('documents')) : the_row();
                                            $document = get_sub_field('document');
                                            $name = get_sub_field('name');
                                        ?>
                                            <?php if ($document) : ?>

                                                <div class="document">
                                                    <a target="_blank" href="<?php echo $document['url']; ?>" class="ic ic--download text-decor-none d-flex align-items-start"><span><?php echo $name ?></span></a>

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


<?php $relatedProducts = get_field('related', $taxonomy);
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