<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

$_product = wc_get_product( $product_id );
$_max     = $_product->get_max_purchase_quantity();

if ( isset( $woosb_qty ) ) {
	// overwrite by WPC Product Bundles
	$min_value   = $woosb_qty['min_value'];
	$max_value   = $woosb_qty['max_value'];
	$input_value = $woosb_qty['input_value'];
} elseif ( isset( $woobt_qty ) ) {
	// overwrite by WPC Frequently Bought Together
	$min_value   = $woobt_qty['min_value'];
	$max_value   = $woobt_qty['max_value'];
	$input_value = $woobt_qty['input_value'];
} elseif ( isset( $overwrite_qty ) ) {
	// overwrite by filter
	$min_value   = $overwrite_qty['min_value'];
	$max_value   = $overwrite_qty['max_value'];
	$input_value = $overwrite_qty['input_value'];
}

if ( $max_value && $min_value == $max_value ) {
	?>
    <div class="quantity woopq-quantity-hidden <?php echo( $_max > 0 && ( $_max < $min_value ) ? 'woopq-quantity-disabled' : '' ); ?>">
        <input type="number" id="<?php echo esc_attr( $input_id ); ?>" class="qty"
               name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" readonly/>
    </div>
	<?php
} else {
	if ( $min_value && ( $input_value < $min_value ) ) {
		$input_value = $min_value;
	}

	if ( $max_value && ( $input_value > $max_value ) ) {
		$input_value = $max_value;
	}

	$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'wpc-product-quantity' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'wpc-product-quantity' );

	// $product_id from woopq_quantity_input_args()
	$woopq_type   = '';
	$woopq_values = array();

	if ( $_product->is_type( 'variation' ) ) {
		$woopq_quantity = get_post_meta( $product_id, '_woopq_quantity', true ) ?: 'parent';
	} else {
		$woopq_quantity = get_post_meta( $product_id, '_woopq_quantity', true ) ?: 'default';
	}

	if ( ( $woopq_quantity === 'parent' ) ) {
		if ( $_product->is_type( 'variation' ) && ( $parent_id = $_product->get_parent_id() ) ) {
			$woopq_quantity = get_post_meta( $parent_id, '_woopq_quantity', true ) ?: 'default';

			if ( $woopq_quantity === 'overwrite' ) {
				$woopq_type   = get_post_meta( $parent_id, '_woopq_type', true );
				$woopq_values = get_post_meta( $parent_id, '_woopq_values', true );
			} elseif ( $woopq_quantity === 'default' ) {
				$woopq_type   = get_option( '_woopq_type', 'default' );
				$woopq_values = get_option( '_woopq_values' );
			}
		}
	} elseif ( $woopq_quantity === 'overwrite' ) {
		$woopq_type   = get_post_meta( $product_id, '_woopq_type', true );
		$woopq_values = get_post_meta( $product_id, '_woopq_values', true );
	} elseif ( $woopq_quantity === 'default' ) {
		$woopq_type   = get_option( '_woopq_type', 'default' );
		$woopq_values = get_option( '_woopq_values' );
	}

	if ( isset( $woosb_qty ) || isset( $woobt_qty ) || isset( $overwrite_qty ) ) {
		// overwrite by WPC Product Bundles/ WPC Frequently Bought Together
		$woopq_quantity = 'overwrite';
		$woopq_type     = 'default';
	}

	$woopq_quantity = apply_filters( 'woopq_product_quantity', $woopq_quantity, $product_id );
	$woopq_type     = apply_filters( 'woopq_product_type', $woopq_type, $product_id );
	?>
    <div class="<?php echo esc_attr( 'quantity woopq-quantity woopq-quantity-' . $woopq_quantity . ' woopq-type-' . $woopq_type ); ?>"
         data-min="<?php echo esc_attr( $min_value ); ?>" data-max="<?php echo esc_attr( $max_value ); ?>"
         data-step="<?php echo esc_attr( $step ); ?>" data-value="<?php echo esc_attr( $input_value ); ?>">
		<?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
        <label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>">
			<?php echo esc_attr( $label ); ?>
        </label>
		<?php
		if ( $woopq_type === 'select' ) {
			$woopq_values = WPCleverWoopq::woopq_values( $woopq_values );
			?>
            <select id="<?php echo esc_attr( $input_id ); ?>"
                    class="qty"
                    name="<?php echo esc_attr( $input_name ); ?>"
                    title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'wpc-product-quantity' ); ?>">
				<?php
				$s = 1;

				foreach ( $woopq_values as $woopq_value ) {
					echo '<option value="' . esc_attr( $woopq_value['value'] ) . '" ' . ( $input_value == $woopq_value['value'] ? 'selected' : '' ) . ' ' . ( ( $s > 1 ) && ( $max_value > 0 && (float) $woopq_value['value'] > $max_value ) ? 'disabled' : '' ) . '>' . $woopq_value['name'] . '</option>';
					$s ++;
				}
				?>
            </select>
			<?php
		} elseif ( $woopq_type === 'radio' ) {
			$woopq_values = WPCleverWoopq::woopq_values( $woopq_values );
			$s            = 1;

			foreach ( $woopq_values as $woopq_value ) {
				echo '<input type="radio" name="' . esc_attr( $input_name ) . '" value="' . esc_attr( $woopq_value['value'] ) . '" ' . ( $input_value == $woopq_value['value'] ? 'checked' : '' ) . ' ' . ( ( $s > 1 ) && ( $max_value > 0 && (float) $woopq_value['value'] > $max_value ) ? 'disabled' : '' ) . '/> ' . $woopq_value['name'] . '<br/>';
				$s ++;
			}
		} else {
			// default
			if ( get_option( '_woopq_plus_minus', 'hide' ) === 'show' ) {
				echo '<div class="woopq-quantity-input">';
				echo '<div class="woopq-quantity-input-minus">-</div>';
			}
			?>
			<div style="position: relative;">
				<input
						type="number"
						id="<?php echo esc_attr( $input_id ); ?>"
						class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
						step="<?php echo esc_attr( $step ); ?>"
						min="<?php echo esc_attr( $min_value ); ?>"
						max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
						name="<?php echo esc_attr( $input_name ); ?>"
						value="<?php echo esc_attr( $input_value ); ?>"
						title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'wpc-product-quantity' ); ?>"
						size="4"
						placeholder="<?php echo esc_attr( $placeholder ); ?>"
						inputmode="<?php echo esc_attr( $inputmode ); ?>"/>
						<span class="item-name">gab</span>
			</div>
			<?php
			if ( get_option( '_woopq_plus_minus', 'hide' ) === 'show' ) {
				echo '<div class="woopq-quantity-input-plus">+</div>';
				echo '</div><!-- /woopq-quantity-input -->';
			}
		} ?>
		<?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
    </div>
	<?php
}