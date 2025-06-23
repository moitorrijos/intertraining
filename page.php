<?php 

get_header();

if ( is_user_logged_in() ) {
	get_template_part('templates/main_content');
} else {
	get_template_part('templates/login_modal');
}

get_footer();