<?php

add_action('wp_ajax_change_details', 'change_details');

function change_details() {

  if (!check_ajax_referer( 'new_details_nonce', 'security' )) {

    return wp_send_json_error( 'Invalid security threshold.' );

  }

  $user_id = get_current_user_id();

  $first_name = $_REQUEST['first-name'];
  $last_name = $_REQUEST['last-name'];
  $passport_id = $_REQUEST['passport-id'];
  $country_of_birth = $_REQUEST['country-of-birth'];
  $nationality = $_REQUEST['nationality'];
  $date_of_birth = $_REQUEST['date-of-birth'];
  $date_of_birth = date_create_from_format("Y-m-d", $date_of_birth);
  $date_of_birth = $date_of_birth->format("Ymd");

  update_field('first_name', $first_name, 'user_' . $user_id);
  update_field('last_name', $last_name, 'user_' . $user_id);
  update_field('passportid_no', $passport_id, 'user_' . $user_id);
  update_field('country_of_birth', $country_of_birth, 'user_' . $user_id);
  update_field('nationality', $nationality, 'user_' . $user_id);
  update_field('date_of_birth', $date_of_birth, 'user_' . $user_id);  

  return wp_send_json_success( 'Details changed successfully.' );

}