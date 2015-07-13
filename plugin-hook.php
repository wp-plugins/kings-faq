<?php
/*
Plugin Name: Kings FAQ
Plugin URI: http://wordpress.org/plugins/kings-faq
Description: This plugin will add an FAQ section in your WordPress site. 
Author: Saif Bin-Alam
Author URI: http://wordpresstalks.com
Version: 1.1
*/



/**************************************************
1. Calling WordPress jQuery
**************************************************/
function kings_faq_latest_jquery() {
    wp_enqueue_script('jquery');
}
add_action('init','kings_faq_latest_jquery');
    

/**************************************************
2. Calling Plugin Files
**************************************************/


function kings_faq_plugin_main_files() {
    wp_enqueue_script( 'kings-faq-js', plugins_url( '/js/kings-faq-js.js', __FILE__ ), array('jquery'), 1.0, false);
    wp_enqueue_style( 'kings-faq-css', plugins_url( '/css/kings-faq-style.css', __FILE__ ));
}

add_action('init','kings_faq_plugin_main_files');
    

/**************************************************
2.1. Creating Custom Post
**************************************************/



function kings_faq_custom_post() {

	register_post_type( 'kings-faq-items',
		array(
			'labels' => array(
				'name' => __( 'FAQ Items' ),
				'singular_name' => __( 'FAQ Item' ),
				'add_new_item' => __( 'Add New FAQ' )
			),
			'public' => true,
			'supports' => array( 'title', 'editor'),
			'has_archive' => true,
			'rewrite' => array('slug' => 'faq-item'),
		)
	);
		

}
add_action( 'init', 'kings_faq_custom_post' );


/**************************************************
2.2. Creating Custom Taxanomy
**************************************************/


function kings_faq_taxonomy() {
	register_taxonomy(
		'kings_faq_cat',  
		'kings-faq-items',                  
		array(
			'hierarchical'           => true,
			'label'                  => 'FAQ Category',  
			'query_var'              => true,
			'show_admin_column'		 => true,
			'rewrite'                => array(
                'slug'                   => 'faq-category', 
                'with_front'             => true 
				)
			)
	);
}
add_action( 'init', 'kings_faq_taxonomy');


/**************************************************
3. Custom Shortcode for Kings FAQ
**************************************************/


function kings_faq_shortcode($atts){
	extract( shortcode_atts( array(
		'category' => '',
		'orderby' => '',
		'order' => '',
		'color' => '',
		'bg' => '',
		'count' => ''
	), $atts, 'projects' ) );
	
    $q = new WP_Query(
        array('posts_per_page' => $count, 'post_type' => 'kings-faq-items', 'order' => $order, 'orderby' => $orderby, 'kings_faq_cat' => $category)
        );		
		
		
	$list = '<div id="kingsrrf_faq">';
	
	while($q->have_posts()) : $q->the_post();
		
		$list .= '
			  <dt style="color: '. $color .'; background: '. $bg .'; ">'.get_the_title().'</dt>
			  <dd>'.get_the_content().'</dd>';        
	endwhile;
	$list.= '</div>';
	wp_reset_query();
	return $list;
}
add_shortcode('kings-faq', 'kings_faq_shortcode');	




?>