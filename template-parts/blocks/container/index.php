<?php if (!defined('ABSPATH')) exit; ?>

<?php if (is_admin()) : ?>
    <div class="acf-block-container">
        <InnerBlocks />
    </div>
<?php else : ?>
    <div class="<?php echo $block['className']; ?> container editor <?php echo (get_field('is_section')) ?  'section-container' : 'text-container'; ?>
">
        <InnerBlocks />
    </div>
<?php endif; ?>