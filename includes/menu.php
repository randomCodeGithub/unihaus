<?php if (!defined('ABSPATH')) exit;

/**
 * Register menu locations.
 */
function pdgc_register_nav()
{
    register_nav_menus(array(
        'header' => 'Header Navigation',
        'footer' => 'Footer navigation',
    ));
}
add_action('init', 'pdgc_register_nav');
