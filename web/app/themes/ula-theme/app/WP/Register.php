<?php
/**
 * Register
 * --------
 *
 * @category WP
 * @version 1.0
 * @package Lydia
 */

namespace Ula\WP;

defined( 'ABSPATH' ) || exit;

class Register
{

    /**
     * @param $post_types
     * @return null
     */
    public static function post_types( $post_types )
    {

        if ( empty( $post_types ) ) {
            return;
        }

        foreach ( $post_types as $post_type ) {

            $defaults = [
                'plural'              => '',    // !required (str)
                'singular'            => '',    // !required (str)
                'key'                 => false, // !required (str)
                'rewrite_slug'        => false, // !recommended if has frontend visibility (str)
                'rewrite_with_front'  => false,
                'rewrite_feeds'       => true,
                'rewrite_pages'       => true,
                'menu_icon'           => 'dashicons-admin-post',
                'hierarchical'        => false,
                'supports'            => ['title', 'thumbnail'],
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => true,
                'publicly_queryable'  => true,
                'exclude_from_search' => false,
                'has_archive'         => true,
                'query_var'           => true,
                'can_export'          => true,
                'taxonomies'          => [],
                'capability_type'     => 'post',
                'show_in_rest'        => true
            ];

            $post_type = wp_parse_args( $post_type, $defaults );

            if ( ! $post_type['key'] ) {
                continue;
            }

            $labels = [
                'name'               => $post_type['plural'],
                'singular_name'      => $post_type['singular'],
                'add_new'            => _x( 'Add New', 'lydia' ),
                'add_new_item'       => _x( sprintf( 'Add New %s', $post_type['singular'] ), 'lydia' ),
                'edit_item'          => _x( sprintf( 'Edit %s', $post_type['singular'] ), 'lydia' ),
                'new_item'           => _x( sprintf( 'New %s', $post_type['singular'] ), 'lydia' ),
                'view_item'          => _x( sprintf( 'View %s', $post_type['singular'] ), 'lydia' ),
                'search_items'       => _x( sprintf( 'Search %s', $post_type['plural'] ), 'lydia' ),
                'not_found'          => _x( sprintf( 'No %s found', strtolower( $post_type['plural'] ) ), 'lydia' ),
                'not_found_in_trash' => _x( sprintf( 'No %s found in Trash', strtolower( $post_type['plural'] ) ), 'lydia' ),
                'parent_item_colon'  => _x( sprintf( 'Parent %s:', $post_type['singular'] ), 'lydia' ),
                'menu_name'          => $post_type['plural']
            ];

            $args = [
                'labels'              => $labels,
                'hierarchical'        => $post_type['hierarchical'],
                'supports'            => $post_type['supports'],
                'public'              => $post_type['public'],
                'show_ui'             => $post_type['show_ui'],
                'show_in_menu'        => $post_type['show_in_menu'],
                'menu_icon'           => $post_type['menu_icon'],
                'show_in_nav_menus'   => $post_type['show_in_nav_menus'],
                'publicly_queryable'  => $post_type['publicly_queryable'],
                'exclude_from_search' => $post_type['exclude_from_search'],
                'has_archive'         => $post_type['has_archive'],
                'query_var'           => $post_type['query_var'],
                'can_export'          => $post_type['can_export'],
                'capability_type'     => $post_type['capability_type'],
                'taxonomies'          => $post_type['taxonomies'],
                'rewrite'             => false
            ];

            if ( $post_type['rewrite_slug'] ) {
                $args['rewrite'] = [
                    'slug'       => $post_type['rewrite_slug'],
                    'with_front' => $post_type['rewrite_with_front'],
                    'feeds'      => $post_type['rewrite_feeds'],
                    'pages'      => $post_type['rewrite_pages']
                ];
            }

            register_post_type( $post_type['key'], $args );
        }
    }

    /**
     * @param $taxonomies
     * @return null
     */
    public static function taxonomies( $taxonomies )
    {

        if ( empty( $taxonomies ) ) {
            return;
        }

        foreach ( $taxonomies as $taxonomy ) {

            $defaults = [
                'plural'            => false,
                'singular'          => false,
                'key'               => false,
                'post_types'        => [],
                'hierarchical'      => false,
                'public'            => true,
                'show_ui'           => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud'     => true,
                'rewrite'           => [
                    'with_front' => false
                ]
            ];

            $taxonomy = wp_parse_args( $taxonomy, $defaults );

            if ( ! $taxonomy['key'] ) {
                continue;
            }

            $taxonomy['labels'] = [
                'name'                       => $taxonomy['plural'],
                'singular_name'              => $taxonomy['singular'],
                'menu_name'                  => $taxonomy['plural'],
                'all_items'                  => __( 'All Items', 'six' ),
                'parent_item'                => __( 'Parent Item', 'six' ),
                'parent_item_colon'          => __( 'Parent Item:', 'six' ),
                'new_item_name'              => __( 'New Item Name', 'six' ),
                'add_new_item'               => __( 'Add New Item', 'six' ),
                'edit_item'                  => __( 'Edit Item', 'six' ),
                'update_item'                => __( 'Update Item', 'six' ),
                'view_item'                  => __( 'View Item', 'six' ),
                'separate_items_with_commas' => __( 'Separate items with commas', 'six' ),
                'add_or_remove_items'        => __( 'Add or remove items', 'six' ),
                'choose_from_most_used'      => __( 'Choose from the most used', 'six' ),
                'popular_items'              => __( 'Popular Items', 'six' ),
                'search_items'               => __( 'Search Items', 'six' ),
                'not_found'                  => __( 'Not Found', 'six' ),
                'no_terms'                   => __( 'No items', 'six' ),
                'items_list'                 => __( 'Items list', 'six' ),
                'items_list_navigation'      => __( 'Items list navigation', 'six' )
            ];

            register_taxonomy( $taxonomy['key'], $taxonomy['post_types'], $taxonomy );
        }
    }
}
