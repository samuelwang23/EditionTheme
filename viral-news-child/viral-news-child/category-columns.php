<?php
/**
 * @package Viral News
 */
get_header();
?>

<div class="vn-container">
    <header class="vn-main-header">
        <?php
        the_archive_title('<h1>', '</h1>');
        the_archive_description('<div class="taxonomy-description">', '</div>');
        ?>
    </header><!-- .vn-main-header -->

    <div class="vn-content-wrap vn-clearfix">
        <div id="primary" class="content-area" style = "width:100%;">
            <?php
                    foreach(get_categories( array( 'parent' => get_cat_ID($category_name) )) as $subcategory){
					$carousel_args = [
						'title' => $subcategory->cat_name,
						'cat' => $subcategory->cat_ID,
						'slide_no' => 4,
						'post_no' => 100
					];
					viral_news_carousel_section($carousel_args);
				}

                    ?>
        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();