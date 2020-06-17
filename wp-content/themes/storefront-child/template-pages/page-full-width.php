<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: page-full-width
 *
 * @package storefront
 */

get_header(); ?>

    <div id="primary" class="content-area col-sm-12">
        <main id="main" class="site-main" role="main">
            <header class="entry-header">
                <h1 class="entry-title"><?= the_title(); ?></h1>
            </header>
            <?php the_content(); ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
