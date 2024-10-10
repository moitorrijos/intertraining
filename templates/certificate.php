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
    Has satisfactorily completed the following training modules based on the Appendix 2 - Specifications on the Survey & Certification functions of Recognized Organizations acting on behalf of the Flag State, established by the Code for Recognized Organizations (RO Code), according to IMO Resolutions MSC.349(92) and MEPC.237 (65):
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
        $user_id = get_current_user_id();
        if (have_rows('courses', 'user_' . $user_id)) :
          while (have_rows('courses', 'user_' . $user_id)) : the_row();
            $course = get_sub_field('course_name');
            $exam_score = get_sub_field('exam_score');
            if (passing_score($exam_score)) :
        
      ?>
        <tr>
          <td>
            <?php echo $course->post_title; ?>
          </td>
          <td>
            <img
              src="<?php echo IMAGESPATH . '/checking-square.png'; ?>"
              alt="Checkmark"
            >
          </td>
        </tr>
      <?php 
        endif; 
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
          <small>Principal Surveyor</small><br>
          <small>Trainer</small>
        </p>
      </div>
      <img class="sello" src="<?php echo IMAGESPATH . '/icsclass-logo-sello.png'; ?>" alt="Sello seco ICSClass">
  </div>
</div>