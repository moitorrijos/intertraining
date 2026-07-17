<button class="not-for-print primary-button centered-container flex-container align-items-center" id="save2pdf">
  <img class="icon" src="<?php echo IMAGESPATH . "/download-pdf.svg"; ?>" alt="Save as PDF" />
  Download Certificate
</button>
<div class="certificate-page">
  <table class="certificate-header">
    <tr>
      <td>PE02-P02/R3</td>
      <td>Training and Continuing Professional Development (CPD) Log for Surveyors and Auditors.</td>
      <td>Version 03</td>
    </tr>
  </table>
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
        <th>Date of completion:</th>
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
            <?php 
              echo $course->post_title; 
            ?>
          </td>
          <td class="centered-text">
            <?php 
              $completion_date = get_sub_field('date_of_completion');
              if ($completion_date) {
                $completion_date = date_i18n('F j, Y', strtotime($completion_date));
              } else {
                $completion_date = date_create_from_format('Ymd', '20250625')->format('F j, Y');
              }
              echo $completion_date;
            ?>
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
  <div class="certificate-footer">
  <div class="issue-date">
    <p>
      This certificate is issued by
    </p>
  </div>
  <div class="signature-seal">
      <div class="signature">
        <img src="<?php echo IMAGESPATH . '/firma-samper.png'; ?>" alt="">
        <hr>
        <p>
          <strong>Eng. José Perez Samper</strong><br>
          <small>Principal Surveyor/Trainer</small><br>
        </p>
      </div>
      <div class="signature">
      <img src="<?php echo IMAGESPATH . '/firma-jorge-luis.png'; ?>" alt="">
        <hr>
        <p>
          <strong>Eng. Jorge Luis Lopez Ramos</strong><br>
          <small>Senior Surveyor/Trainer</small><br>
        </p>
      </div>
      <div class="signature">
        <img src="<?php echo IMAGESPATH . '/firma-ruben-salcedo.png'; ?>" alt="">
        <hr>
        <p>
          <strong>Eng. Ruben Salcedo</strong><br>
          <small>Operations Manager/Trainer</small><br>
        </p>
      </div>
      <img class="sello" src="<?php echo IMAGESPATH . '/icsclass-logo-sello.png'; ?>" alt="Sello seco ICSClass">
    </div>
    <div class="contact-info">
      <p class="contact-info">
        To verify this certificate please contact ICSClass Head Office at <a href="mailto:info@intermaritime.org">info@intermaritime.org</a> or to <a href="mailto:ruben@intermaritime.org">ruben@intermaritime.org</a>.
      </p>
    </div>
  </div>
</div>