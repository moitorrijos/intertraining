<?php

function register_styles_scripts() {

  wp_enqueue_style(
    'google_fonts',
    'https://fonts.googleapis.com/css2?family=Lato:wght@300;700&family=Montserrat:wght@300;500&display=swap',
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
      'security' => wp_create_nonce( 'course_nonce' ),
      'course_id' => get_the_ID(),
      'user_id' => get_current_user_id(),
      'redirect_url' => get_permalink( 51127 )
    ));

    wp_enqueue_script(
      'theoretical_exam',
      THEMEROOT . '/js/theoretical-exam.js',
      array(),
      THEMEVERSION, true
    );

    wp_localize_script( 'theoretical_exam', 'exam_obj', array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
      'security' => wp_create_nonce( 'exam_nonce' ),
    ));

  }

  if ( is_page( 51127 ) ) {

    wp_enqueue_script(
      'profile',
      THEMEROOT . '/js/profile.js',
      array(), THEMEVERSION, true 
    );

    wp_enqueue_script(
      'change_password',
      THEMEROOT . '/js/change-password.js',
      array(), THEMEVERSION, true
    );

    wp_localize_script('change_password', 'new_pass_obj', array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
      'security' => wp_create_nonce( 'new_pass_nonce' )
    ));

    wp_enqueue_script(
      'change_details',
      THEMEROOT . '/js/change-details.js',
      array(), THEMEVERSION, true
    );

    wp_localize_script('change_details', 'new_details_obj', array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
      'security' => wp_create_nonce( 'new_details_nonce' )
    ));
  }

  if ( is_page_template('page-certificate.php') ) {
    wp_enqueue_script(
      'html2pdf',
      'https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js',
      array(), THEMEVERSION, true
    );

    wp_enqueue_script(
      'certificate',
      THEMEROOT . '/js/certificate.js',
      array('html2pdf'), THEMEVERSION, true
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