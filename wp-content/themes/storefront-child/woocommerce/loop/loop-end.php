<?php
/**
 * Product Loop End
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-end.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $wp_query;
$activeCat = $wp_query->get_queried_object();
?>
</div>
<div class="row">
    <div class="col-lg-3 col-12">
        <?php
        $args = array(
            'taxonomy' => "product_cat",
        );
        $product_categories = get_terms($args);
        foreach ($product_categories as $product_category) {
            echo woocommerce_subcats_from_parentcat_by_ID($product_category->term_id, $activeCat->term_id);
        }
        ?>
    </div>
    <div class="col-lg-9 col-12">
        <div class="row">
            <?= get_products_by_category_slug($activeCat->slug) ?>
        </div>
    </div>
</div>