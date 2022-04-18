<?php

add_action( 'wp_ajax_update_latest_position', 'update_latest_position');

function update_latest_position() {

  if ( !check_ajax_referer( 'course_nonce', 'security' ) ) {

    return wp_send_json_error( 'Invalid security threshold' );

  }

  $post_id = $_POST['post_id'];
  $hash = $_POST['hash'];

  update_post_meta( $post_id, 'latest_position', $hash );

}