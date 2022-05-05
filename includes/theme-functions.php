<?php if (!defined('ABSPATH')) exit;

/**
 * Filters the path of the current template before including it.
 * @param string $template The path of the template to include.
 */
add_filter('template_include', 'wpse_template_include');
function wpse_template_include($template)
{
    // Handle taxonomy templates.
    $taxonomy = get_query_var('taxonomy');
    if (is_tax() && $taxonomy) {
        $file = get_theme_file_path() . '/templates/taxonomy/taxonomy-' . $taxonomy . '.php';
        if (file_exists($file)) {
            $template = $file;
        }
    }

    // if (is_singular()) {
    //     $file = get_theme_file_path() . '/templates/taxonomy/single.php';
    //     if (file_exists($file)) {
    //         $template = $file;
    //     }
    // }
    return $template;
}

// Product loop title
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'change_loop_product_title', 10);
function change_loop_product_title()
{
    global $product;
    echo '<h6 class="woocommerce-loop-product_title uppercase"><a class="text-decor-none" href="' . $product->get_permalink() . '">' . $product->name . '</a></h6>';
}

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

// Product loop link
add_action('woocommerce_before_shop_loop_item', 'change_loop_product_link_open', 10);
function change_loop_product_link_open()
{
    global $product;
    $link = $product->get_permalink();

    echo '<a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link text-decor-none">';
}

// Woocommerce_single_product_summary.
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5);

// add_action('woocommerce_after_quantity_input_field', 'wc_text_after_quantity');

// function wc_text_after_quantity()
// {
//     if (is_product()) {
//         echo 'gab';
//     }
// }

add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);

function new_loop_shop_per_page($cols)
{
    // $cols contains the current number of products per page based on the value stored on Options –> Reading
    // Return the number of products you wanna show per page.
    $cols = 16;
    return $cols;
}

remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

add_filter('woocommerce_format_sale_price', 'invert_formatted_sale_price', 10, 3);
function invert_formatted_sale_price($price, $regular_price, $sale_price)
{
    return '<ins class="text-decor-none">' . (is_numeric($sale_price) ? wc_price($sale_price) : $sale_price) . '</ins> <del>' . (is_numeric($regular_price) ? wc_price($regular_price) : $regular_price) . '</del>';
}

add_filter('woocommerce_sale_flash', 'add_percentage_to_sale_bubble');
function add_percentage_to_sale_bubble($html)
{
    global $product;
    $percentage = round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100);
    $output = ' <span class="onsale">- ' . $percentage . '%</span>';
    return $output;
}


// ADD TO CART NOTICE
add_filter('wc_add_to_cart_message_html', 'wc_add_to_cart_message_html_filter', 10, 2);
function wc_add_to_cart_message_html_filter($message, $products)
{
    foreach ($products as $product_id => $quantity) {

        // GET PRODUCT
        $product = wc_get_product($product_id);
        $product_title = $product->get_title();
        $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'single-post-thumbnail'); // The product title
        $product_price = $product->price;
        $price = '';
        $currency = '<span class="woocommerce-Price-currencySymbol">' . get_woocommerce_currency_symbol() . '</span>';
        if (!empty($product->sale_price)) {
            $sale_price = '<ins class="text-decor-none"><span class="woocommerce-Price-amount amount"><bdi>' . $product->sale_price . '&nbsp;' . $currency . '</bdi></span></ins>';
            $regular_price = '<del><span class="woocommerce-Price-amount amount"><bdi>' . $product->regular_price . '&nbsp;' . $currency . '</bdi></span></del>';
            $price = '<p class="price price-sale">' . $sale_price . $regular_price . '</p>';
        } else {
            $price = '<p class="price">' . $product_price . '&nbsp;' . $currency . '</p>';
        }
        // $message = '<div class="product-add-to-cart">';
        $message = '<h4>' . __('Prece veiksmīgi ielikta pirkumu grozā', 'unihaus') . '</h4>';
        $message .= '<span class="ic ic--close js-close-notice"></span>';
        //    TABLE
        $message .= '<table class="w-100">'; //TABLE
        $message .= '<tr>'; //TABLE ROW
        $message .= '<td><img src="' . $product_image[0] . '" /></td>'; //Product IMG
        $message .= '<td>' . $product_title . '</td>'; //Product TITLE
        $message .= '<th>' . $price . '</th>'; //Product PRICE
        $message .= '</tr>'; //END TABLE ROW
        $message .= '</table>'; //END TABLE
        // BTNS
        $message .= '<div class="btns">';
        $message .= '<a href="' . wc_get_cart_url() . '" class="uh-btn text-decor-none d-inline-block">' . __('Apskatīt grozu', 'unihaus') . '</a>';
        $message .= '<a href="' . wc_get_checkout_url() . '" class="uh-btn text-decor-none d-inline-block">' . __('Noformēt pasūtījumu', 'unihaus') . '</a>';
        $message .= '</div>';
    }
    return $message;
}
// MINI-CART BTNS
remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10);
remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20);

// Custom "View Cart" btn
add_action('woocommerce_widget_shopping_cart_buttons', 'custom_mini_cart_btn_view_cart', 10);
function custom_mini_cart_btn_view_cart()
{
?>
    <a href="<?php echo wc_get_cart_url() ?>" class="uh-btn d-inline-block text-decor-none"><?php _e('Apskatīt grozu', 'unihaus') ?></a>
<?php
}

// MINI-CART SUBTOTAL
remove_action('woocommerce_widget_shopping_cart_total', 'woocommerce_widget_shopping_cart_subtotal', 10);
add_action('woocommerce_widget_shopping_cart_total', 'custom_minicart_subtotal', 10);

function custom_minicart_subtotal()
{
    echo '<span>' . esc_html__('Kopā:', 'unihaus') . '</span> ' . WC()->cart->get_cart_subtotal(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

//CART
function woocommerce_button_proceed_to_checkout()
{

    $checkout_url = WC()->cart->get_checkout_url();
?>
    <a href="<?php echo $checkout_url; ?>" class="uh-btn text-decor-none">

        <?php _e('Noformēt pasūtījumu', 'woocommerce'); ?></a>

<?php
}

function custom_cart_totals_order_total_html($value)
{
    $value = '<h5>' . WC()->cart->get_total() . '</h5> ';

    // If prices are tax inclusive, show taxes here.
    if (wc_tax_enabled() && WC()->cart->display_prices_including_tax()) {
        $tax_string_array = array();
        $cart_tax_totals  = WC()->cart->get_tax_totals();
        if (get_option('woocommerce_tax_total_display') === 'itemized') {
            foreach ($cart_tax_totals as $code => $tax) {
                $tax_string_array[] = sprintf('%s %s', $tax->formatted_amount, $tax->label);
            }
        } elseif (!empty($cart_tax_totals)) {
            $tax_string_array[] = sprintf('%s %s', wc_price(WC()->cart->get_taxes_total(true, true)), WC()->countries->tax_or_vat());
        }

        if (!empty($tax_string_array)) {
            $taxable_address = WC()->customer->get_taxable_address();
            $estimated_text  = '';
            $value .= '<small class="includes_tax">' . sprintf(__('(incl. VAT & delivery)', 'woocommerce'), implode(', ', $tax_string_array) . $estimated_text) . '</small>';
        }
    }
    return $value;
}

add_filter('woocommerce_cart_totals_order_total_html', 'custom_cart_totals_order_total_html', 20, 1);


// hide coupon field on cart page
function hide_coupon_field_on_cart($enabled)
{
    if (is_cart()) {
        $enabled = false;
    }
    return $enabled;
}
add_filter('woocommerce_coupons_enabled', 'hide_coupon_field_on_cart');

// CHECKOUT
// remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
// add_action('woocommerce_checkout_after_order_review', 'woocommerce_checkout_coupon_form');

remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
add_action('woocommerce_review_order_after_cart_contents', 'woocommerce_checkout_coupon_form_custom');
function woocommerce_checkout_coupon_form_custom()
{
    echo '<tr class="coupon-form"><td colspan="2">';

    wc_get_template(
        'checkout/form-coupon.php',
        array(
            'checkout' => WC()->checkout(),
        )
    );
    echo '</tr></td>';
}

add_filter('woocommerce_get_price_html', 'custom_price_html', 100, 2);
function custom_price_html($price, $product)
{

    $salesPriceTo   = get_post_meta($product->id, '_sale_price_dates_to', true);

    if (is_product() && $product->is_on_sale()) {

        $salePriceDateTo = "";
        $salePriceMessage = "";
        if ($salesPriceTo != "") {
            $salePriceDateTo   = date("d.m.Y", $salesPriceTo);
        }
        $salePriceMessage = __('Atlaide spēkā līdz', 'unihaus') . ' ' . $salePriceDateTo;
        // $sales_price_date_from = date("j M y", $sales_price_from);

        $percentage = round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100);
        $salePercentageBlock = '<div class="sale-percentage c--white">- ' . $percentage . ' %</div>';
        $salePriceDateToBlock = '<div class="sale-price-date-to d-flex align-items-center"><p>' . $salePriceMessage . '</p></div>';
        $breakBlock = '<div class="break"></div>';
        $saleBlock = $breakBlock . '<div class="sale-block d-flex align-items-center">' . $salePercentageBlock . $salePriceDateToBlock . '</div>';
        return $price . $saleBlock;
    }
    return $price;
}

// ORDER Received page
add_filter('the_title', 'woo_title_order_received', 10, 2);

function woo_title_order_received($title, $id)
{
    if (
        function_exists('is_order_received_page') &&
        is_order_received_page() && get_the_ID() === $id
    ) {
        $title = __('Pasūtījumu grozs', 'woocommerce');
    }
    return $title;
}

remove_filter('wp_nav_menu_objects', 'pdg_menu_item_last_class', 10, 3);

add_filter('woocommerce_attribute_show_in_nav_menus', 'wc_reg_for_menus', 10, 2);
function wc_reg_for_menus($register, $name)
{
    $allowed_attributes = array();
    $attributes = array_keys(wc_get_attribute_taxonomy_labels());
    foreach ($attributes as $attribute) {
        array_push($allowed_attributes, 'pa_' . $attribute);
    }
    if (in_array($name, $allowed_attributes)) {
        $register = true;
    }
    return $register;
}

// WOOPQ QUANTITY PLUGIN TEMPLATE OVERRIDE
function custom_woopq_quantity_input_template($located, $template_name)
{
    if ($template_name === 'global/quantity-input.php') {
        return get_stylesheet_directory() . '/wpc-product-quantity/quantity-input.php';
    }
    return $located;
}
add_filter('wc_get_template', 'custom_woopq_quantity_input_template', 10, 2);

//add checkbox
add_filter('woocommerce_checkout_fields', 'custom_woocommerce_billing_fields');

function custom_woocommerce_billing_fields($fields)
{
    $fields['billing']['privacy_policy'] = array(
        'label' => __('Iepazinos un piekrītu <a href="' .
            get_privacy_policy_url() . '">noteikumiem.</a>', 'unihaus'),
        'required' => true,
        'clear' => false,
        'type' => 'checkbox',
        'class' => array('my-css')
    );

    return $fields;
}

/**
 * Prefill Woocommerce checkout fields
 */
add_filter('woocommerce_checkout_get_value', function ($input, $key) {
    switch ($key):
        case 'billing_phone':
            return '+371';
            break;
    endswitch;
}, 10, 2);


add_filter('woocommerce_form_field', 'checkout_fields_in_label_error', 10, 4);

function checkout_fields_in_label_error($field, $key, $args, $value)
{
    if (strpos($field, '</span>') !== false && $args['required']) {
        $fieldLabel = $args['label'];
        if ($key == 'privacy_policy') {
            $fieldLabel = str_replace('.', '', $fieldLabel);
            $fieldLabel = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/si", '', $fieldLabel);
        }
        $error = '<span class="error ' . $key . ' error-required" style="display:none">';
        $error .= sprintf(__('%s ir obligāts lauks.', 'unihaus'), $fieldLabel);
        $error .= '</span>';
        if ($key == 'billing_email') {
            $error .= '<span class="error error-invalid-password" style="display:none">';
            $error .= sprintf(__('Nederīga e-pasta adrese.', 'unihaus'), $fieldLabel);
            $error .= '</span>';
        }

        if ($key == 'billing_phone') {
            $error .= '<span class="error error-invalid-phone" style="display:none">';
            $error .= sprintf(__('Tālrunis nav korekts!', 'unihaus'), $fieldLabel);
            $error .= '</span>';
        }
        $field = substr_replace($field, $error, strpos($field, '</span>'), 0);
    }
    return $field;
}

// Custom validation for Billing Phone checkout field
add_action('woocommerce_checkout_process', 'custom_validate_billing_phone');
function custom_validate_billing_phone()
{
    $is_correct = preg_match('/^(\+371)?([\s]?)([2]\d{1})([\s]?)(\d{3})([\s]?)(\d{3})$/', $_POST['billing_phone']);
    if ($_POST['billing_phone'] && !$is_correct) {
        wc_add_notice('<div class="error-phone" >' . __('Tālrunis nav korekts!', 'unihaus') . '</div>', 'error');
    }
}

// WOOCOMMERCE MINICART AJAX CHANGE 
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    ob_start();

    if (class_exists('woocommerce')) {
        get_template_part('template-parts/wc-cart');
    }

    $fragments['.wc-cart'] = ob_get_clean();
    ob_end_clean();
    return $fragments;
}

add_filter('woocommerce_coupon_error', 'coupon_error_message_change', 10, 3);

// CUSTOM COUPON MESSAGE
function coupon_error_message_change($err, $err_code, $parm)
{
    switch ($err_code) {
        case 105:
            /* translators: %s: coupon code */
            $err = '<div class="coupon-error">' . sprintf(__('Kupons "%s" neeksistē!', 'unihaus'), $parm->get_code()) . '</div>';
            break;
    }
    return $err;
}

add_filter('bcn_after_fill', 'my_static_breadcrumb_adder');
function my_static_breadcrumb_adder($breadcrumb_trail)
{
    if (is_tax('service_category')) {
        $page = get_page_by_path('pakalpojumi');
        $pageTitle = get_the_title($page);
        $pageLink = get_page_link($page);
        $new_breadcrumb = new bcn_breadcrumb($pageTitle, NULL, array('rental'), $pageLink, NULL, true);
        array_splice($breadcrumb_trail->breadcrumbs, -1, 0, array($new_breadcrumb));
        array_splice($breadcrumb_trail->breadcrumbs, -3, 1);
    }
}

//remove ?post_type= in breadcrumb item url 
add_filter('bcn_add_post_type_arg', 'my_add_post_type_arg_filt', 10, 3);
function my_add_post_type_arg_filt($add_query_arg, $type, $taxonomy)
{
    return false;
}

function wpa_show_permalinks($post_link, $post)
{
    if (is_object($post) && $post->post_type == 'service') {
        $terms = wp_get_object_terms($post->ID, 'service_category');
        if ($terms) {
            return str_replace('%service_category%', $terms[0]->slug, $post_link);
        }
        //     if ($cats = get_the_terms($post->ID, 'service_category'))
        // {
        //     $post_link = str_replace('%service_category%', get_taxonomy_parents(array_pop($cats)->term_id, 'service_category', false, '/', true), $post_link); // see custom function defined below
        // }
        // return $post_link;
    }
    return $post_link;
}
add_filter('post_type_link', 'wpa_show_permalinks', 10, 2);

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects($items, $args)
{

    // loop
    foreach ($items as &$item) {

        $widthAuto = get_field('width_auto', $item);
        if ($widthAuto) {
            array_push($item->classes, 'width-auto');
        }
        // echo $item->url;
        if ($item->title == "Palīglīdzekļi" && is_product()) {
            array_push($item->classes, 'current-menu-ancestor');
        }
    }

    // return
    return $items;
}

function custom_shop_page_redirect()
{
    if (strpos($_SERVER['REQUEST_URI'], "/shop") !== false) {
        wp_redirect(home_url('/paliglidzekli/ritenkresli/'));
        exit();
    }
}
add_action('template_redirect', 'custom_shop_page_redirect');

add_filter('woocommerce_get_order_item_totals', 'customize_email_order_line_totals', 1000, 3);
function customize_email_order_line_totals($total_rows, $order, $tax_display)
{
    unset($total_rows['shipping']);
    return $total_rows;
}

// CUSTOM SORTING

add_filter('woocommerce_catalog_orderby', 'custom_sorting_options');

function custom_sorting_options($options)
{

    $options['title'] = __('Kārtot alfabētiski', 'unihaus');
    return $options;
}

add_filter('woocommerce_get_catalog_ordering_args', 'custom_product_sorting');

function custom_product_sorting($args)
{

    // Sort alphabetically
    if (isset($_GET['orderby']) && 'title' === $_GET['orderby']) {
        $args['orderby'] = 'title';
        $args['order'] = 'asc';
    }

    return $args;
}

add_filter('woocommerce_catalog_orderby', 'remove_default_sorting_options');

function remove_default_sorting_options($options)
{

    unset($options['popularity']);
    unset($options['rating']);

    return $options;
}
