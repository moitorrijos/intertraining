<?php

add_action( 'wp_ajax_support', 'support' );

function support() {
  
    if ( !check_ajax_referer( 'support_nonce', 'security' ) ) {
  
      return wp_send_json_error( 'Invalid security threshold.' );
  
    }
  
    $user_id = get_current_user_id();
  
    $user = get_user_by('id', $user_id);
  
    $user_email = $user->user_email;
  
    $user_name = $user->first_name . $user->last_name;
  
    $support_message = $_REQUEST['support-message'];
  
    $support_subject = $_REQUEST['support-subject'];
  
    // create an email message with the subject, message, user's full name and email address
    $message = "Subject: " . $support_subject . "\n\n" . $support_message . "\n\n" . $user_name . "\n" . $user_email;

    // send the email to support@intermaritime.org
    wp_mail( 'info@intermaritime.org', $support_subject, $message );

    wp_send_json_success( 'Email sent successfully' );

}