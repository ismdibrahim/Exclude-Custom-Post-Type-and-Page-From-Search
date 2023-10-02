<?php

/**
 * Exclude Custom Post Type From Search
 */

add_action('init', 'dev_remove_custom_type_from_search', 99);
function dev_remove_custom_type_from_search() {
    global $wp_post_types;
    if (post_type_exists('name_of_the_post_type')) {
        // exclude from search results
        $wp_post_types['name_of_the_post_type']->exclude_from_search = true;
    }
}

/**
 * The Function to will show the posts only selected post type
 */

function only_selected_type_from_search_results( $query ) {
    if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
        $query->set( 'post_type', array( 'post' ) );
    }    
}
add_action( 'pre_get_posts', 'only_selected_type_from_search_results' );
