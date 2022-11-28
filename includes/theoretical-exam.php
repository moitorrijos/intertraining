<?php

add_action( 'wp_ajax_theoretical_exam', 'theoretical_exam' );

function theoretical_exam() {

  if ( !check_ajax_referer( 'course_nonce', 'security' ) ) {

    return wp_send_json_error( 'Invalid security threshold.' );

  }

  // TODO: return json response with data
  $exam = $_REQUEST;
  $user_id = get_current_user_id();
  $exam_course_id = (int) $exam['course_id'];
  $my_courses = [];
  while (have_rows('courses', 'user_' . $user_id)) {
    the_row();
    $my_courses[] = get_sub_field('course_name');
  }
  // filter my courses to get the one that matches the course id
  $my_course = array_filter($my_courses, function($course) use ($exam_course_id) {
    return $course->ID === $exam_course_id;
  });

  $row = array_key_first($my_course);
  $my_course_id = $my_course[$row]->ID;
  $correct_answers = [];

  // get the theoretical_exam_field from the course with id = $my_course_id
  if (have_rows('theorical_exam_questions', $my_course_id)) {
    while (have_rows('theorical_exam_questions', $my_course_id)) {
      the_row();
      if (get_row_layout() == 'best_answer') {
        $correct_answers[] = get_sub_field('correct_answer');
      } else if (get_row_layout() == 'true_or_false') {
        $correct_answers[] = get_sub_field('correct_answer');
      }
    }
  }

  $my_answers = array_splice($exam, 0, -3);
  $my_answers = array_values($my_answers);

  update_sub_field(
    array('courses', $row+1, 'exam_answers'),
    json_encode($my_answers),
    'user_' . $user_id
  );
  
  $score = 0;
  for ($i = 0; $i < count($correct_answers); $i++) {
    if ($correct_answers[$i] === $my_answers[$i]) {
      $score++;
    }
  }
  $score = $score / count($correct_answers) * 100;

  update_sub_field(
    array('courses', $row+1, 'exam_score'),
    round($score),
    'user_' . $user_id
  );

  wp_send_json(array(
    'message'  => 'Saved'
  ));

  wp_die();

}

