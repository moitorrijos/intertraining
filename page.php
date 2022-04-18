<?php 

if ( is_user_logged_in() ) {

	get_header();

	get_template_part('templates/main_content');

	get_footer();

} else {

	wp_redirect( home_url() ); exit();
	
}