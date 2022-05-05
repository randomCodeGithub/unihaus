<?php if (!defined('ABSPATH')) exit;
if (is_admin()) return; ?>

<section class="documents container">
    <?php if (have_rows('documents')) : ?>
        <div class="row">
            <div class="col-12">
                <div class="document-area d-flex flex-wrap">
                    <?php $i = 1;
                    while (have_rows('documents')) : the_row();
                        $document = get_sub_field('document');
                    ?>
                        <a target="_blank" href="<?php echo $document['url'] ?>" class="document ic ic--document text-decor-none shadow <?php if ($i % 5 == 0) echo 'last-in-row' ?>">
                            <p><?php echo $document['title'] ?></p>
                        </a>
                    <?php $i++;
                    endwhile; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>