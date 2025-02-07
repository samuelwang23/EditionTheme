<?php
/**
 * @package Viral News
 */
?>

</div><!-- #content -->

<footer id="vn-colophon" class="site-footer" style = "background-color: #2d2c2c;">
    <?php if (is_active_sidebar('viral-news-footer1') || is_active_sidebar('viral-news-footer2') || is_active_sidebar('viral-news-footer3') || is_active_sidebar('viral-news-footer4')) { ?>
        <div class="vn-top-footer">
            <div class="vn-container">
                <div class="vn-top-footer-inner vn-clearfix">
                    <!-- Temporary change for now-->
                    <?php dynamic_sidebar('viral-news-footer1');?>
                    <div class="vn-header-social-icons"><?php
                    echo '<a class="vn-instagram" href="' . esc_url($instagram) . '" target="_blank"><i class="mdi mdi-instagram" style = "color: #e04a4aff;"></i></a>';
                     echo '<a class="vn-youtube" href="' . esc_url($youtube) . '" target="_blank"><i class="mdi mdi-youtube" style = "color: #e04a4aff;"></i></a>';
                     echo '<a class="vn-email" href="mailto:theeditionga@gmail.com"><i class="mdi mdi-email" style = "color: #e04a4aff;"></i></a>';                    
                    ?></div>
                    
                    <!--<div class="vn-footer-1 vn-footer-block">-->
                    <!--    <?php //dynamic_sidebar('viral-news-footer1') ?>-->
                    <!--</div>-->

                    <!--<div class="vn-footer-2 vn-footer-block">-->
                    <!--    <?php //dynamic_sidebar('viral-news-footer2') ?>-->
                    <!--</div>-->

                    <!--<div class="vn-footer-3 vn-footer-block">-->
                    <!--    <?php //dynamic_sidebar('viral-news-footer3') ?>-->
                    <!--</div>-->

                    <!--<div class="vn-footer-4 vn-footer-block">-->
                    <!--    <?php //dynamic_sidebar('viral-news-footer4') ?>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="vn-bottom-footer">
        <div class="vn-container">
            <div class="vn-site-info">
                <?php printf('%4$s <span class="sep"> | </span><a title="%3$s" href="%1$s" target="_blank">Viral News</a> %2$s', 'https://hashthemes.com/wordpress-theme/viral-news/', esc_html__('by HashThemes', 'viral-news'), esc_attr__('Download Viral News', 'viral-news'), esc_html__('WordPress Theme', 'viral-news')); ?>
            </div>
        </div>
    </div>
</footer>
</div>

<div id="vn-back-top" class="vn-hide"><i class="mdi mdi-chevron-up"></i></div>

<?php wp_footer(); ?>

</body>
</html>