<button class="not-for-print primary-button centered-container flex-container align-items-center" id="save2pdf">
  <img class="icon" src="<?php echo IMAGESPATH . "/download-pdf.svg"; ?>" alt="Save as PDF" />
  Download Certificate
</button>
<div class="certificate-page">
  <h2 class="text-centered">Certificate of Completion</h2>
  <p class="text-centered">This is to certify that</p>
  <h1 class="text-centered">
    <?php echo wp_get_current_user()->first_name . ' ' . wp_get_current_user()->last_name; ?>
  </h1>
  <hr>
  <p>
    Successfully completed the training modules per Appendix 2 of the RO Code, following IMO Resolutions MSC.349(92) and MEPC.237(65), on Survey & Certification functions for Recognized Organizations acting on behalf of the Flag State.
  </p>
  <table class="certificate-content">
    <thead>
      <tr>
        <th>Code: Description</th>
        <th>Completed</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // $user_id = get_current_user_id();
        // if (have_rows('courses', 'user_' . $user_id)) :
        //   while (have_rows('courses', 'user_' . $user_id)) : the_row();
        //     $course = get_sub_field('course_name');
        //     $exam_score = get_sub_field('exam_score');
        //     if (passing_score($exam_score)) :
        $courses_query_args = array(
        'post_type'       => 'courses',
        'posts_per_page'  => 12,
        'paged'           => get_query_var( 'paged' )
      );

      if ($is_student) {
        $courses_query_args['post__in'] = $my_courses;
      }

      $query_courses = new WP_Query( $courses_query_args );

      if ( $query_courses->have_posts() ) :
        
        while( $query_courses->have_posts() ) :
          
          $query_courses->the_post();

          $latest_position = get_post_meta( get_the_ID(), 'latest_position', true );
        
      ?>
        <tr>
          <td>
            <?php // echo $course->post_title; ?>
            <?php the_title(); ?>
          </td>
          <td>
            <img
              src="<?php echo IMAGESPATH . '/checking-square.png'; ?>"
              alt="Checkmark"
            >
          </td>
        </tr>
      <?php 
        // endif; 
        endwhile; 
        endif; 
        wp_reset_postdata();
      ?>
    </tbody>
  </table>
  <div class="issue-date">
    <p>
      This certificate is issued by InterMaritime Certification Services Online Surveyor's Training Platform on:
    </p>
  </div>
  <div class="signature-seal">
      <div class="signature">
        <hr>
        <p>
          <strong>Eng. José Perez Samper</strong><br>
          <small>Principal Surveyor/Trainer</small><br>
        </p>
      </div>
      <img class="sello" src="<?php echo IMAGESPATH . '/icsclass-logo-sello.png'; ?>" alt="Sello seco ICSClass">
  </div>
</div>