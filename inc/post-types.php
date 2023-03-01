<?php 
/**
 * @author	Ryan Sutana
 * @package fullscale
 */

/**
 * Register a custom post types
 *
 * @see get_post_type_labels() for label keys.
 */
function fs_post_type_init() {
    $post_types['talent'] = [
        'labels'             => [
            'name'                  => _x( 'Talents', 'Post type general name', 'learnitmd' ),
            'singular_name'         => _x( 'Talent', 'Post type singular name', 'learnitmd' ),
            'menu_name'             => _x( 'Talents', 'Admin Menu text', 'learnitmd' ),
            'name_admin_bar'        => _x( 'Talent', 'Add New on Toolbar', 'learnitmd' ),
            'add_new'               => __( 'Add New', 'learnitmd' ),
            'add_new_item'          => __( 'Add New Talent', 'learnitmd' ),
            'new_item'              => __( 'New Talent', 'learnitmd' ),
            'edit_item'             => __( 'Edit Talent', 'learnitmd' ),
            'view_item'             => __( 'View Talent', 'learnitmd' ),
            'all_items'             => __( 'All Talents', 'learnitmd' ),
            'search_items'          => __( 'Talents', 'learnitmd' ),
            'parent_item_colon'     => __( 'Parent Talents:', 'learnitmd' ),
            'not_found'             => __( 'No Talents found.', 'learnitmd' ),
            'not_found_in_trash'    => __( 'No Talents found in Trash.', 'learnitmd' ),
            'featured_image'        => _x( 'Talent Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'learnitmd' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'learnitmd' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'learnitmd' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'learnitmd' ),
            'archives'              => _x( 'Talent archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'learnitmd' ),
            'insert_into_item'      => _x( 'Insert into talent', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'learnitmd' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this talent', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'learnitmd' ),
            'filter_items_list'     => _x( 'Filter talents list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'learnitmd' ),
            'items_list_navigation' => _x( 'Talents list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'learnitmd' ),
            'items_list'            => _x( 'Talents list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'learnitmd' ),
        ],
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'show_in_rest'       => true,
        'rewrite'            => [ 'slug' => 'talent', 'with_front' => false ],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => [ 'title', 'editor' ],
    ];

    if( $post_types ) {
        foreach( $post_types as $post_type => $args ) {
            register_post_type( $post_type, $args );
        }
    }
}

add_action( 'init', 'fs_post_type_init' );