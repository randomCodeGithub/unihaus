<?php $cartCount = WC()->cart->get_cart_contents_count(); ?>
<div class="wc-cart" style="position: relative;">
    <a href="<?php echo ($cartCount > 0) ? "javascript:void()" : wc_get_cart_url(); ?>" class="ic ic--cart text-decor-none <?php if ($cartCount > 0) echo "js-wc-cart" ?>">
    </a>
    <?php
    if ($cartCount > 0) : ?>
        <div class="count">
            <?php echo $cartCount; ?>
        </div>
    <?php endif; ?>
    <div class="mini-cart">
        <?php echo woocommerce_mini_cart() ?>
    </div>
</div>