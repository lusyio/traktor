<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="yandex-verification" content="44c3ca3dc603e98a" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action('storefront_before_site'); ?>

<div id="page" class="hfeed site">
    <?php do_action('storefront_before_header'); ?>

    <div class="top-header">
        <div class="container">
            <div class="top-header-body">
                <?php
                if ($menu_items = wp_get_nav_menu_items('additional')) {
                    echo '<ul class="navbar-nav" id="menu-top">';
                    foreach ((array)$menu_items as $key => $menu_item) {
                        $title = $menu_item->title; // заголовок элемента меню (анкор ссылки)
                        $url = $menu_item->url; // URL ссылки
                        echo '<li><a href="' . $url . '">' . $title . '</a></li>';
                    }
                    echo '</ul>';
                }
                ?>
                <div>
                    <a href="skype:<?= get_field('contacts_skype', 16) ?>?chat">skype: <?= get_field('contacts_skype', 16) ?></a>
                    <a href="mailto:<?= get_field('contacts_email', 16) ?>"><?= get_field('contacts_email', 16) ?></a>
                    <?php if (is_user_logged_in()): ?>
                        <a title="<?php _e('My Account', 'woothemes'); ?>"
                           href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">Мой
                            аккаунт</a>
                    <?php else: ?>
                        <a title="<?php _e('Login / Register', 'woothemes'); ?>"
                           href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">Войти в
                            аккаунт</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-xl p-0 justify-content-between">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => 'div',
                    'container_id' => '',
                    'container_class' => 'collapse link-strike-container navbar-collapse justify-content-start header-menu',
                    'menu_id' => false,
                    'menu_class' => 'navbar-nav',
                    'depth' => 3,
                    'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                    'walker' => new wp_bootstrap_navwalker()
                ));
                ?>
                <div class="navbar-brand mr-0">
                    <div>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="/wp-content/themes/storefront-child/svg/navbar-brand.svg" alt="">
                        </a>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="header-phones">
                        <a class="mb-0 mr-2" href="https://api.whatsapp.com/send?phone=<?= get_field('contacts_phone_2', 16) ?>">
                            <img src="/wp-content/themes/storefront-child/svg/whatsapp.svg" alt="">
                        </a>
                        <a href="viber://chat?number=<?= get_field('contacts_phone_2', 16) ?>">
                            <img src="/wp-content/themes/storefront-child/svg/viber.svg" alt="">
                        </a>
                        <p>
                            <a href="tel:<?= get_field('contacts_phone_1', 16) ?>"><?= get_field('contacts_phone_1', 16) ?></a>
                            <a href="tel:<?= get_field('contacts_phone_2', 16) ?>"><?= get_field('contacts_phone_2', 16) ?></a>
                        </p>
                    </div>
                    <?php if (is_user_logged_in()): ?>
                        <a class="login-header" title="<?php _e('My Account', 'woothemes'); ?>"
                           href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                            <img src="/wp-content/themes/storefront-child/svg/login.svg" alt="login">
                        </a>
                    <?php else: ?>
                        <a class="login-header" title="<?php _e('Login / Register', 'woothemes'); ?>"
                           href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                            <img src="/wp-content/themes/storefront-child/svg/login.svg" alt="login">
                        </a>
                    <?php endif; ?>
                    <?php if (class_exists('WooCommerce')): ?>
                        <div class="s-header__basket-wr woocommerce mr-1 mr-sm-4 mt-auto mb-auto z-5 position-relative">
                            <?php
                            global $woocommerce; ?>
                            <a href="<?php echo $woocommerce->cart->get_cart_url() ?>"
                               class="basket-btn basket-btn_fixed-xs text-decoration-none position-relative">
                        <span class="basket-btn__label"><img
                                    src="/wp-content/themes/storefront-child/svg/shopping-cart.svg"
                                    alt=""></span>
                                <?php if (sprintf($woocommerce->cart->cart_contents_count) != 0): ?>
                                    <span class="basket-btn__counter"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="outer-menu">
                    <button class="navbar-toggler position-relative" type="button" style="z-index: 1">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <input class="checkbox-toggle" data-toggle="collapse" data-target="#main-nav"
                           aria-controls="" aria-expanded="false" aria-label="Toggle navigation" type="checkbox"/>
                    <div class="menu">
                        <div>
                            <div class="border-header">
                                <?php
                                wp_nav_menu(array(
                                    'menu' => 'outer',
                                    'container' => 'div',
                                    'container_id' => 'main-nav',
                                    'container_class' => 'collapse navbar-collapse justify-content-end',
                                    'menu_id' => false,
                                    'menu_class' => 'navbar-nav',
                                    'depth' => 3,
                                    'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                                    'walker' => new wp_bootstrap_navwalker()
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

    </header><!-- #masthead -->

    <?php
    /**
     * Functions hooked in to storefront_before_content
     *
     * @hooked storefront_header_widget_region - 10
     * @hooked woocommerce_breadcrumb - 10
     */
    do_action('storefront_before_content');
    ?>

    <div id="content" class="site-content">
        <div class="container">
            <div class="row">

<?php
do_action('storefront_content_top');
