<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php if ( have_rows( 'social', 'option' ) ): ?>
    <ul class="social-nav flex align-items-center">
        <?php
        $i     = 1;
        $count = count( get_field( 'social', 'option' ) );

        while ( have_rows( 'social', 'option' ) ): the_row(); ?>
            <?php if ( get_sub_field( 'url' ) && get_sub_field( 'icon' ) ): ?>
                <li class="social-nav__item<?php if ( $i == $count ): ?>social-nav__item--is-last<?php endif; ?>">
                    <a class="social-nav__link text-decor-none ic ic--<?php the_sub_field( 'icon' ); ?>" href="<?php the_sub_field( 'url' ); ?>" target="_blank"></a>
                </li>
            <?php endif; ?>
        <?php $i++; endwhile; ?>
    </ul>
<?php endif; ?>