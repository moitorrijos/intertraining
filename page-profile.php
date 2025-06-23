<?php

/* Template Name: Profile Page */
get_header();

if ( is_user_logged_in() ) {


  get_template_part( 'templates/profile' );

} else {

  get_template_part('templates/login_modal');

}

get_footer();

?>