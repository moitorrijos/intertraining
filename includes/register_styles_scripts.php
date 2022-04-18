<?php

function register_styles_scripts() {

  wp_enqueue_style(
    'google_fonts',
    'https://fonts.googleapis.com/css2?family=Lato&family=Raleway&family=Rokkitt:wght@500',
    array(), THEMEVERSION, 'all' );
    
  wp_enqueue_style(
    'main_style',
    THEMEROOT . '/css/main.css',
    array(), THEMEVERSION, 'all' );

  wp_enqueue_script(
    'axios',
    'https://unpkg.com/axios/dist/axios.min.js',
    array(), THEMEVERSION, true );

  if ( is_front_page() ) {

    wp_enqueue_script(
      'ajax_login',
      THEMEROOT . '/js/ajax-login.js',
      array('axios'), THEMEVERSION, true );
    
    wp_localize_script( 'ajax_login', 'ajax_obj', array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
      'redirect_url' => get_permalink( 51118 ),
      'security' => wp_create_nonce( 'login_nonce' )
    ));
  }

  if ( is_singular('courses') ) {

    wp_enqueue_script(
      'course_navigation',
      THEMEROOT . '/js/course-navigation.js',
      array(),
      THEMEVERSION, true
    );

    wp_localize_script( 'course_navigation', 'course_obj', array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
      'security' => wp_create_nonce( 'course_nonce' )
    ));

  }

  if ( is_page( 51127 ) ) {

    wp_enqueue_script( 
      'profile',
      THEMEROOT . '/js/profile.js',
      array(), THEMEVERSION, true 
    );
    
  }
}

add_action( 'wp_enqueue_scripts', 'register_styles_scripts' );

function pmtsc_selectively_enqueue_admin_script( $hook ) {
  if ( 'user-edit.php' != $hook ) {
      return;
  }
  wp_enqueue_style(
    'user-edit',
    THEMEROOT . '/css/user-edit.css',
    array(), THEMEVERSION, 'all' );
}

add_action( 'admin_enqueue_scripts', 'pmtsc_selectively_enqueue_admin_script' );