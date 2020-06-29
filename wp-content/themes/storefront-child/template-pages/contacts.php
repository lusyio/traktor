<?php
/*
Template Name: contacts
Template Post Type: post, page, product
*/
?>

<?php get_header(); ?>

</div>
</div>

<div class="contacts">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 contacts-left">
                <h2 class="contacts__title">Контакты</h2>
                <p class="contacts__info"><?= get_the_content(); ?></p>
                <div class="contacts__list">
                    <div>
                        <img src="/wp-content/themes/storefront-child/svg/navigation.svg" alt="navigation">
                    </div>
                    <p>
                        <?= get_field('contacts_address') ?>
                    </p>
                </div>
                <div class="contacts__list">
                    <div>
                        <img src="/wp-content/themes/storefront-child/svg/svg-worktime.svg" alt="worktime">
                    </div>
                    <p>
                        <?= get_field('contacts_worktime') ?>
                    </p>
                </div>
                <div class="contacts__list">
                    <div>
                        <img src="/wp-content/themes/storefront-child/svg/svg-phone.svg" alt="phone">
                    </div>
                    <p>
                        <a href="tel:<?= get_field('contacts_phone_1') ?>"><?= get_field('contacts_phone_1') ?></a>
                    </p>
                </div>
                <div class="contacts__list">
                    <div>
                        <img src="/wp-content/themes/storefront-child/svg/whatsapp.svg" alt="whatsapp">
                    </div>
                    <p>
                        <a href="tel:<?= get_field('contacts_phone_2') ?>"><?= get_field('contacts_phone_2') ?></a>
                    </p>
                </div>
                <div class="contacts__list">
                    <div>
                        <img src="/wp-content/themes/storefront-child/svg/skype.svg" alt="skype">
                    </div>
                    <p>
                        <a href="skype:<?= get_field('contacts_skype') ?>?chat"><?= get_field('contacts_skype') ?></a>
                    </p>
                </div>
                <div class="contacts__list mb-4">
                    <div>
                        <img src="/wp-content/themes/storefront-child/svg/svg-mail.svg" alt="mail">
                    </div>
                    <p>
                        <a href="mailto:<?= get_field('contacts_email') ?>"><?= get_field('contacts_email') ?></a>
                    </p>
                </div>
                <img src="/wp-content/themes/storefront-child/images/contacts-img.jpg" alt="">
            </div>
            <div class="col-lg-6 col-12 contacts__map-container">
                <div class="contacts__map">
                    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Ab9df117262edcc67e437fcf1b593f53ba949443240e71b285bb6771510e6d697&amp;source=constructor"
                            width="100%" height="100%" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
