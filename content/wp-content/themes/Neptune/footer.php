<?php
/**
 * @package WordPress
 * @subpackage Neptune Theme
 */
$options = get_option( 'neptune_theme_settings' );
?>
<div class="clear"></div>

	<div id="footer" class="clearfix">
        
            <div id="copyright" class="one-half">
                &copy; <?php echo date('Y'); ?> // <a href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ) ?></a>
            </div>
            
            <div id="backtop" class="one-half column-last">
            	<!-- design by <a href="http://www.wpexplorer.com" title="WPExplorer" target="_blank" rel="nofollow">WPExplorer</a> -->
            </div>
    
    </div>

</div>
<!-- END wrap --> 

<!-- WP Footer -->
<?php wp_footer(); ?>
</body>
</html>