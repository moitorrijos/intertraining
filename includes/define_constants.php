<?php

if ( ! defined( 'THEMEVERSION' ) ) {
	define( 'THEMEVERSION', wp_get_theme()->get('Version') );
}

if ( ! defined( 'THEMEROOT' ) ) {
  define( 'THEMEROOT', get_template_directory_uri() );
}

if ( ! defined( 'IMAGESPATH' ) ) {
  define( 'IMAGESPATH', THEMEROOT . '/images' );
}