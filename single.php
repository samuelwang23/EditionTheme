<?php
/**
 * @package Viral News
 */
get_header();
?>

<div class="vn-container">
    <?php
    while (have_posts()) : the_post();

        $viral_news_hide_title = get_post_meta($post->ID, 'viral_news_hide_title', true);
	
		//Hide the Featured Image for Columns Pages
		foreach(get_the_category() as $category){
			if(explode("/", get_category_parents($category->cat_ID))[0] == "Columns"){
				$image = false;
			}
			else{
				$image = true;
			}
		}
		
        if (!$viral_news_hide_title) {
            ?>
            <header class="vn-main-header">
                <?php the_title('<h1>', '</h1>'); ?>
				<?php if (has_post_thumbnail() and $image): ?>
				<figure class="entry-figure">
					<?php
						$viral_news_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-840x440');
					
					?>
					<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($viral_news_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>"></a>
				</figure>
				<?php endif; ?>
                <?php //viral_news_post_date(); ?>
				<?php 
					$avatar = get_avatar(get_the_author_meta('ID'), 48);
			
					$author = sprintf(esc_html_x('By %s', 'post author', 'viral-news'), esc_html(get_the_author()));

					$comment_count = get_comments_number(); // get_comments_number returns only a numeric value

					if ($comment_count == 0) {
						$comments = esc_html__('No Comments', 'viral-news');
					} elseif ($comment_count > 1) {
						$comments = $comment_count . ' ' . esc_html__('Comments', 'viral-news');
					} else {
						$comments = esc_html__('1 Comment', 'viral-news');
					}
					$reading_speed = 300;
					$posted_on = viral_news_post_date_raw();
					ob_start(); // Start output buffering
					get_template_part('template-parts/content', 'single');
					$time_to_read = max(1, floor(str_word_count(ob_get_contents())/$reading_speed)); // Store buffer in variable
					ob_end_clean();
					ob_start();
					the_author_posts_link();
					$author = ob_get_contents();
					ob_end_clean();
										echo  '<br><div><span class="entry-author"> ' . $avatar . '<span class="author"> ' . $author . '</span> -'. '<span>'.$posted_on. '</span></span> <em> '.$time_to_read.' minute read </em></div>'.'<span class="entry-comment"> '. $comments . '</span>'; // WPCS: XSS OK.
				
				?>
				
            </header><!-- .entry-header -->
        <?php } ?>

        <div class="vn-content-wrap vn-clearfix">
            <div id="primary" class="content-area" style = "width: 100%;">
                <?php get_template_part('template-parts/content', 'single'); ?>

                <nav class="navigation post-navigation" role="navigation">
                    <div class="nav-links">
                        <div class="nav-previous">
                            <?php previous_post_link('%link', '<span><i class="mdi mdi-chevron-left"></i>' . esc_html__('Prev', 'viral-news') . '</span>%title'); ?> 
                        </div>

                        <div class="nav-next">
                            <?php next_post_link('%link', '<span>' . esc_html__('Next', 'viral-news') . '<i class="mdi mdi-chevron-right"></i></span>%title'); ?>
                        </div>
                    </div>
                </nav>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            </div><!-- #primary -->

            <?php get_sidebar(); ?>
        </div>
    <?php endwhile; // End of the loop. ?>
</div>
<?php
get_footer();
