<?php if (!defined('ABSPATH')) exit;if (is_admin()) return;

if (have_rows('members')) : ?>
    <section class="team container">
        <?php $team = get_field('team');
        if ($team) {
            $args = array('title' => $team['title'], 'tagline' => $team['tagline']);
            get_template_part('template-parts/title-and-tagline', null, $args);
        } ?>
        <div class="row">
            <?php while (have_rows('members')) : the_row();
                $photo = get_sub_field('photo');
                $another_info = get_sub_field('another_info');
            ?>

                <div class="col-md-6 col-lg-4">
                    <div class="team-member text-center">
                        <div class="member-photo" style="background-image: url(<?php echo pdg_get_image_src($photo, array(400, 200)); ?>)">
                            <img class="w-100 d-none" src="<?php echo pdg_get_image_src($photo, array(400, 200)); ?>" alt="<?php echo esc_attr($photo['alt']); ?>">
                        </div>
                        <h5><?php echo $another_info['name'] ?></h5>
                        <p><?php echo $another_info['position'] ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

<?php endif ?>