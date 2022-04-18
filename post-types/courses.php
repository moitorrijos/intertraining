<?php

function courses_init() {
	register_post_type( 'courses', array(
		'labels'            => array(
			'name'                => __( 'Courses', 'certificate-system' ),
			'singular_name'       => __( 'Courses', 'certificate-system' ),
			'all_items'           => __( 'Courses', 'certificate-system' ),
			'new_item'            => __( 'New Courses', 'certificate-system' ),
			'add_new'             => __( 'Add New', 'certificate-system' ),
			'add_new_item'        => __( 'Add New Courses', 'certificate-system' ),
			'edit_item'           => __( 'Edit Courses', 'certificate-system' ),
			'view_item'           => __( 'View Courses', 'certificate-system' ),
			'search_items'        => __( 'Search Courses', 'certificate-system' ),
			'not_found'           => __( 'No Courses found', 'certificate-system' ),
			'not_found_in_trash'  => __( 'No Courses found in trash', 'certificate-system' ),
			'parent_item_colon'   => __( 'Parent Courses', 'certificate-system' ),
			'menu_name'           => __( 'Courses', 'certificate-system' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor', 'thumbnail', 'author' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-welcome-learn-more',
	) );

}
add_action( 'init', 'courses_init' );

function courses_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['courses'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Courses updated. <a target="_blank" href="%s">View Courses</a>', 'certificate-system'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'certificate-system'),
		3 => __('Custom field deleted.', 'certificate-system'),
		4 => __('Courses updated.', 'certificate-system'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Courses restored to revision from %s', 'certificate-system'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Courses published. <a href="%s">View Courses</a>', 'certificate-system'), esc_url( $permalink ) ),
		7 => __('Courses saved.', 'certificate-system'),
		8 => sprintf( __('Courses submitted. <a target="_blank" href="%s">Preview Courses</a>', 'certificate-system'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Courses scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Courses</a>', 'certificate-system'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Courses draft updated. <a target="_blank" href="%s">Preview Courses</a>', 'certificate-system'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'courses_updated_messages' );