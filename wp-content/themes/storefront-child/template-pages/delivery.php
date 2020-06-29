<?php
/*
Template Name: delivery
Template Post Type: post, page, product
*/
?>

<?php get_header(); ?>

<div class="container delivery">
    <header class="entry-header">
        <h1 class="entry-title"><?= the_title(); ?></h1>
    </header>
    <?php the_content(); ?>
    <div class="row">
        <div class="col-lg-4 col-12 d-flex">
            <div class="card-delivery">
                <div class="card-delivery__header"
                     style="background: url('/wp-content/themes/storefront-child/images/cdek.png') center;">
                </div>
                <div class="card-delivery__body">
                    <h3 class="card-delivery__title">Доставка CDEK</h3>
                    <p class="card-delivery__info mb-2">Доставка до двери или до пункта выдачи</p>
                    <p class="card-delivery__info mb-2">Доставка оплачивается при получении</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 d-flex">
            <div class="card-delivery">
                <div class="card-delivery__header"
                     style="background: url('/wp-content/themes/storefront-child/images/delovie-linii.png') center;">
                </div>
                <div class="card-delivery__body">
                    <h3 class="card-delivery__title">Доставка Деловые линии</h3>
                    <p class="card-delivery__info mb-2">Доставка до двери или до пункта выдачи</p>
                    <p class="card-delivery__info mb-2">Доставка оплачивается при получении</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 d-flex">
            <div class="card-delivery">
                <div class="card-delivery__header"
                     style="background: url('/wp-content/themes/storefront-child/images/pochta-rossii.jpg') center;">
                </div>
                <div class="card-delivery__body">
                    <h3 class="card-delivery__title">Доставка Почта России</h3>
                    <p class="card-delivery__info mb-2">Доступно только физическим лицам</p>
                    <p class="card-delivery__info mb-2">Стоимость доставки включена в стоимость заказа</p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
