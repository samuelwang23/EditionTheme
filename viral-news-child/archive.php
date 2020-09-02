  
<?php
/**
 * @package Viral News
 */
get_header();
?>

<div class="vn-container" style = "width:100%;">
    <header class="vn-main-header">
        <?php
        the_archive_title('<h1>', '</h1>');
        the_archive_description('<div class="taxonomy-description">', '</div>');
        ?>
    </header><!-- .vn-main-header -->

    <div class="vn-content-wrap vn-clearfix" >
        <div id="primary" class="content-area sw-content">
            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>

                    <?php
                    get_template_part('template-parts/content');
                    ?>

                <?php endwhile; ?>

                <?php the_posts_pagination(); ?>

            <?php else : ?>

                <?php get_template_part('template-parts/content', 'none'); ?>

            <?php endif; ?>
    </div><!-- #primary -->
<?php
get_footer();