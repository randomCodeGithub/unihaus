<?php if (!defined('ABSPATH')) exit;

function pdgc_acf_blocks()
{
    pdg_add_acf_block('Site description', true, true, function () {
        wp_enqueue_style('pdg-slick');
        wp_enqueue_script('pdg-slick');
    });
    pdg_add_acf_block('Assistive products', true);
    pdg_add_acf_block('Services', true);
    pdg_add_acf_block('Title and tagline');
    pdg_add_acf_block('Partners', true);
    pdg_add_acf_block('Contacts', true);
    pdg_add_acf_block('About us', true);
    pdg_add_acf_block('Team', true);
    pdg_add_acf_block('Location', true);
    pdg_add_acf_block('Documents', true);
    pdg_add_acf_block('Related products', true, false, function () {
        wp_enqueue_style('wc-product', PDGC_ASSETS . '/vendor/theme/woocommerce/product.css', array(), PDGC_VER);
    });
    pdg_add_acf_block('Tabs', true, true);
}
add_action('acf/init', 'pdgc_acf_blocks');
