<?php

if ( !is_user_logged_in() ) {

  get_header();

  get_template_part( 'templates/login_area' ); 

  get_footer();
  
} else {

  wp_redirect( get_permalink(51118) );

  exit;

}
