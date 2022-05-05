<?php if (!defined('ABSPATH')) exit;

function pdgc_add_assets()
{

    // Main theme assets.
    wp_enqueue_style('pdgc-main', PDGC_ASSETS . '/css/main.css', array(), PDGC_VER);
    wp_enqueue_script('pdgc-main', PDGC_ASSETS . '/main.js', array('jquery'), PDGC_VER, true);

    // Late loaded assets.
    wp_enqueue_style('pdgc-late', PDGC_ASSETS . '/vendor/theme/late.css', array(), PDGC_VER);
    wp_enqueue_script('pdgc-late', PDGC_ASSETS . '/vendor/theme/late.js', array(), PDGC_VER, true);

    if (is_tax('service_category') || is_single()) {
        wp_enqueue_style('pdg-flexslider');
        wp_enqueue_script('pdg-flexslider');
        wp_enqueue_style('wc-product', PDGC_ASSETS . '/vendor/theme/woocommerce/product.css', array(), PDGC_VER);
        wp_enqueue_script('pdgc-tabs', PDGC_ASSETS . '/vendor/theme/tabs.js', array(), PDGC_VER, true);
        wp_enqueue_script('flexslider-settings', PDGC_ASSETS . '/vendor/theme/flexsliderSettings.js', array(), PDGC_VER, true);
        wp_enqueue_style('taxonomy-css', PDGC_ASSETS . '/vendor/theme/taxonomy/taxonomy.css', array(), PDGC_VER);
        wp_enqueue_style('pdg-fancybox');
        wp_enqueue_script('pdg-fancybox');
    }
    
    if (is_404()) {
        wp_enqueue_style('additional-404', PDGC_ASSETS . '/vendor/theme/404/404.css', array(), PDGC_VER);
    }

    if (is_privacy_policy()) {
        wp_enqueue_style('pdgc-privacy', PDGC_ASSETS . '/vendor/theme/privacy/privacy.css', array(), PDGC_VER);
    }
    
    if (is_search()) {
        wp_enqueue_style('pdgc-search-page', PDGC_ASSETS . '/vendor/theme/searchPage/searchPage.css', array(), PDGC_VER);
    }
    
    if (class_exists('woocommerce')) {
        if (is_product()) {
            wp_enqueue_style('wc-single-product-css', PDGC_ASSETS . '/vendor/theme/woocommerce/single-product.css', array(), PDGC_VER);
            wp_enqueue_style('wc-notices', PDGC_ASSETS . '/vendor/theme/woocommerce/notices/notices.css', array(), PDGC_VER);
        }

        if (is_product() || is_cart()) {
            wp_enqueue_style('wc-quantity', PDGC_ASSETS . '/vendor/theme/woocommerce/quantity/quantity.css', array(), PDGC_VER);
            wp_enqueue_script('wc-quantity', PDGC_ASSETS . '/vendor/theme/woocommerce/quantity/quantity.js', array(), PDGC_VER, true);
            wp_enqueue_style('wc-woocommerce-css', PDGC_ASSETS . '/vendor/theme/woocommerce/woocommerce.css', array(), PDGC_VER);
            wp_enqueue_style('only-safari', PDGC_ASSETS . '/vendor/theme/safari.css', array(), PDGC_VER);
        }


        if (is_single() || !is_product()) {
            wp_enqueue_style('wc-onsale-css', PDGC_ASSETS . '/vendor/theme/woocommerce/onsale.css', array(), PDGC_VER);
        }

        if (is_cart() || (is_checkout() && !empty(is_wc_endpoint_url('order-received')))) {
            wp_enqueue_style('wc-cart', PDGC_ASSETS . '/vendor/theme/woocommerce/cart/cart.css', array(), PDGC_VER);
        }

        if (is_checkout()) {
            wp_enqueue_style('wc-checkout', PDGC_ASSETS . '/vendor/theme/woocommerce/checkout/checkout.css', array(), PDGC_VER);
            wp_enqueue_script('wc-checkout-scripts', PDGC_ASSETS . '/vendor/theme/woocommerce/checkout/checkout.js', array(), PDGC_VER, true);
        }

        if (is_cart() || is_product()) {
            wp_enqueue_script('wc-notices', PDGC_ASSETS . '/vendor/theme/woocommerce/notices/notices.js', array(), PDGC_VER, true);
        }


        if (is_tax('product_cat') || is_archive()) {
            wp_enqueue_style( 'select2');
            wp_enqueue_script('selectWoo');
            wp_enqueue_style('wc-woocommerce-css', PDGC_ASSETS . '/vendor/theme/woocommerce/woocommerce.css', array(), PDGC_VER);
            wp_enqueue_script('wc-product-category', PDGC_ASSETS . '/vendor/theme/woocommerce/product_category/productCategory.js', array(), PDGC_VER, true);
            wp_enqueue_style('wc-product-category', PDGC_ASSETS . '/vendor/theme/woocommerce/product_category/productCategory.css', array(), PDGC_VER);
            wp_enqueue_style('customInputs', PDGC_ASSETS . '/vendor/theme/woocommerce/checkout/customInputs.css', array(), PDGC_VER);
        }
    }
}
add_action('wp_enqueue_scripts', 'pdgc_add_assets', 20);

function ga_script()
{
?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-217935367-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-217935367-1');
    </script>

<?php
}
add_action('wp_head', 'ga_script');
