<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

</div><!-- .row -->
</div><!-- .container -->

<?php do_action('storefront_before_footer'); ?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-top">
            <div class="footer-contact">
                <div>
                    <a class="footer-contact__phone"
                       href="tel:<?= get_field('contacts_phone_1', 16) ?>"><?= get_field('contacts_phone_1', 16) ?></a>
                    <p class="footer-contact__title">WhatsApp и Viber</p>
                    <p class="footer-contact__info">Только для письма и обмена фотографиями</p>
                </div>
                <div>
                    <a class="footer-contact__phone"
                       href="tel:<?= get_field('contacts_phone_2', 16) ?>"><?= get_field('contacts_phone_2', 16) ?></a>
                    <p class="footer-contact__title">
                        <a href="mailto:<?= get_field('contacts_email', 16) ?>">
                            <?= get_field('contacts_email', 16) ?>
                        </a>
                    </p>
                    <p class="footer-contact__info"><?= get_field('contacts_worktime', 16) ?></p>
                </div>
            </div>
            <?php
            if ($menu_items = wp_get_nav_menu_items('second')) {
                echo '<ul class="footer-menu link-strike-container-footer" id="menu-second">';
                $half_count = ceil(count($menu_items) / 2);
                foreach ((array)$menu_items as $key => $menu_item) {
                    $title = $menu_item->title; // заголовок элемента меню (анкор ссылки)
                    $url = $menu_item->url; // URL ссылки
                    echo '<li><a href="' . $url . '">' . $title . '</a></li>';
                }
                echo '</ul>';
            }
            ?>
        </div>
    </div>
    <hr class="footer-hr">
    <div class="container">
        <div class="after-footer">
            <p class="after-footer__copyright">
                <?= date('Y'); ?> &copy; <?= get_bloginfo('name') ?>
            </p>
            <?php
            if ($menu_items = wp_get_nav_menu_items('additional')) {
                echo '<ul class="after-footer__menu" id="menu-after-footer">';
                foreach ((array)$menu_items as $key => $menu_item) {
                    $title = $menu_item->title; // заголовок элемента меню (анкор ссылки)
                    $url = $menu_item->url; // URL ссылки
                    echo '<li><a href="' . $url . '">' . $title . '</a></li>';
                }
                echo '<li><a href="' . get_permalink(163) . ' ">Политика конфиденциальности</a></li>';
                echo '</ul>';
            }
            ?>
            <p class="after-footer__richbee">
                <a target="_blank" href="https://richbee.ru/">
                    <img src="/wp-content/themes/storefront-child/svg/richbee-logo.svg" alt="">
                </a>
            </p>
        </div>
    </div>


    <div class="col-full">

        <?php
        /**
         * Functions hooked in to storefront_footer action
         *
         * @hooked storefront_footer_widgets - 10
         * @hooked storefront_credit         - 20
         */
        do_action('storefront_footer');
        ?>

    </div><!-- .col-full -->
</footer><!-- #colophon -->

<script>
    jQuery(function ($) {
        $('#alg_checkout_files_upload_button_1').val('Выберите файл')
        $('.checkbox-toggle').on('change', function () {
            if ($('.checkbox-toggle').is(':checked')) {
                $('body').addClass('overflow-hidden');
            } else {
                $('body').removeClass('overflow-hidden');
            }
        });
    })
</script>

<?php do_action('storefront_after_footer'); ?>

</div><!-- #page -->

<?php wp_footer(); ?>
<!-- Yandex.Metrika counter --><script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(65459941, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, ecommerce:"dataLayer" });</script><noscript><div><img src="https://mc.yandex.ru/watch/65459941" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>