<?php
function cptui_register_my_cpts_services() {

    /**
     * Post Type: services.
     */

    $labels = [
        "name" => esc_html__( "Services", "custom-post-type-ui" ),
        "singular_name" => esc_html__( "Service", "custom-post-type-ui" ),
        "add_new" => esc_html__( "Add Service", "custom-post-type-ui" ),
        "add_new_item" => esc_html__( "Add New Service", "custom-post-type-ui" ),
    ];

    $args = [
        "label" => esc_html__( "Services", "custom-post-type-ui" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => true,
        "can_export" => false,
        "rewrite" => [ "slug" => "services", "with_front" => true ],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-generic",
        "supports" => [ "title", "thumbnail", "excerpt", "custom-fields", "revisions", "author" ],
        "show_in_graphql" => false,
    ];
    register_post_type( "services", $args );
}

add_action( 'init', 'cptui_register_my_cpts_services' );

function register_services_taxonomy() {
    /**
    * Insights Category.
    */
   register_taxonomy('services_category', 'services', [
       'label' => 'Services Categories', 
       'hierarchical' => true,
       'public' => true,
       'show_ui' => true,
       'rewrite' => ['slug' => 'services-category'],
       'show_admin_column' => true,
       "show_in_nav_menus" => true,
       'show_in_rest' => true,
       
   ]);
}

add_action('init', 'register_services_taxonomy');
