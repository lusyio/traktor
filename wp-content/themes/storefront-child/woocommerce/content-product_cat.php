<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if (!defined('ABSPATH')) {
    exit;
}
$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
$image = wp_get_attachment_url($thumbnail_id);
?>
<div class="col-lg-4 col-sm-6 col-12 d-flex">
    <a class="d-flex w-100" href="<?= get_term_link($category->term_id, 'product_cat') ?>">
        <div id="<?= $category->slug ?>" class="category-card d-flex w-100" style='background-image: url("<?= $image ?>")'>
            <div class="category-card__body">
                <p class="category-card__name"><?= $category->name ?></p>
                <p class="category-card__description"><?= $category->description ?></p>
            </div>
        </div>
    </a>
</div>
