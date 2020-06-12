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
                    <a class="footer-contact__phone" href="tel:8 (916) 388-57-91">8 (916) 388-57-91</a>
                    <p class="footer-contact__title">WhatsApp и Viber</p>
                    <p class="footer-contact__info">Только для письма и обмена фотографиями</p>
                </div>
                <div>
                    <a class="footer-contact__phone" href="tel:8 (926) 212-91-03">8 (926) 212-91-03</a>
                    <p class="footer-contact__title">shop@minitraktorcz.ru</p>
                    <p class="footer-contact__info">Понедельник - Пятница с 9:00 до 18:00</p>
                </div>
            </div>
            <?php
            if ($menu_items = wp_get_nav_menu_items('second')) {
                echo '<ul class="footer-menu" id="menu-second">';
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

<?php do_action('storefront_after_footer'); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>