<?php
/**
 * @package Viral News
 */
get_header();
?>

<div class="vn-container">
    <header class="vn-main-header">
        <?php
        $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
        
        ?>
    <?php echo get_avatar($curauth->id);?>
    <h1><strong></strong><?php echo get_the_author_meta($field = 'display_name')?></strong></h1>
    <h4><?php 
    $bio = get_the_author_meta($field = 'description');
    if(strpos($bio, "font")){
        $start = strpos($bio, '<span') + 28;
        $font = str_replace (" ", "+", substr($bio, $start + 1, strpos($bio, ';', $start) - $start - 2 ));
        echo "<link href='https://fonts.googleapis.com/css2?family=".$font."&display=swap' rel='stylesheet'>";
    }
    

    echo $bio; ?></h4>
    </header><!-- .vn-main-header -->
    <hr>
    <div class="vn-content-wrap vn-clearfix" >
        <div id="primary" class="author author-content content-area">			
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

        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();


