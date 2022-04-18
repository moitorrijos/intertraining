<?php

if ( ! function_exists( 'courses_pmts_setup' ) ) :
	function courses_pmts_setup() {
		load_theme_textdomain( 'courses_pmts', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-logo', array(
				'height' => 140,
				'width'  => 140,
		) );
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'courses_pmts' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}
endif;

add_action( 'after_setup_theme', 'courses_pmts_setup' );
