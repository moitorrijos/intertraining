<?php

require get_template_directory() . '/includes/theme_setup.php';
require get_template_directory() . '/includes/define_constants.php';
require get_template_directory() . '/includes/register_styles_scripts.php';
require get_template_directory() . '/includes/logout-nav-link.php';

/**
 * Change Role Names
 */
require get_template_directory() . '/includes/courses-roles.php';

/**
 * New User Profile Fields
 */
// require get_template_directory() . '/includes/new-user-profile-fields.php';

/**
 * Remove Admin Bars
 */
require get_template_directory() . '/includes/remove_admin_bar.php';


/**
 * Ajax Calls
 */
require get_template_directory() . '/includes/ajax_login.php';
require get_template_directory() . '/includes/update_latest_position.php';

/**
 * Post Types
 */
require get_template_directory() . '/post-types/courses.php';

/**
 * Custom Metaboxes
 */
require get_template_directory() . '/includes/courses_metabox.php';

/**
 * Hide Posts and Comments
 */
function moi_hide_posts_and_comments_admin_menu() {
  remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
}

add_filter('admin_menu', 'moi_hide_posts_and_comments_admin_menu');

function the_slug_sub_field( string $field_name ) {
  $field = get_sub_field( $field_name );
  return strtolower(str_replace( array(' ', ':'), array('-', ''), $field ));
}
