<?php

function pmtsc_logout_nav_link( $items, $args ) {
	if ($args->theme_location == 'menu-1') {
		$items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page logout-button"><a href="'. wp_logout_url( home_url() ) .'"><i class="_mi _before dashicons dashicons-migrate"></i> <span>Log Out</span></a></li>';
	}
	return $items;
}

add_filter( 'wp_nav_menu_items', 'pmtsc_logout_nav_link', 10, 2 );