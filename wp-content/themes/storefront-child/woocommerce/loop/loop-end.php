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

$activeCat = get_queried_object();
$parentCatsId = get_ancestors($activeCat->term_id, 'product_cat');
$parentCategory = get_term($parentCatsId[0], 'product_cat');
?>
</div>

<div class="row">
    <?php if ($activeCat->parent === 0): ?>
        <div class="col-12">
            <p class="category-filter-title">Показаны <?= $activeCat->name ?> <strong><?= $activeCat->description ?></strong></p>
        </div>
    <?php else: ?>
        <div class="col-12">
            <p class="category-filter-title">Показаны <?= $parentCategory->name ?> <strong><?= $parentCategory->description ?></strong></p>
            <?php if ($activeCat->parent !== 0): ?>
                <p class="category-filter-title">в разделе <strong><?= $activeCat->name ?></strong></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="col-lg-3 col-12">
        <?php
        if ($activeCat->parent === 0) {
            echo woocommerce_subcats_from_parentcat_by_ID($activeCat->term_id, $activeCat->term_id);
        } else {
            echo woocommerce_subcats_from_parentcat_by_ID($parentCatsId[0], $activeCat->term_id);
        }
        ?>
    </div>
    <div class="col-lg-9 col-12">
        <div class="row">
            <?= get_products_by_category_slug($activeCat->slug) ?>
        </div>
    </div>
</div>