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
            <div class="col-lg-5 col-12">
                <h1 class="main-after-header__title">Продажа запчастей</h1>
                <p class="main-after-header__info">ДЛЯ ЧЕШСКОЙ ТЕХНИКИ ТZ-4К-14 (МТ8-132), MF-70, TERRA VARI</p>
                <div class="card-traktor">
                    <div class="card-traktor__body">
                        <p class="card-traktor__title">Быстрый заказ</p>
                        <p class="card-traktor__info">Если вы не хотите терять время на поиск необходимых запчастей,
                            оставьте свой номер телефона, и менеджер свяжется с вами, чтобы быстро оформить заявку</p>
                        <input class="input-traktor-primary" placeholder="+ 7 (_ _ _)-_ _-_ _" type="text">
                        <button class="btn btn-traktor-primary">Оформить заявку</button>
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
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="card-parts">
                    <div class="card-parts__body">
                        <div>
                            <p class="card-parts__category">запчасти для минитрактора</p>
                            <p class="card-parts__title">TZ-4k-14 (MT8-132)</p>
                            <a class="card-parts__link" href="">Перейти в каталог</a>
                        </div>
                        <img src="/wp-content/themes/storefront-child/images/traktor.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card-parts">
                    <div class="card-parts__body">
                        <div>
                            <p class="card-parts__category">запчасти для минитрактора</p>
                            <p class="card-parts__title">TZ-4k-14 (MT8-132)</p>
                            <a class="card-parts__link" href="">Перейти в каталог</a>
                        </div>
                        <img src="/wp-content/themes/storefront-child/images/traktor.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card-parts">
                    <div class="card-parts__body">
                        <div>
                            <p class="card-parts__category">запчасти для минитрактора</p>
                            <p class="card-parts__title">TZ-4k-14 (MT8-132)</p>
                            <a class="card-parts__link" href="">Перейти в каталог</a>
                        </div>
                        <img src="/wp-content/themes/storefront-child/images/traktor.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= add_delivery_block() ?>

    <div class="container youtube-block">
        <div class="row">
            <div class="col-lg-7 col-12">
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
                            width: '539',
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
            <div class="col-lg-5 col-12">
                <p class="youtube-block__title">Посмотрите наш канал на Youtube</p>
                <p class="youtube-block__info">Там вы сможете найти ответы на распространенные проблемы и поломки,
                    связанные с тракторами ТZ-4К-14, MF-70, Terra Vari</p>
                <a class="youtube-block__link" href="<?= get_field( 'youtube_link'); ?>">Перейти на Youtube</a>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
