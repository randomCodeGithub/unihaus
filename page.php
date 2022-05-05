<?php get_header(); ?>

<?php if (get_field('show_breadcrumb') || (is_checkout() && !empty(is_wc_endpoint_url('order-received'))))
    get_template_part('template-parts/breadcrumb');
if (!get_field('hide_page_title')) : ?>
    <div class="container">
        <h1 class="page-title"><?php the_title(); ?></h1>
    </div>
<?php endif; ?>


<?php $pageTitle = get_field('title'); ?>
<?php $pageTagline = get_field('tagline'); ?>

<?php if ($pageTitle || $pageTagline) :
    $args = array('title' => $pageTitle, 'tagline' => $pageTagline, 'is_first_heading' => true);
?>
    <div class="container page-title-and-tagline">
        <div class="row">
            <div class="col-12">
                <?php get_template_part('template-parts/title-and-tagline', null, $args); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="editor">
    <?php the_content();
    ?>
</div>

<?php get_footer(); ?>