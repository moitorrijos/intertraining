<?php

add_action('wp_ajax_new_password', 'new_password');

function new_password() {

  if ( !check_ajax_referer( 'new_pass_nonce', 'security' ) ) {

    return wp_send_json_error( 'Invalid security threshold.' );

  }

  $user_id = get_current_user_id();

  $new_pass = $_REQUEST['new-password'];

  $user = get_user_by('id', $user_id);

  wp_set_password($new_pass, $user_id);

  wp_set_auth_cookie($user_id);

  wp_set_current_user($user_id);

  return wp_send_json_success( 'Password changed successfully.' );

}