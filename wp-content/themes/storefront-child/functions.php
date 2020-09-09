<?php
/**
 * Richbee functions and definitions
 *
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );
/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style()
{
    wp_dequeue_style('storefront-style');
    wp_dequeue_style('storefront-woocommerce-style');
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */
function enqueue_child_theme_styles()
{
// load bootstrap css
    wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri() . '/inc/assets/css/bootstrap.min.css', false, NULL, 'all');
// fontawesome cdn
    wp_enqueue_style('wp-bootstrap-pro-fontawesome-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css');
// load bootstrap css
// load AItheme styles
// load WP Bootstrap Starter styles
    wp_enqueue_style('wp-bootstrap-starter-style', get_stylesheet_uri(), array('theme'));
    if (get_theme_mod('theme_option_setting') && get_theme_mod('theme_option_setting') !== 'default') {
        wp_enqueue_style('wp-bootstrap-starter-' . get_theme_mod('theme_option_setting'), get_template_directory_uri() . '/inc/assets/css/presets/theme-option/' . get_theme_mod('theme_option_setting') . '.css', false, '');
    }
    wp_enqueue_style('wp-bootstrap-starter-robotoslab-roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap');

    wp_enqueue_script('jquery');

    // Internet Explorer HTML5 support
    wp_enqueue_script('html5hiv', get_template_directory_uri() . '/inc/assets/js/html5.js', array(), '3.7.0', false);
    wp_script_add_data('html5hiv', 'conditional', 'lt IE 9');

// load swiper js and css
    wp_enqueue_script('wp-swiper-js', get_stylesheet_directory_uri() . '/inc/assets/js/swiper.min.js', array(), '', true);
    wp_enqueue_style('wp-swiper-js', get_stylesheet_directory_uri() . '/inc/assets/css/swiper.min.css', array(), '', true);

// load bootstrap js
    wp_enqueue_script('wp-bootstrap-starter-popper', get_stylesheet_directory_uri() . '/inc/assets/js/popper.min.js', array(), '', true);
    wp_enqueue_script('wp-bootstrap-starter-bootstrapjs', get_stylesheet_directory_uri() . '/inc/assets/js/bootstrap.min.js', array(), '', true);
    wp_enqueue_script('wp-bootstrap-starter-themejs', get_stylesheet_directory_uri() . '/inc/assets/js/theme-script.min.js', array(), '', true);
    wp_enqueue_script('wp-bootstrap-starter-skip-link-focus-fix', get_stylesheet_directory_uri() . '/inc/assets/js/skip-link-focus-fix.min.js', array(), '', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
//enqueue my child theme stylesheet
    wp_enqueue_style('child-style', get_stylesheet_uri(), array('theme'));
}

add_action('wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);

remove_action('wp_head', 'feed_links_extra', 3); // убирает ссылки на rss категорий
remove_action('wp_head', 'feed_links', 2); // минус ссылки на основной rss и комментарии
remove_action('wp_head', 'rsd_link');  // сервис Really Simple Discovery
remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer
remove_action('wp_head', 'wp_generator');  // скрыть версию wordpress

/**
 * Load custom WordPress nav walker.
 */
if (!class_exists('wp_bootstrap_navwalker')) {
    require_once(get_stylesheet_directory() . '/inc/wp_bootstrap_navwalker.php');
}

/**
 * Удаление json-api ссылок
 */
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('template_redirect', 'rest_output_link_header', 11);

/**
 * Cкрываем разные линки при отображении постов блога (следующий, предыдущий, короткий url)
 */
remove_action('wp_head', 'start_post_rel_link', 10);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
remove_action('wp_head', 'wp_shortlink_wp_head', 10);

/**
 * `Disable Emojis` Plugin Version: 1.7.2
 */
if ('Отключаем Emojis в WordPress') {

    /**
     * Disable the emoji's
     */
    function disable_emojis()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
        add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
    }

    add_action('init', 'disable_emojis');

    /**
     * Filter function used to remove the tinymce emoji plugin.
     *
     * @param array $plugins
     * @return   array             Difference betwen the two arrays
     */
    function disable_emojis_tinymce($plugins)
    {
        if (is_array($plugins)) {
            return array_diff($plugins, array('wpemoji'));
        }

        return array();
    }

    /**
     * Remove emoji CDN hostname from DNS prefetching hints.
     *
     * @param array $urls URLs to print for resource hints.
     * @param string $relation_type The relation type the URLs are printed for.
     * @return array                 Difference betwen the two arrays.
     */
    function disable_emojis_remove_dns_prefetch($urls, $relation_type)
    {

        if ('dns-prefetch' == $relation_type) {

            // Strip out any URLs referencing the WordPress.org emoji location
            $emoji_svg_url_bit = 'https://s.w.org/images/core/emoji/';
            foreach ($urls as $key => $url) {
                if (strpos($url, $emoji_svg_url_bit) !== false) {
                    unset($urls[$key]);
                }
            }

        }

        return $urls;
    }

}

/**
 * Удаляем стили для recentcomments из header'а
 */
function remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

add_action('widgets_init', 'remove_recent_comments_style');

/**
 * Удаляем ссылку на xmlrpc.php из header'а
 */
remove_action('wp_head', 'wp_bootstrap_starter_pingback_header');

/**
 * Удаляем стили для #page-sub-header из  header'а
 */
remove_action('wp_head', 'wp_bootstrap_starter_customizer_css');

/*
*Обновление количества товара
*/
add_filter('woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment');

function header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    ?>
    <span class="basket-btn__counter"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>
    <?php
    $fragments['.basket-btn__counter'] = ob_get_clean();
    return $fragments;
}

/**
 * Замена надписи на кнопке Добавить в корзину
 */
add_filter('woocommerce_product_single_add_to_cart_text', 'woocust_change_label_button_add_to_cart_single');
function woocust_change_label_button_add_to_cart_single($label)
{

    $label = 'Добавить в корзину';

    return $label;
}

remove_action('storefront_footer', 'storefront_credit', 20);

/**
 * Remove product data tabs
 */
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);

function woo_remove_product_tabs($tabs)
{

    unset($tabs['description']);        // Remove the description tab
    unset($tabs['reviews']);            // Remove the reviews tab
    unset($tabs['additional_information']);    // Remove the additional information tab

    return $tabs;
}

//Количество товаров для вывода на странице магазина
add_filter('loop_shop_per_page', 'wg_view_all_products');

function wg_view_all_products()
{
    return '9';
}

//Удаление сортировки
add_action('init', 'bbloomer_delay_remove');

function bbloomer_delay_remove()
{
    remove_action('woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 20);

}

/*
*Изменение количетсва товара на строку на страницах woo
*/
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns()
    {
        return 3; // 3 products per row
    }
}


//Удаление сторфронт-кредит
add_action('init', 'custom_remove_footer_credit', 10);

function custom_remove_footer_credit()
{
    remove_action('storefront_footer', 'storefront_credit', 20);
    add_action('storefront_footer', 'custom_storefront_credit', 20);
}


//Добавление favicon
function favicon_link()
{
    echo '<link rel="shortcut icon" type="image/x-icon" href="/wp-content/themes/storefront-child/favicon.png" />' . "\n";
}

add_action('wp_head', 'favicon_link');

//Изменение entry-content
function storefront_page_content()
{
    ?>
    <div class="row">
        <?php the_content(); ?>
        <?php
        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . __('Pages:', 'storefront'),
                'after' => '</div>',
            )
        );
        ?>
    </div>
    <?php
}

add_filter('woocommerce_sale_flash', 'my_custom_sale_flash', 10, 3);
function my_custom_sale_flash($text, $post, $_product)
{
    return '<span class="onsale">SALE!</span>';
}

// Колонки related
add_filter('woocommerce_output_related_products_args', 'jk_related_products_args');
function jk_related_products_args($args)
{
    $args['posts_per_page'] = 6; // количество "Похожих товаров"
    $args['columns'] = 4; // количество колонок
    return $args;
}

/**
 * Get front-end delivery-block
 * @param bool $img
 * @param bool $cls
 * @return string
 */
function add_delivery_block($img = true, $cls = false)
{
    $imgHtml = '';
    $img
        ? $imgHtml = '<img class="main-delivery__img" src="/wp-content/themes/storefront-child/images/main-delivery.png" alt="">
                <div class="row">
                <div class="col-xl-4 col-lg-5 col-12 offset-xl-8 offset-lg-7 offset-0">
                    <h3 class="main-delivery__title">Обеспечиваем комфортные условия работы</h3>
                </div>
                 </div>'
        : $imgHtml = '';
    return
        '<div class="container main-delivery ' . $cls . '">
        ' . $imgHtml . '
        <div class="row">
            <div class="col-xl-5 col-lg-6 offset-xl-1 offset-lg-0 col-12 offset-0">
                <div class="card-delivery card-1">
                    <div class="card-delivery__body">
                        <p class="card-delivery__title">Бесплатная доставка до транспортных компаний</p>
                        <a class="card-delivery__link" href="' . get_page_link(8) . '">Способы доставки</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="card-delivery card-2">
                    <div class="card-delivery__body">
                        <p class="card-delivery__title">Возможна отправка наложенным платежом</p>
                        <a class="card-delivery__link" href="' . get_page_link(10) . '">Способы оплаты</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card-delivery card-3">
                    <div class="card-delivery__body">
                        <p class="card-delivery__title">Консультируем по любым вопросам</p>
                        <p class="card-delivery__info">Вы можете посмотреть ответы на самые распространенные вопросы</p>
                        <a class="card-delivery__link" href="' . get_page_link(18) . '">Ответы на частые вопросы по неисправностям</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card-delivery card-4">
                    <div class="card-delivery__body">
                        <p class="card-delivery__title">Не просто продаем, а занимаемся ремонтом</p>
                        <p class="card-delivery__info">И снимаем видео о частых проблемах и поломках</p>
                        <a class="card-delivery__link" href=" ' . get_field('youtube_link', 20) . ' ">Смотреть видео</a>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10);

add_action('wp_footer', 'custom_quantity_fields_script');
function custom_quantity_fields_script()
{
    ?>
    <script type='text/javascript'>
        jQuery(function ($) {
            if (!String.prototype.getDecimals) {
                String.prototype.getDecimals = function () {
                    var num = this,
                        match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                    if (!match) {
                        return 0;
                    }
                    return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
                }
            }
            $(document.body).on('click', '.plus, .minus', function () {
                var $qty = $(this).closest('.quantity').find('.qty'),
                    currentVal = parseFloat($qty.val()),
                    max = parseFloat($qty.attr('max')),
                    min = parseFloat($qty.attr('min')),
                    step = $qty.attr('step');

                if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
                if (max === '' || max === 'NaN') max = '';
                if (min === '' || min === 'NaN') min = 0;
                if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

                if ($(this).is('.plus')) {
                    if (max && (currentVal >= max)) {
                        $qty.val(max);
                    } else {
                        $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
                    }
                } else {
                    if (min && (currentVal <= min)) {
                        $qty.val(min);
                    } else if (currentVal > 0) {
                        $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
                    }
                }

                // Trigger change event
                $qty.trigger('change');
            });
        });
    </script>
    <?php
}

add_action('wp', 'remove_zoom_lightbox_theme_support', 99);

function remove_zoom_lightbox_theme_support()
{
    remove_theme_support('wc-product-gallery-zoom');
}

/**
 * Get subcategories from parent category ID
 * @param $parent_cat_ID
 * @param $active_cat_ID
 */
function woocommerce_subcats_from_parentcat_by_ID($parent_cat_ID, $active_cat_ID)
{
    $args = array(
        'hierarchical' => 1,
        'show_option_none' => '',
        'hide_empty' => 0,
        'parent' => $parent_cat_ID,
        'taxonomy' => 'product_cat'
    );

    $subcats = get_categories($args);
    echo '<ul class="subcategory-list">';
    foreach ($subcats as $subcat) {
        if ($active_cat_ID === $subcat->term_id) {
            $active = 'active';
        } else {
            $active = '';
        }
        $link = get_term_link($subcat->slug, $subcat->taxonomy);
        echo '<li class="' . $active . '"><a href="' . $link . '">' . $subcat->name . '</a> <span>' . $subcat->count . ' </span></li>';
    }
    echo '</ul>';
}

/**
 * Get products by category slug
 * @param string $slug
 * @return false|string
 */
function get_products_by_category_slug($slug = '')
{
    if ($slug) {
        global $paged;
        $args = array(
            'category' => array($slug),
            'limit' => -1,
            'posts_per_page' => 9,
            'pagination' => true,
            'page' => $paged
        );
    } else {
        $args = [];
    }
    $products = wc_get_products($args);
    ob_start();
    foreach ($products as $product):
        $image_id = $product->get_image_id();
        ?>
        <div class="col-lg-4 col-sm-6 col-12 d-flex">
            <div class="product-card">
                <div class="product-card__body">
                    <a href="<?= $product->get_permalink() ?>">
                        <?php if ($image_id): ?>
                            <img class="product-card__img"
                                 src="<?= wp_get_attachment_image_url($image_id, 'medium') ?>"
                                 alt="<?= $product->name ?>">
                        <?php else: ?>
                            <img class="product-card__img"
                                 src="<?= wc_placeholder_img_src('medium') ?>"
                                 alt="<?= $product->name ?>">
                        <?php endif; ?>
                    </a>
                    <h4 class="product-card__name"><?= $product->name ?></h4>
                    <p>
                        <span><?= $product->get_price_html(); ?> </span>
                        <?= $product->is_in_stock() ? '<span class="product-card__in-stock">В наличии</span>' : '<span class="product-card__out-stock">Нет в наличии</span>' ?>
                    </p>
                    <a class="product-card__link" href="<?= $product->get_permalink() ?>">Подробнее</a>
                </div>
            </div>
        </div>
    <?php
    endforeach;
    return ob_get_clean();
}

function get_pagination_woo()
{
    $total = isset($total) ? $total : wc_get_loop_prop('total_pages');
    $current = isset($current) ? $current : wc_get_loop_prop('current_page');
    $base = isset($base) ? $base : esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))));
    $format = isset($format) ? $format : '';

    if ($total <= 1) {
        return;
    }
    ob_start(); ?>
    <nav class="woocommerce-pagination">
        <?php
        echo paginate_links(
            apply_filters(
                'woocommerce_pagination_args',
                array( // WPCS: XSS ok.
                    'base' => $base,
                    'format' => $format,
                    'add_args' => false,
                    'current' => max(1, $current),
                    'total' => $total,
                    'prev_text' => '&larr;',
                    'next_text' => '&rarr;',
                    'type' => 'list',
                    'end_size' => 3,
                    'mid_size' => 3,
                )
            )
        );
        ?>
    </nav>
    <?php
    return ob_get_clean();
}

function get_categories_list()
{
    $args = array(
        'taxonomy' => "product_cat",
    );
    $categories = get_terms($args);
    ob_start();
    ?>
    <div class="row">
        <?php foreach ($categories as $category):
            if ($category->parent === 0) :
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $image = wp_get_attachment_url($thumbnail_id); ?>
                <div class="col-lg-4 col-12">
                    <div class="card-parts">
                        <div class="card-parts__body">
                            <div>
                                <p class="card-parts__category"><?= $category->name ?></p>
                                <p class="card-parts__title"><?= $category->description ?></p>
                                <a class="card-parts__link"
                                   href="<?= get_term_link($category->term_id, 'product_cat') ?>">Перейти в каталог</a>
                            </div>
                            <img src="<?= $image ?>" alt="<?= $category->name ?>">
                        </div>
                    </div>
                </div>
            <?php
            endif;
        endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}

function woocommerce_content()
{
    if (is_singular('product')) {

        while (have_posts()) :
            the_post();
            wc_get_template_part('content', 'single-product');
        endwhile;

    } else {
        ?>

        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>

            <p class="catalog-title">Умная фильтрация</p>
            <p class="catalog-info">Выберите технику и группу</p>

        <?php endif; ?>

        <?php if (woocommerce_product_loop()) : ?>

            <?php do_action('woocommerce_before_shop_loop'); ?>

            <?php woocommerce_product_loop_start(); ?>

            <?php if (wc_get_loop_prop('total')) : ?>
                <?php the_post(); ?>
                <?php wc_get_template_part('content', 'product_cat'); ?>
            <?php endif; ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php do_action('woocommerce_after_shop_loop'); ?>

        <?php
        else :
            do_action('woocommerce_no_products_found');
        endif;
    }
}

/**
 * Change the breadcrumb
 */
add_filter('woocommerce_breadcrumb_defaults', 'new_woocommerce_breadcrumbs', 20);
function new_woocommerce_breadcrumbs()
{
    if (is_page(16) || is_checkout()) {
        return array(
            'delimiter' => ' - ',
            'wrap_before' => '<div class="new-storefront-breadcrumb d-none"><div class="container"><div class="row"><div class="col-12"><nav class="woocommerce-breadcrumb">',
            'wrap_after' => '</nav></div></div></div></div>',
            'home' => _x('Home', 'breadcrumb', 'woocommerce'),
        );
    }

    return array(
        'delimiter' => ' - ',
        'wrap_before' => '<div class="new-storefront-breadcrumb"><div class="container"><div class="row"><div class="col-12"><nav class="woocommerce-breadcrumb">',
        'wrap_after' => '</nav></div></div></div></div>',
        'home' => _x('Home', 'breadcrumb', 'woocommerce'),
    );
}

add_action('woocs_force_pay_bygeoip_rules', function ($country, $user_currency, $current_currency) {
    global $WOOCS;
    if (!empty($user_currency)) {
        $WOOCS->set_currency($user_currency);
    }
}, 9999, 3);

function disable_shipping_calc_on_cart($show_shipping)
{
    if (is_cart()) {
        return false;
    }
    return $show_shipping;
}

add_filter('woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99);

add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
/**
 * Remove field from checkout
 * @param $fields
 * @return mixed
 */
function custom_override_checkout_fields($fields)
{
    unset($fields['billing']['billing_company'],
        $fields['billing']['billing_address_2'],
        $fields['billing']['billing_city'],
        $fields['billing']['billing_state'],
        $fields['order']['order_comments'],
        $fields['account']['account_username'],
        $fields['account']['account_password'],
        $fields['account']['account_password-2']);
    return $fields;
}

add_action('woocommerce_before_order_notes', 'add_custom_checkout_field');

add_filter('woocommerce_checkout_fields', 'override_billing_checkout_fields', 20, 1);
/**
 * Override fields from checkout
 * @param $fields
 * @return mixed
 */
function override_billing_checkout_fields($fields)
{
    $fields['billing']['billing_phone']['placeholder'] = 'Номер телефона';
    $fields['billing']['billing_email']['placeholder'] = 'Email';
    $fields['billing']['billing_postcode']['placeholder'] = 'Индекс';
    $fields['billing']['billing_last_name']['placeholder'] = 'Фамилия';
    $fields['billing']['billing_last_name']['priority'] = 10;
    $fields['billing']['billing_last_name']['class'][0] = 'form-row-first';
    $fields['billing']['billing_first_name']['placeholder'] = 'Имя';
    $fields['billing']['billing_first_name']['priority'] = 20;
    $fields['billing']['billing_first_name']['class'][0] = 'form-row-last';
    $fields['billing']['billing_address_1']['placeholder'] = 'Город, улица, номер дома и квартиры';
    return $fields;
}

add_filter('woocommerce_billing_fields', 'custom_woocommerce_billing_fields');

/**
 * Add new field to checkout
 * @param $fields
 * @return mixed
 */
function custom_woocommerce_billing_fields($fields)
{

    $fields['billing_patronymic'] = array(
        'type' => 'text',
        'class' => array('form-row-wide'),
        'label' => 'Отчество',
        'placeholder' => 'Отчество',
        'required' => true,
        'default' => '',
        'priority' => '25',
    );

    return $fields;
}

/**
 * Add new fields to checkout
 * @param $checkout
 */
function add_custom_checkout_field($checkout)
{
    woocommerce_form_field('passport-series', array(
        'type' => 'text',
        'class' => array('form-row form-row-first'),
        'label' => 'Серия паспорта',
        'placeholder' => 'Серия паспорта',
        'required' => false,
        'default' => '',
    ), $checkout->get_value('passport-series'));
    woocommerce_form_field('passport-number', array(
        'type' => 'text',
        'class' => array('form-row form-row-last'),
        'label' => 'Номер паспорта',
        'placeholder' => 'Номер паспорта',
        'required' => false,
        'default' => '',
    ), $checkout->get_value('passport-number'));
    woocommerce_form_field('passport-date', array(
        'type' => 'text',
        'class' => array('form-row-wide'),
        'label' => 'Когда выдан',
        'placeholder' => 'Дата выдачи',
        'required' => false,
        'default' => '',
    ), $checkout->get_value('passport-date'));
    woocommerce_form_field('passport-place', array(
        'type' => 'text',
        'class' => array('form-row-wide'),
        'label' => 'Кем выдан',
        'placeholder' => 'Кем выдан',
        'required' => false,
        'default' => '',
    ), $checkout->get_value('passport-place'));
}

add_action('woocommerce_checkout_process', 'bbloomer_validate_new_checkout_field');
/**
 * Validate new checkout fields
 */
function validate_new_checkout_field()
{
    if (!$_POST['passport-series']) {
        wc_add_notice('Пожалуйста введите серию паспорта', 'error');
    }
    if (!$_POST['billing_patronymic']) {
        wc_add_notice('Пожалуйста введите отчество', 'error');
    }
    if (!$_POST['passport-number']) {
        wc_add_notice('Пожалуйста введите номер паспорта', 'error');
    }
    if (!$_POST['passport-date']) {
        wc_add_notice('Пожалуйста введите дату выдачи паспорта', 'error');
    }
    if (!$_POST['passport-place']) {
        wc_add_notice('Пожалуйста введите место выдачи паспорта', 'error');
    }
}

add_action('woocommerce_checkout_update_order_meta', 'save_new_checkout_field');
/**
 * Save new checkouts fields
 * @param $order_id
 */
function save_new_checkout_field($order_id)
{
    if ($_POST['passport-series']) {
        update_post_meta($order_id, '_passport-series', esc_attr($_POST['passport-series']));
    }
    if ($_POST['billing_patronymic']) {
        update_post_meta($order_id, '_billing_patronymic', esc_attr($_POST['billing_patronymic']));
    }
    if ($_POST['passport-number']) {
        update_post_meta($order_id, '_passport-number', esc_attr($_POST['passport-number']));
    }
    if ($_POST['passport-date']) {
        update_post_meta($order_id, '_passport-date', esc_attr($_POST['passport-date']));
    }
    if ($_POST['passport-place']) {
        update_post_meta($order_id, '_passport-place', esc_attr($_POST['passport-place']));
    }
}

add_action('woocommerce_admin_order_data_after_billing_address', 'show_new_checkout_field_order', 10, 1);
/**
 * Show new checkout fields on order page
 * @param $order
 */
function show_new_checkout_field_order($order)
{
    $order_id = $order->get_id();
    if (get_post_meta($order_id, '_billing_patronymic', true)) {
        echo '<p><strong>Отчество:</strong> ' . get_post_meta($order_id, '_billing_patronymic', true) . '</p>';
    }
    if (get_post_meta($order_id, '_passport-series', true)) {
        echo '<p><strong>Серия паспорта:</strong> ' . get_post_meta($order_id, '_passport-series', true) . '</p>';
    }
    if (get_post_meta($order_id, '_passport-number', true)) {
        echo '<p><strong>Номер паспорта:</strong> ' . get_post_meta($order_id, '_passport-number', true) . '</p>';
    }
    if (get_post_meta($order_id, '_passport-date', true)) {
        echo '<p><strong>Дата выдачи паспорта:</strong> ' . get_post_meta($order_id, '_passport-date', true) . '</p>';
    }
    if (get_post_meta($order_id, '_passport-place', true)) {
        echo '<p><strong>Кем выдан паспорт:</strong> ' . get_post_meta($order_id, '_passport-place', true) . '</p>';
    }
}

add_action('woocommerce_email_after_order_table', 'show_new_checkout_field_emails', 20, 4);
/**
 * Show new checkout fields in email
 * @param $order
 * @param $sent_to_admin
 * @param $plain_text
 * @param $email
 */
function show_new_checkout_field_emails($order, $sent_to_admin, $plain_text, $email)
{
    $order_id = $order->get_id();
    if (get_post_meta($order_id, '_billing_patronymic', true)) {
        echo '<p><strong>Отчество:</strong> ' . get_post_meta($order_id, '_billing_patronymic', true) . '</p>';
    }
    if (get_post_meta($order_id, '_passport-series', true)) {
        echo '<p><strong>Серия паспорта:</strong> ' . get_post_meta($order_id, '_passport-series', true) . '</p>';
    }
    if (get_post_meta($order_id, '_passport-number', true)) {
        echo '<p><strong>Номер паспорта:</strong> ' . get_post_meta($order_id, '_passport-number', true) . '</p>';
    }
    if (get_post_meta($order_id, '_passport-date', true)) {
        echo '<p><strong>Дата выдачи паспорта:</strong> ' . get_post_meta($order_id, '_passport-date', true) . '</p>';
    }
    if (get_post_meta($order_id, '_passport-place', true)) {
        echo '<p><strong>Кем выдан паспорт:</strong> ' . get_post_meta($order_id, '_passport-place', true) . '</p>';
    }
}

add_filter('woocommerce_get_stock_html', '__return_empty_string');

// Удаление инлайн-скриптов из хедера
add_filter('storefront_customizer_css', '__return_false');
add_filter('storefront_customizer_woocommerce_css', '__return_false');
add_filter('storefront_gutenberg_block_editor_customizer_css', '__return_false');

add_action('wp_print_styles', function () {
    wp_styles()->add_data('woocommerce-inline', 'after', '');
});

add_action('init', function () {
    remove_action('wp_head', 'wc_gallery_noscript');
});
add_action('init', function () {
    remove_action('wp_head', 'wc_gallery_noscript');
});
// Конец удаления инлайн-скриптов из хедера

add_filter('woocommerce_account_menu_items', 'custom_remove_downloads_my_account', 999);

function custom_remove_downloads_my_account($items)
{
    unset($items['downloads']);
    return $items;
}
