<?php

function change_role_names() {
    global $wp_roles;

    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();

    /**
     * Change Author to Senior Surveyor
     */
    $wp_roles->roles['author']['name'] = 'Data Entry';
    $wp_roles->role_names['author'] = 'Data Entry';
    
    /**
     * Change Contributor to Engineer Surveyor
     */
    $wp_roles->roles['contributor']['name'] = 'Instructor';
    $wp_roles->role_names['contributor'] = 'Instructor';

    /**
     * Change Subscriber to Representative Surveyor
     */
    $wp_roles->roles['subscriber']['name'] = 'Student';
    $wp_roles->role_names['subscriber'] = 'Student';

}
add_action('init', 'change_role_names');

function itt_custom_roles_install() {
	change_role_names();
}

register_activation_hook( __FILE__, 'itt_custom_roles_install' );