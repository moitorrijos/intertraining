<?php

/* Template Name: Support Page */
get_header();

if ( is_user_logged_in() ) {


  get_template_part( 'templates/support' );

  
} else {
  
  get_template_part('templates/login_modal');
  
}

get_footer();

?>