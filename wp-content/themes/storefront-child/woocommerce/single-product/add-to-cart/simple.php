<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) {
    return;
}

echo wc_get_stock_html($product); // WPCS: XSS ok.

if ($product->is_in_stock()) : ?>

    <?php do_action('woocommerce_before_add_to_cart_form'); ?>
    <?php if ($product->manage_stock === 'yes'): ?>
        <p class="product-in-stock">В наличии: <?= $product->stock_quantity; ?></p>
    <?php else: ?>
        <p class="product-in-stock">В наличии</p>
    <?php endif; ?>
    <?php if (get_field('product_weight') !== '') : ?>
        <p class="product-info">Вес: <?= get_field('product_weight') ?></p>
    <?php endif; ?>
    <?php if ($product->sku !== '') : ?>
        <p class="product-info">Номер в каталоге: №<?= $product->sku ?></p>
    <?php endif; ?>
    <form class="cart"
          action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
          method="post" enctype='multipart/form-data'>
        <p class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>"><?php echo $product->get_price_html(); ?></p>
        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <?php
        do_action('woocommerce_before_add_to_cart_quantity');

        woocommerce_quantity_input(
            array(
                'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
            )
        );

        do_action('woocommerce_after_add_to_cart_quantity');
        ?>

        <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
                class="single_add_to_cart_button button alt"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
    </form>

    <?php do_action('woocommerce_after_add_to_cart_form'); ?>
    <a style="max-width: 260px" class="btn btn-traktor-primary d-block ml-auto" href="/product-category/minitractor/">Вернуться
        в каталог</a>

<?php else: ?>
    <p class="product-out-stock">Нет в наличии</p>
    <a style="max-width: 260px" class="btn btn-traktor-primary d-block ml-auto" href="/product-category/minitractor/">Вернуться
        в каталог</a>
<?php endif; ?>
