<?php

namespace App;

/**
 * Advanced Custom Fields Functions & Hooks
 */

/**
 * Check if Advanced Custom Fields are in-sync
 * If so, display notice
 */
function checkACFSync()
{

    /**
     * Check if ACF pro is activated
     */
    if (!function_exists('acf_get_field_groups')) {
        return;
    }

    // Only check fields on Dev Admin, not Prod/Staging (or Front-End)
    if (!is_admin()) {
        return false;
    }

    // NOTE: Code below shamelessly lifted from ACF plugin itself

    // vars
    $groups = acf_get_field_groups();

    // bail early if no field groups
    if (empty($groups)) {
        return;
    }

    $sync = array();

    // find JSON field groups which have not yet been imported
    foreach ($groups as $group) {
        // vars
        $local = acf_maybe_get($group, 'local', false);
        $modified = acf_maybe_get($group, 'modified', 0);
        $private = acf_maybe_get($group, 'private', false);

        // ignore DB / PHP / private field groups
        if ($local !== 'json' || $private) {
            // do nothing
        } elseif (!$group['ID']) {
            $sync[$group['key']] = $group;
        } elseif ($modified && $modified > get_post_modified_time('U', true, $group['ID'], true)) {
            $sync[$group['key']] = $group;
        }
    }

    // If out of sync fields exist, display giant error message in Admin area
    if (!empty($sync) && count($sync) > 0) {
        $sync_url = 'edit.php?post_type=acf-field-group&post_status=sync&_wpnonce='
        . wp_create_nonce('bulk-posts')
            . '&action2=acfsync';

        foreach ($sync as $group_key => $group) {
            $sync_url .= '&post[]=' . $group_key;
        }

        $message = '<h2 style="color:#dd3d36;"><b>Warning</b>: '
        . count($sync) . ' '
        . __('Advanced Custom Fields Groups are out of Sync!')
            . '</h2>%s';

        $button = '<a href="'
        . admin_url($sync_url)
            . '" class="button button-primary button-large">'
            . '<i class="acf-icon acf-icon-sync"></i> Sync Fields</a>';

        acf_add_admin_notice(sprintf($message, $button), 'error');
    }

    return;
}
add_action('init', __NAMESPACE__ . '\\checkACFSync', 10);

$favicon = esc_url(get_field('site_favicon','options')['url']);

if (function_exists('acf_add_options_page')) {
    $theme = 'Site';

    acf_add_options_page([
        'page_title' => "$theme Settings",
        'menu_title' => "$theme Settings",
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'icon_url' => $favicon,
        'position' => 6,
        'show_in_graphql' => true,
    ]);
}

// Set save point
add_filter('acf/settings/save_json', function ($path) {
    $path = get_stylesheet_directory() . '/acf-json';

    return $path;
});

// Set load point(s) - ACF loads all .json files from multiple load points
add_filter('acf/settings/load_json', function ($paths) {
    // remove original path (optional)
    unset($paths[0]);

    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';

    return $paths;
});

/**
 * Only Show the ACF Admin Menu on Development Environment
 */
// function ACFShowAdminMenu($show)
// {
//     return (WP_ENV == 'local');
// }
// add_filter('acf/settings/show_admin', __NAMESPACE__ . '\\ACFShowAdminMenu');

// Add API key to ACF settings
function ACFMapKey()
{
    acf_update_setting('google_api_key', 'AIzaSyBXCgdLb0Rpd0xLmyMwOURVz6VjG236y_w');
}
add_action('acf/init', __NAMESPACE__ . '\\ACFMapKey');
