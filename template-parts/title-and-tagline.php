<?php if (isset($args['title']) || isset($args['tagline'])) :
    if (!empty($args['title']) || !empty($args['tagline'])) :
?>
        <div class="d-flex align-items-md-center title-and-tagline">
            <?php if (isset($args['title'])) : ?>
                <?php if (isset($args['title'])) : ?>
                    <?php if (isset($args['is_first_heading'])) : ?>
                        <h1 class="title"><?php echo $args['title'] ?></h1>
                    <?php else : ?>
                        <h2 class="title"><?php echo $args['title'] ?></h2>
                    <?php endif ?>
                <?php endif ?>
            <?php endif ?>
            <?php if (isset($args['tagline'])) : ?>
                <?php if (!empty($args['tagline'])) : ?>
                    <h5 class="tagline"><?php echo $args['tagline'] ?></h5>
                <?php endif ?>
            <?php endif ?>
        </div>
    <?php endif ?>
<?php endif ?>