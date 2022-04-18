<?php

add_action( 'wp_ajax_nopriv_ajax_login', 'ajax_login' );

function ajax_login() {

  if ( !check_ajax_referer( 'login_nonce', 'security' ) ) {

    return wp_send_json_error( 'Invalid security threshold.' );

  }

  $info = array(
    'user_login' => $_REQUEST['pmtsc_user_login'],
    'user_password' => $_REQUEST['pmtsc_user_pass'],
    'remember' => true
  );

  $user_signon = wp_signon( $info, false );

  if ( !is_wp_error( $user_signon ) ) {
    echo wp_json_encode(array(
      'logged_in' => true
    ));
  } else {
    echo json_encode(array(
      'logged_in' => false,
      'error_message' => $user_signon->get_error_message()
    ));
  }

  wp_die();

}
