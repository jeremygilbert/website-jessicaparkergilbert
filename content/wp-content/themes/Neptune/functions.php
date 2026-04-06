<?php
/**
 * @package WordPress
 * @subpackage Neptune Theme
*/


// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) 
    $content_width = 620;



/*-----------------------------------------------------------------------------------*/
/*	Include functions
/*-----------------------------------------------------------------------------------*/
require('admin/theme-admin.php');
require('functions/pagination.php');
require('functions/better-excerpts.php');
require('functions/shortcodes.php');
require('functions/flickr-widget.php');

/* Activate if you want to add meta boxes - see functions/meta/meta-usage.php for adding meta boxes.
require('functions/meta/meta-box-class.php');
require('functions/meta/meta-box-usage.php');
*/



/*-----------------------------------------------------------------------------------*/
/*	Images
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) )
	add_theme_support( 'post-thumbnails' );

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'full-size',  9999, 9999, false );
	add_image_size( 'small-thumb',  50, 50, true );
	add_image_size( 'post-image',  660, 220, true );
	add_image_size( 'portfolio-thumb',  230, 160, true );
	add_image_size( 'portfolio-single',  500, 9999, false );



/*-----------------------------------------------------------------------------------*/
/*	Javascsript
/*-----------------------------------------------------------------------------------*/

add_action('wp_enqueue_scripts','my_theme_scripts_function');

function my_theme_scripts_function() {
	//get theme options
	global $options;
	
	wp_deregister_script('jquery'); 
		wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"), false, '1.7.1');
	wp_enqueue_script('jquery');	
	
	// Site wide js
	wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js');
	wp_enqueue_script('hoverIntent', get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js');
	wp_enqueue_script('superfish', get_template_directory_uri() . '/js/jquery.superfish.js');
	wp_enqueue_script('prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js');
	wp_enqueue_script('slides', get_template_directory_uri() . '/js/jquery.slides.min.js');
	wp_enqueue_script('custom', get_template_directory_uri() . '/js/jquery.init.js');

	//home
	if(is_front_page()) {
		wp_enqueue_script('quicksand', get_template_directory_uri() . '/js/jquery.quicksand.js');
		wp_enqueue_script('quicksandinit', get_template_directory_uri() . '/js/jquery.quicksandinit.js');
	}
	
}



/*-----------------------------------------------------------------------------------*/
/*	Sidebars
/*-----------------------------------------------------------------------------------*/

//Register Sidebars
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'description' => 'Widgets in this area will be shown in the sidebar.',
		'before_widget' => '<div class="sidebar-box clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
));



/*-----------------------------------------------------------------------------------*/
/*	Custom Post Types & Taxonomies
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'create_post_types' );
function create_post_types() {
	//portfolio post type
	register_post_type( 'Portfolio',
		array(
		  'labels' => array(
			'name' => __( 'Portfolio', 'neptune' ),
			'singular_name' => __( 'Portfolio', 'neptune' ),		
			'add_new' => _x( 'Add New', 'Portfolio Project', 'neptune' ),
			'add_new_item' => __( 'Add New Portfolio Project', 'neptune' ),
			'edit_item' => __( 'Edit Portfolio Project', 'neptune' ),
			'new_item' => __( 'New Portfolio Project', 'neptune' ),
			'view_item' => __( 'View Portfolio Project', 'neptune' ),
			'search_items' => __( 'Search Portfolio Projects', 'neptune' ),
			'not_found' =>  __( 'No Portfolio Projects found', 'neptune' ),
			'not_found_in_trash' => __( 'No Portfolio Projects found in Trash', 'neptune' ),
			'parent_item_colon' => ''
			
		  ),
		  'public' => true,
		  'supports' => array('title','editor','thumbnail'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'portfolio' ),
		)
	  );
}


// Add taxonomies
add_action( 'init', 'create_taxonomies' );

//create taxonomies
function create_taxonomies() {
	
// portfolio taxonomies
	$cat_labels = array(
		'name' => __( 'Portfolio Categories', 'neptune' ),
		'singular_name' => __( 'Portfolio Category', 'neptune' ),
		'search_items' =>  __( 'Search Portfolio Categories', 'neptune' ),
		'all_items' => __( 'All Portfolio Categories', 'neptune' ),
		'parent_item' => __( 'Parent Portfolio Category', 'neptune' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'neptune' ),
		'edit_item' => __( 'Edit Portfolio Category', 'neptune' ),
		'update_item' => __( 'Update Portfolio Category', 'neptune' ),
		'add_new_item' => __( 'Add New Portfolio Category', 'neptune' ),
		'new_item_name' => __( 'New Portfolio Category Name', 'neptune' ),
		'choose_from_most_used'	=> __( 'Choose from the most used portfolio categories', 'neptune' )
	); 	

	register_taxonomy('portfolio_cats','portfolio',array(
		'hierarchical' => false,
		'labels' => $cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-category' ),
	));
}


/*-----------------------------------------------------------------------------------*/
/*	Portfolio Cat Pagination
/*-----------------------------------------------------------------------------------*/

// Set number of posts per page for taxonomy pages
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
	global $option_posts_per_page;
	
    if ( is_tax( 'portfolio_cats') ) {
        return 12;
    }
	else {
        return $option_posts_per_page;
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Other functions
/*-----------------------------------------------------------------------------------*/

// Limit Post Word Count
function new_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'new_excerpt_length');

//Replace Excerpt Link
function new_excerpt_more($more) {
       global $post;
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
}

// Enable Custom Background
add_custom_background();

// register navigation menus
register_nav_menus(
	array(
	'menu'=>__('Menu'),
	)
);

/// add home link to menu
function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );

// menu fallback
function default_menu() {
	require_once (TEMPLATEPATH . '/includes/default-menu.php');
}


// Localization Support
load_theme_textdomain( 'neptune', TEMPLATEPATH.'/lang' );


//create featured image column
add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
function posts_columns($defaults){
    $defaults['riv_post_thumbs'] = __('Thumbs', 'powered');
    return $defaults;
}
function posts_custom_columns($column_name, $id){
	if($column_name === 'riv_post_thumbs'){
        echo the_post_thumbnail( 'small-thumb' );
    }
}

// functions run on activation --> important flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	$wp_rewrite->flush_rules();
}
?>