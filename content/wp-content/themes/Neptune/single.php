<?php
/**
 * @package WordPress
 * @subpackage Neptune Theme
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<div id="page-heading">
	<h1><?php _e('Blog','neptune'); ?></h1>		
</div>

<div class="post clearfix">

	<h1 class="single-title"><?php the_title(); ?></h1>
    
    <div class="post-meta">
        <span class="meta-date"><?php the_time('j'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?></span>
        //<span class="meta-category"><?php the_category(' '); ?></span>
        //<span class="meta-author"><?php the_author_posts_link(); ?></span>
    </div>
    <!-- END post-meta --> 


    <div class="entry clearfix">
        <?php if ( has_post_thumbnail() ) { ?>
        		<div class="post-thumbnail drop-shadow curved curved-hz-1">
        			<?php the_post_thumbnail('post-image'); ?>
                </div>
                <!-- END post-thumbnail -->
        <?php } ?>
        
		<?php the_content(); ?>
        <div class="clear"></div>
        
        <?php wp_link_pages(' '); ?>
         
        <div class="post-bottom">
        	<?php the_tags('<div class="post-tags">',' , ','</div>'); ?>
        </div>
        <!-- END post-bottom -->
        
        
        </div>
        <!-- END entry -->
	
	<?php comments_template(); ?>
   
        
</div>
<!-- END post -->

<?php endwhile; ?>
<?php endif; ?>
             
<?php get_sidebar(); ?>
<?php get_footer(); ?>