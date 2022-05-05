<?php get_header(); ?>


<section class="search-page">

    <div class="container">
        <h1 class="search-title mt-5 mb-5">
            <?php echo sprintf(__("Atrasti %s rezultāti", 'unihaus'), $wp_query->found_posts); ?>: "<?php the_search_query(); ?>"
        </h1>
        <?php if (have_posts()) : ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php $post_type = get_post_type_object(get_post_type()); ?>
                        <div href="<?php echo esc_url(get_permalink()); ?>" class="well search-result">
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="row text-decor-none">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="col-sm-6 col-md-3 col-lg-2">
                                        <img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                    </div>
                                <?php endif ?>
                                <div class="<?php echo (has_post_thumbnail()) ? 'col-sm-6 col-md-9 col-lg-10' : 'col-12'; ?>
 title">
                                    <h3><?php the_title(); ?></h3>
                                </div>

                            </a>
                        </div>

                    <?php endwhile ?>
                </div>
            </div>
        <?php else : ?>
            <h3 class="text-center result-not-found"><?php esc_html_e('Nekas nav atrasts.', 'unihaus'); ?></h3>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>