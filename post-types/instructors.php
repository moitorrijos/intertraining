<?php

function instructors_init() {
	register_post_type( 'instructors', array(
		'labels'            => array(
			'name'                => __( 'Instructors', 'certificate-system' ),
			'singular_name'       => __( 'Instructors', 'certificate-system' ),
			'all_items'           => __( 'Instructors', 'certificate-system' ),
			'new_item'            => __( 'New Instructors', 'certificate-system' ),
			'add_new'             => __( 'Add New', 'certificate-system' ),
			'add_new_item'        => __( 'Add New Instructors', 'certificate-system' ),
			'edit_item'           => __( 'Edit Instructors', 'certificate-system' ),
			'view_item'           => __( 'View Instructors', 'certificate-system' ),
			'search_items'        => __( 'Search Instructors', 'certificate-system' ),
			'not_found'           => __( 'No Instructors found', 'certificate-system' ),
			'not_found_in_trash'  => __( 'No Instructors found in trash', 'certificate-system' ),
			'parent_item_colon'   => __( 'Parent Instructors', 'certificate-system' ),
			'menu_name'           => __( 'Instructors', 'certificate-system' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-businessman',
	) );

}
add_action( 'init', 'instructors_init' );

function instructors_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['instructors'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Instructors updated. <a target="_blank" href="%s">View Instructors</a>', 'certificate-system'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'certificate-system'),
		3 => __('Custom field deleted.', 'certificate-system'),
		4 => __('Instructors updated.', 'certificate-system'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Instructors restored to revision from %s', 'certificate-system'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Instructors published. <a href="%s">View Instructors</a>', 'certificate-system'), esc_url( $permalink ) ),
		7 => __('Instructors saved.', 'certificate-system'),
		8 => sprintf( __('Instructors submitted. <a target="_blank" href="%s">Preview Instructors</a>', 'certificate-system'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Instructors scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Instructors</a>', 'certificate-system'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Instructors draft updated. <a target="_blank" href="%s">Preview Instructors</a>', 'certificate-system'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'instructors_updated_messages' );
