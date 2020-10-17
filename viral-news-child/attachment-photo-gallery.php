<?php
/**
 * @package Viral News
 */
get_header();
?>
<div class="vn-container">
    <header class="vn-main-header">
        <p>Tag: <?php single_tag_title(); ?></p>
    </header><!-- .vn-main-header -->

    <div class="vn-content-wrap vn-clearfix">
        <div id="primary" class="content-area" style = "width:100%;">	
				Tag Gallery for Photoes

        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();
