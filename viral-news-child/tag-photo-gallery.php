<?php
/**
 * @package Viral News
 */
get_header();
?>
<div class="vn-container">
    <header class="vn-main-header">
        <h1><strong>E-Dition Photo Gallery</strong></h1>
    </header><!-- .vn-main-header -->

    <div class="vn-content-wrap vn-clearfix">
        <div id="primary" class="content-area" style = "width:100%;">	
			<?php 
			$query_images_args = array(
                'post_type' => 'attachment',
                'post_mime_type' =>'image',
                'post_status' => 'inherit',
                'posts_per_page' => -1,
            );
            
            $query_images = new WP_Query( $query_images_args );
            $images = array();
            foreach ( $query_images->posts as $image) {
                foreach(get_the_tags($image->ID) as $tag){
                    if($tag->name == "Photo Gallery"){
                        $images[]= [
                            "src" => wp_get_attachment_url( $image->ID ),
                            "caption" => $image->post_excerpt,
                            "description" => $image->post_content
                        ];
                    }
                }
            }
            foreach($images as $image){
                echo "<img src = '".$image["src"]."' style = 'margin: auto;
    display: block;'/>";
                echo "<div style = 'text-align: center;'>";
                echo "<h1>".$image["caption"]."</h1>";
                echo "<h3>".$image["description"]."</h3>";
                echo "</div>";
            }
			?>

        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();
