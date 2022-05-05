<?php if (!defined('ABSPATH')) exit;if (is_admin()) return;

if (have_rows('tab_contents')) : ?>
    <section class="product-tabs container">
        <div class="row">
            <div class="col-12">
                <?php $i = 1; ?>
                <div class="service-tab flex-column flex-lg-row">
                    <?php while (have_rows('tab_contents')) : the_row();
                        $tabContent = get_sub_field('tab_content');
                        $tabContentAttr = sanitize_title($tabContent['title']);
                    ?>
                        <div class="tablinks uh-btn-tab shadow <?php if ($i == 1) echo 'active'; ?>" tab_content="<?php echo $tabContentAttr ?>"><?php echo $tabContent['title'] ?></div>
                    <?php $i++;
                    endwhile; ?>
                </div>
            </div>
        </div>

        <?php $i = 1; ?>
        <div class="row">
            <div class="col-12 service-tab-contents">
                <?php while (have_rows('tab_contents')) : the_row();
                    $tabContent = get_sub_field('tab_content');
                    $tabContentAttr = sanitize_title($tabContent['title']);
                ?>
                    <div class="row service-tab-content" id="<?php echo $tabContentAttr; ?>" style="<?php if ($i == 1) echo 'display: block'; ?>">
                        <?php if ($tabContent) :
                            $args = array('title' => $tabContent['title'], 'tagline' => $tabContent['tagline']);
                            get_template_part('template-parts/title-and-tagline', null, $args);

                            if (have_rows('tab_content_blocks')) : ?>
                                <?php
                                $isReverse = false;
                                $classes = '';
                                $blockCount = 1;
                                ?>
                                <?php while (have_rows('tab_content_blocks')) : the_row();
                                    if ($isReverse && get_sub_field('image')) {
                                        $classes = 'flex-lg-row-reverse';
                                    } else {
                                        $classes = '';
                                    }
                                ?>
                                    <div class=" row align-items-center image-and-text-block <?php if (!empty($classes)) echo $classes; ?> <?php if ($blockCount == 1) echo 'first-block'; ?>">
                                        <div class=" col-lg-<?php echo (get_sub_field('image')) ? '6' : '12'; ?> ">
                                            <div class=" text-block-<?php echo (get_sub_field('image')) ? 'half' : 'full'; ?>">
                                                <?php echo get_sub_field('block'); ?>
                                            </div>
                                            <?php if (get_sub_field('image')) : ?>
                                                <a href="javascript:void(0)" class="uh-btn text-decor-none read-more js-read-more"><?php _e('Lasīt vairāk', 'unihaus'); ?></a>
                                                <a href="javascript:void(0)" class="uh-btn text-decor-none less js-less"><?php _e('Aizvērt', 'unihaus'); ?></a>
                                            <?php endif ?>
                                        </div>
                                        <?php if (get_sub_field('image')) : ?>
                                            <div class="col-lg-6">
                                                <img class="w-100" src="<?php echo pdg_get_image_src(get_sub_field('image'), [600, 400]); ?>" alt="<?php echo esc_attr(get_sub_field('image')['alt']); ?>">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                    if (get_sub_field('image')) {
                                        $isReverse = !$isReverse;
                                    }
                                    $blockCount++;
                                    ?>
                                <?php endwhile; ?>
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>
                <?php $i++;
                endwhile; ?>
            </div>
        </div>
    </section>

<?php endif ?>