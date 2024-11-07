<?php
namespace App;

/**
 * Register a Post Types
 */
function registerPostTypes()
{
    // $site_cpts = array('new_cpts' => true);
    $site_cpts = array('case_studies' => true, 'testimonials' => true);

    $cpts = [];

    // if ($site_cpts['new_cpts']) {
    //     $cpts['new_cpts'] = [
    //         'singular' => 'New CPT',
    //         'multiple' => 'new_cpts',
    //         'has_page' => true,
    //         'args' => [
    //             'menu_icon' => 'dashicons-testimonial',
    //         ],
    //     ];
    // }
    if ($site_cpts['case_studies']) {
        $cpts['case_studies'] = [
            'singular' => 'New Case Study',
            'multiple' => 'Case Studies',
            'has_page' => true,
            'args' => [
                'menu_icon' => 'dashicons-book',
            ],
            'graphql_single' => 'case_study',
            'graphql_plural' => 'case_studies',
        ];
    }

    if ($site_cpts['testimonials']) {
      $cpts['testimonials'] = [
          'singular' => 'Testimonial',
          'multiple' => 'Testimonials',
          'has_page' => true,
          'args' => [
              'menu_icon' => 'dashicons-testimonial',
          ],
          'graphql_single' => 'testimonial',
          'graphql_plural' => 'testimonials',
      ];
  }

    collect($cpts)->map(function ($args, $post_type) {
        register_post_type($post_type, array_merge([
            'labels' => [
                'name' => __($args['multiple'], 'nova'),
                'singular_name' => __($args['singular'], 'nova'),
                'menu_name' => __($args['multiple'], 'nova'),
                'add_new' => __(sprintf('Add %s', $args['singular']), 'nova'),
                'add_new_item' => __(sprintf('Add New %s', $args['singular']), 'nova'),
                'new_item' => __(sprintf('New %s', $args['singular']), 'nova'),
                'edit_item' => __(sprintf('Edit %s', $args['singular']), 'nova'),
                'view_item' => __(sprintf('View %s', $args['singular']), 'nova'),
                'all_items' => __(sprintf('View %s', $args['multiple']), 'nova'),
                'search_items' => __(sprintf('Search %s', $args['multiple']), 'nova'),
                'not_found' => __(sprintf('No %s Found', $args['multiple']), 'nova'),
                'not_found_in_trash' => __(sprintf('No %s found in Trash.', $args['multiple']), 'nova'),
            ],
            'description' => '',
            'public' => $args['has_page'],
            'menu_icon' => 'dashicons-admin-page',
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 20,
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'hierarchical' => false,
            'rewrite' => ['slug' => $post_type, 'with_front' => false],
            'query_var' => true,
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'], //remove 'excerpt' if not needed
            'has_archive' => true,
            'exclude_from_search' => $args['has_page'],
            'publicly_queryable' => $args['has_page'],
            'show_in_graphql' => true,
            'graphql_single_name' => __($args['graphql_single'], 'nova'),
            'graphql_plural_name' => __($args['graphql_plural'], 'nova'),
        ], $args['args']));
    });
}
add_action('init', __NAMESPACE__ . '\\registerPostTypes', 0);
