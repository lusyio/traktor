<?php
/*
Template Name: main-landing
Template Post Type: post, page, product
*/
?>

<?php get_header(); ?>

</div>
</div>
<div class="main-after-header">
    <div class="container main-after-header__container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-12">
                <h1 class="main-after-header__title">Продажа запчастей</h1>
                <p class="main-after-header__info">ДЛЯ ЧЕШСКОЙ ТЕХНИКИ ТZ-4К-14 (МТ8-132), MF-70, TERRA VARI</p>
                <div class="card-traktor">
                    <div class="card-traktor__body">
                        <p class="card-traktor__title">Быстрый заказ</p>
                        <p class="card-traktor__info">Если вы не хотите терять время на поиск необходимых запчастей,
                            оставьте свой номер телефона, и менеджер свяжется с вами, чтобы быстро оформить заявку</p>
                        <?= do_shortcode('[caldera_form id="CF5ee890fd2761f"]') ?>
                        <p class="card-traktor__oferta">Нажимая кнопку “Оформить заявку” вы даете согласие на обработку
                            своих персональных данных</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container main-parts">
        <div class="row">
            <div class="col-lg-4">
                <h2 class="main-parts__title">Запчасти по принадлежности к технике:</h2>
            </div>
        </div>
        <img class="main-parts__img" src="/wp-content/themes/storefront-child/images/main-parts.png" alt="">
        <?= get_categories_list() ?>
    </div>
</div>
<div class="position-relative">
    <img class="main-delivery__img-2" src="/wp-content/themes/storefront-child/images/main-delivery-2.jpg" alt="">
    <?= add_delivery_block() ?>
</div>
<div>
    <div class="container youtube-block">
        <div class="row">
            <div class="col-lg-7 col-12 order-lg-1 order-2">
                <div class="thumbnail_container position-relative text-center">
                    <div id="player">
                        <div id="ytplayer"></div>

                    </div>
                    <div class="thumbnail-block" style="background-image: url('<?= get_field( 'thumbnail_block'); ?>');">
                        <a class="start-video"><img alt="" src="/wp-content/themes/storefront-child/svg/youtube-start.svg"></a>
                    </div>
                </div>
                <script>
                    // Load the IFrame Player API code asynchronously.
                    let tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/player_api";
                    let firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                    // YouTube player after the API code downloads.
                    let player;

                    function onYouTubePlayerAPIReady() {
                        player = new YT.Player('ytplayer', {
                            height: '334',
                            width: '594',
                            videoId: '<?= get_field( 'player_link'); ?>'
                        });
                    }

                    jQuery(document).on('click', '.start-video', function () {
                        jQuery("#player").show();
                        jQuery(".thumbnail-block").fadeOut(350);
                        player.playVideo();
                    });

                </script>
            </div>
            <div class="col-lg-5 col-12 order-lg-2 order-1">
                <p class="youtube-block__title">Посмотрите наш канал на Youtube</p>
                <p class="youtube-block__info">Там вы сможете найти ответы на распространенные проблемы и поломки,
                    связанные с тракторами ТZ-4К-14, MF-70, Terra Vari</p>
                <a class="youtube-block__link" href="<?= get_field( 'youtube_link'); ?>">Перейти на Youtube</a>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
