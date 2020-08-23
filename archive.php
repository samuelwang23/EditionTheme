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
			<?php ob_start();
			the_archive_title();
			$category_name = ob_get_contents(); // Store buffer in variable
			ob_end_clean();
			
			if($category_name == 'Columns'): 
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
				
			<?php else:?>
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
			<?php endif?>
            

        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();
