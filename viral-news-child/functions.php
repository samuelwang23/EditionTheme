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
                            <h3 class="vn-post-title <?php echo esc_attr($title_class) ?>"><a href="<?php the_permalink(); ?>" class = "sw-title" style = "font-family: 'Oswald';text-transform: Uppercase;  <?php 
                            if($index != 1){
                                echo "font-size: 20px"; 
                            }
                            ?>"><?php the_title(); ?></a></h3>
                            <span class = 'sw-author'>
                            <?php 
                                ob_start();
                                coauthors();
                                $coauthors = ob_get_contents();                                    
                                ob_end_clean();
                                $author = sprintf(esc_html_x('By %s', 'post author', 'viral-news'), esc_html($coauthors)); 
                                echo $author. "<br> ";
                                echo viral_news_post_date_no_div();		
							?>
							</span>
							
							
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
                            <h3><a href="<?php the_permalink(); ?>" class = "sw-title"  style = "font-family: 'Oswald';text-transform: Uppercase; font-size: 20px;"><?php the_title(); ?></a></h3>
                            
                            
                           
                            
                            
                            <span class = "sw-author">
                            <?php 
                                    ob_start();
                                    coauthors();
                                    $coauthors = ob_get_contents();                                    
                                    ob_end_clean();
                                    $author = sprintf(esc_html_x('By %s', 'post author', 'viral-news'), esc_html($coauthors)); 
                                    echo $author. "<br> ";
								    echo viral_news_post_date_no_div();		
								  
							?>
							</span>
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

if (!function_exists('viral_news_site_logo')) {

    function viral_news_site_logo() {
        ?>
        <div id="vn-site-branding">
            <?php
            if (function_exists('has_custom_logo') && has_custom_logo()) :
                the_custom_logo();
            else :
                if (is_front_page()) :
                    ?>
                    <!--<h1 class="vn-site-title"><a href="<?php //echo esc_url(home_url('/')); ?>" rel="home"><?php //bloginfo('name'); ?></a></h1>-->
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img src = "https://edition.samuelwang.tech/wp-content/uploads/2020/09/EditionHeader-1.png" style = "max-height:75px;"></img></a>
                <?php else : ?>
                    <!--<p class="vn-site-title"><a href="<?php //echo esc_url(home_url('/')); ?>" rel="home"><?php //bloginfo('name'); ?></a> </p>-->
                    <p class="vn-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">  <img src = "https://edition.samuelwang.tech/wp-content/uploads/2020/09/EditionHeader-1.png" style = "max-height:75px;"></img></a> </p>
                <?php endif; ?>
                <!--<p class="vn-site-description"><a href="<?php// echo esc_url(home_url('/')); ?>" rel="home"><?php //bloginfo('description'); ?></a>Hello</p>-->
                <?php endif; ?>
        </div><!-- .site-branding -->
        <?php
    }

}

if (!function_exists('viral_news_social_links')) {

    function viral_news_social_links() {
        echo '<div class="vn-header-social-icons">';
        $facebook = get_theme_mod('viral_news_social_facebook', '#');
        $twitter = get_theme_mod('viral_news_social_twitter', '#');
        $youtube = get_theme_mod('viral_news_social_youtube', '#');
        $instagram = get_theme_mod('viral_news_social_instagram', '#');

        if ($facebook)
            echo '<a class="vn-facebook" href="' . esc_url($facebook) . '" target="_blank"><i class="mdi mdi-facebook"></i></a>';

        if ($twitter)
            echo '<a class="vn-twitter" href="' . esc_url($twitter) . '" target="_blank"><i class="mdi mdi-twitter"></i></a>';

        if ($youtube)
            echo '<a class="vn-youtube" href="' . esc_url($youtube) . '" target="_blank"><i class="mdi mdi-youtube" style = "color: #e04a4aff;"></i></a>';

        if ($instagram)
            echo '<a class="vn-instagram" href="' . esc_url($instagram) . '" target="_blank"><i class="mdi mdi-instagram" style = "color: #e04a4aff;"></i></a>';
        echo '<a class="vn-email" href="mailto:theeditionga@gmail.com"><i class="mdi mdi-email" style = "color: #e04a4aff;"></i></a>';
        echo '</div>';
        //echo "<i class='material-icons large red-text'>room</i>";
    }

}

function viral_news_custom_scripts(){
    echo "<link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap' rel='stylesheet'>";
    echo "<link href='https://fonts.googleapis.com/css2?family=Cormorant+Garamond&display=swap' rel='stylesheet'>";
    echo "<link href='https://fonts.googleapis.com/css2?family=Oswald&display=swap' rel='stylesheet'>";
}

add_action('wp_enqueue_scripts', 'viral_news_custom_scripts');

if (!function_exists('viral_news_search_icon')) {

    function viral_news_search_icon() {
        echo '<div class="vn-header-search">';
        echo '<a href="#"><i class="mdi mdi-magnify" style="color: #e04a4aff;"></i></a>';
        echo '</div>';
    }

}

function wptp_add_tags_to_attachments() {
    register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'wptp_add_tags_to_attachments' );


function viral_news_posted_on() {

    $posted_on = sprintf('<span class="vn-day">%1$s</span><span class="vn-month">%2$s</span>', esc_html(get_the_date('j')), esc_attr(get_the_date('M')));

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
    echo '<span class="entry-date">' . $posted_on . '</span>';
    $coauthors = get_coauthors();
    foreach($coauthors as $coauthor){
        $userdata = get_userdata( $coauthor->ID );
        $avatar = get_avatar($coauthor->ID, 48);
        $author = get_author_posts_url($coauthor->ID);
        $name = $coauthor->display_name;
        echo '<span class="entry-author"> ' . $avatar . '<span class="author"> <a href="' . $author . '">'. $name . '</a></span></span>';
    }
     
    echo '<span class="entry-comment">' . $comments . '</span>'; // WPCS: XSS OK.
}

