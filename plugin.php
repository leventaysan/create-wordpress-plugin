<?php
/*
Plugin Name: Projects
Version: 1.0
Description: Wordpress Projects Plugin Descriptions
Author: Levent Aysan
License: GNU
Text Domain: Projects Plugin
*/



function custom_post_type() {
    
    $labels = array(
        'name'          => 'Products', 
        'singular_name' => 'Product'   
    );

    
    $supports = array(
        'title',
        'editor', 
        'excerpt',      
        'author',       
        'thumbnail',    
        'comments',   
        'trackbacks',   
        'revisions',    
        'custom-fields' 
    );

    
    $args = array(
        'labels'              => $labels,
        'description'         => 'Post type post product', 
        'supports'            => $supports,
        'taxonomies'          => array( 'category', 'post_tag' ),
        'hierarchical'        => false, 
        'public'              => true,  
        'show_ui'             => true,  
        'show_in_menu'        => true,  
        'show_in_nav_menus'   => true,  
        'show_in_admin_bar'   => true,  
        'menu_position'       => 5,     
        'menu_icon'           => true,  
        'can_export'          => true,  
        'has_archive'         => true,  
        'exclude_from_search' => false, 
        'publicly_queryable'  => true,  
        'capability_type'     => 'post' 
    );

    register_post_type('product', $args); 
}
function post_shortcode( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'product',
        
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'title',
    ) );
    if ( $query->have_posts() ) { ?>
        <ul >
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </ul>
    <?php $data = ob_get_clean();
    return $data;
    }
}
add_action('init', 'custom_post_type');
add_shortcode( 'KL_PROJECT', 'post_shortcode' );
?>