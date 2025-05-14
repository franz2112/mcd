<?php
function cptui_register_my_cpts_projects() {

    /**
     * Post Type: Projects.
     */

    $labels = [
        "name" => esc_html__( "Projects", "custom-post-type-ui" ),
        "singular_name" => esc_html__( "Project", "custom-post-type-ui" ),
        "add_new" => esc_html__( "Add Project", "custom-post-type-ui" ),
        "add_new_item" => esc_html__( "Add New Project", "custom-post-type-ui" ),
    ];

    $args = [
        "label" => esc_html__( "Projects", "custom-post-type-ui" ),
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
        "rewrite" => [ "slug" => "projects", "with_front" => true ],
        "query_var" => true,
        "menu_icon" => "dashicons-portfolio",
        "supports" => [ "title", "thumbnail", "excerpt", "custom-fields", "revisions", "author" ],
        "show_in_graphql" => false,
    ];
    register_post_type( "projects", $args );
}

add_action( 'init', 'cptui_register_my_cpts_projects' );

function register_project_taxonomy() {
    /**
     * Projects Category.
     */
    register_taxonomy('project_category', 'projects', [
        'label' => 'Project Categories',
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'rewrite' => ['slug' => 'project-category'],
        'show_admin_column' => true,
        "show_in_nav_menus" => true,
        'show_in_rest' => true,
    ]);
}

add_action('init', 'register_project_taxonomy');
