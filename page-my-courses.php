<?php

/* Template Name: My Courses Page */
get_header();

if ( is_user_logged_in() ) {

  get_template_part( 'templates/my_courses' );
  
} else {
  
  get_template_part('templates/login_modal');
  
}

get_footer();
?>