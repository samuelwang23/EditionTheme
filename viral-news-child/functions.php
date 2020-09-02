<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

if (!function_exists('viral_news_top_section_style2')) {
	
    function viral_news_top_section_style2($args) {
		$page = $_SERVER['PHP_SELF'];
		$sec = "10";
		
        $title = $args['title'];
        $layout = $args['layout'];
        $cat = $args['cat'];
        if ($layout != 'style2')
            return;
        ?>
		
        <div class="vn-top-block <?php echo esc_attr($layout); ?>">
            <?php if ($title) { ?>
                <h2 class="vn-block-title"><span><?php echo esc_html($title); ?></span></h2>
            <?php } ?>
            <div class="vn-top-block-wrap">
				
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => 5,
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()): $query->the_post();
                    $index = $query->current_post + 1;
                    $last = $query->post_count;
                    $title_class = $index == 1 ? 'vn-large-title' : '';

                    if ($index == 1) {
                        echo '<div class="col1">';
                    } elseif ($index == 2) {
                        echo '<div class="col2">';
                    } elseif ($index == 4) {
                        echo '<div class="col3">';
                    }
                    ?>
                    <div class="vn-post-item">
                        <div class="vn-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vn-thumb-container">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-600x600');
                                        ?>
                                        <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
                                    <?php }
                                    ?>
                                </div>
                            </a>
                            <?php
                            if ($index == 1) {
                                echo get_the_category_list();
                            } else {
                                viral_news_post_primary_category();
                            }
                            ?>
                        </div>
                        <div class="vn-post-content">
                            <h3 class="vn-post-title <?php echo esc_attr($title_class) ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php $author = sprintf(esc_html_x('By %s', 'post author', 'viral-news'), esc_html(get_the_author())); 
								  echo $author. " ";
								  echo viral_news_post_date_no_div();								  
							?>
							 				
							
                            <?php if ($index == 1) { ?>
                                <div class="vn-excerpt">
                                    <?php echo viral_news_excerpt(get_the_content(), 200); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                    if ($index == 1 || $index == 3 || $index == $last) {
                        echo '</div>';
                    }
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}
if (!function_exists('viral_news_carousel_section')) {

    function viral_news_carousel_section($args) {
        $title = $args['title'];
        $slide_no = $args['slide_no'];
        $post_no = $args['post_no'];
        $cat = $args['cat'];
        ?>
        <div class="vn-carousel-block" data-count="<?php echo esc_attr($slide_no); ?>">
            <?php if ($title) { ?>
                <h2 class="vn-block-title"><a class="sw-link" href = "<?php echo get_category_link($cat);?>"><span><strong><?php echo esc_html($title); ?></span></strong></a></h2>
            <?php } ?>

            <div class="vn-carousel-block-wrap owl-carousel">
                <?php
                $args = array(
                    'cat' => $cat,
                    'posts_per_page' => absint($post_no),
                    'ignore_sticky_posts' => true
                );

                $query = new WP_Query($args);
                while ($query->have_posts()): $query->the_post();
                    ?>
                    <div class="vn-post-item">
                        <div class="vn-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <div class="vn-thumb-container">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-600x600');
                                        ?>
                                        <img alt="<?php echo the_title_attribute() ?>" src="<?php echo esc_url($image[0]) ?>">
									
                                    <?php }
                                    ?>
                                </div>
                            </a>
                        </div>
                        <div class="vn-post-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            
                            
                           
                            
                            
                            
							<?php $author = sprintf(esc_html_x('By %s', 'post author', 'viral-news'), esc_html(get_the_author())); 
								  echo $author. "<br> ";
								  echo viral_news_post_date_no_div();								  
							?>
                            <?php //echo viral_news_post_date(); ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

}
if (!function_exists('viral_news_post_date_no_div')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function viral_news_post_date_no_div() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $posted_on = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date())
        );

        echo '<i class="mdi mdi-clock-time-three-outline"></i>' . $posted_on; // WPCS: XSS OK.
    }

endif;

if (!function_exists('viral_news_post_date_raw')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function viral_news_post_date_raw() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $posted_on = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date())
        );

        //echo '' . $posted_on . ''; // WPCS: XSS OK.
        return ' <i class="mdi mdi-clock-time-three-outline"></i>'.$posted_on;
    }

endif;