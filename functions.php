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
require get_template_directory() . '/includes/theoretical-exam.php';
require get_template_directory() . '/includes/change-password.php';

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

function get_my_courses_id($current_user_id) {
  $my_courses = [];
  if( have_rows('courses', 'user_' . $current_user_id) ):
    while( have_rows('courses', 'user_' . $current_user_id) ) : the_row();
      array_push($my_courses, get_sub_field('course_name', 'user_' . $current_user_id)->ID);
    endwhile;
  endif;
  return $my_courses;
}

function get_my_courses($current_user_id) {
  $my_courses = [];
  if (have_rows('courses', 'user_' . $current_user_id)) :
    while (have_rows('courses', 'user_' . $current_user_id)) : the_row();
      $my_courses[] = [
        'course' => get_sub_field('course_name', 'user_' . $current_user_id),
        'score' => get_sub_field('exam_score'),
        'exam_answers' => json_decode(get_sub_field('exam_answers')),
      ];
    endwhile;
  endif;
  return $my_courses;
}

function passing_score($score) {
  if ($score >= 80) {
    return true;
  } else {
    return false;
  }
}

function is_course_submitted( $user_id, $course_id ) {
  $my_courses = get_my_courses( $user_id );
  // filter my courses by course id
  $filtered_courses = array_filter( $my_courses, function( $course ) use ( $course_id ) {
    return $course['course']->ID === $course_id;
  } );
  // if the size of the array is 0, then the course has not been submitted
  return count( $filtered_courses ) > 0;
}