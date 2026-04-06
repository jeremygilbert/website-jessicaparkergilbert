<?php
/**
 * @package WordPress
 * @subpackage Neptune Theme
 */
$options = get_option( 'neptune_theme_settings' );
?>
<?php get_header(' '); ?>

<div class="home-wrap clearfix">

<!-- Recent Portfolio Items -->
<?php
//get post type ==> portfolio
query_posts(array(
	'post_type'=>'portfolio',
	'posts_per_page' => 16,
	'paged'=>$paged
));
?>

<div id="home" class="clearfix">

	<?php 
		//get portfolio categories
		$cats = get_terms('portfolio_cats');
		//show filter if categories exist
		if($cats[1] !='') { ?>
        
        <!-- Portfolio Filter -->
        <ul id="portfolio-cats" class="filter clearfix">
        	<li class="sort"><?php _e('Sort Items','neptune'); ?>:</li>
            <li><a href="#all" rel="all" class="active"><span><?php _e('All', 'neptune'); ?></span></a></li>
            <?php
            foreach ($cats as $cat ) : ?>
            <li>//<a href="#<?php echo $cat->slug; ?>" rel="<?php echo $cat->slug; ?>"><span><?php echo $cat->name; ?></span></a></li>
            <?php endforeach; ?>
        </ul>
        
	<?php } ?>
    
    
<div id="portfolio-wrap" class="clearfix">
    	<ul class="portfolio-content">
			<?php
            //get post type ==> portfolio
            query_posts(array(
                'post_type'=>'portfolio',
                'posts_per_page' => 16,
                'paged'=>$paged
            ));
            ?>
        
            <?php
			$count=0;
            while (have_posts()) : the_post();
			$count++;
            //get portfolio thumbnail
            $thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-thumb');
            //get terms
            $terms = get_the_terms( get_the_ID(), 'portfolio_cats' );
			$terms_list = get_the_term_list( get_the_ID(), 'portfolio_cats' );
            ?>
            
            <?php if ( has_post_thumbnail() ) {  ?>
            <li data-id="id-<?php echo $count; ?>" data-type="<?php if($terms) { foreach ($terms as $term) { echo $term->slug .' '; } } else { echo 'none'; } ?>" class="portfolio-item">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbail[0]; ?>" height="<?php echo $thumbail[2]; ?>" width="<?php echo $thumbail[1]; ?>" alt="<?php echo the_title(); ?>" />
            <span class="portfolio-item-overlay"><h3><?php echo the_title(); ?></h3></span>
            </a>
            </li>
            <?php } ?>
            
            <?php endwhile; ?>
		</ul>
    </div>

</div>
<!-- END #home -->      	

<?php pagination(); wp_reset_query(); ?>


</div>
<!-- END home-wrap -->   
<?php get_footer(' '); ?>