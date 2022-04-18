<?php

/* Template Name: My Courses Page */

if ( is_user_logged_in() ) {

  get_header();

  get_template_part( 'templates/my_courses' );

  get_footer();

} else {

  wp_redirect( home_url() );

  exit;

}

?>