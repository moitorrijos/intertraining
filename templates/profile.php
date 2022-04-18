<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<h1 class="centered-text"><?php the_title(); ?></h1>

<?php	endwhile; endif; wp_reset_query(); ?>

<?php 
  $current_user_id = get_current_user_id();
  $current_user = wp_get_current_user();
  $user_courses = get_field('courses_taken', 'user_' . $current_user_id);
  $user_country_of_birth = get_field('country_of_birth', 'user_' . $current_user_id);
  $user_nationality = get_field('nationality', 'user_' . $current_user_id);
  $user_passport_id = get_field('passportid_no', 'user_' . $current_user_id);
  $user_date_of_birth = get_field('date_of_birth', 'user_' . $current_user_id);
  $user_date_of_birth = $user_date_of_birth ? DateTime::createFromFormat('Ymd', $user_date_of_birth)->format('j F Y') : '';
  $user_passport_file = get_field('passport-id', 'user_' . $current_user_id);
  $user_company_letter = get_field('company_letter', 'user_' . $current_user_id);
  $user_panama_license = get_field('panama_license', 'user_' . $current_user_id);
?>

<div class="main-container main-padding fill-height">

  <div class="profile-tabs">
  
    <button class="profile-section-button current-tab">
      Profile Details
    </button><button class="courses-section-button">
      Completed Courses and Certificates
    </button><button class="password-section-button">
      Change Password
    </button>
  
  </div>
  
  <div class="profile-tabs-body">
  
    <div class="profile-details-section current-section main-padding">
  
      <form class="profile-details max-width-900 main-grid-container" enctype="multipart/form-data">
      
        <label for="full-name">
          Full Name
          <input
            type="text"
            name="full-name"
            id="full-name"
            value="<?php echo $current_user->first_name; ?>"
          >
        </label>

        <label for="passport-id">
          Passport/ID
          <input
            type="text"
            name="passport-id"
            id="passport-id"
            value="<?php echo $user_passport_id; ?>"
          >
        </label>

        <label for="country-of-birth">
          Country of birth
          <input
            type="text"
            name="country-of-birth"
            id="country-of-birth"
            value="<?php echo $user_country_of_birth; ?>"
          >
        </label>

        <label for="Nationality">
          Nationality
          <input
            type="text"
            name="nationality"
            id="nationality"
            value="<?php echo $user_nationality; ?>"
          >
        </label>

        <label for="date-of-birth">
          Date of Birth
          <input
            type="text"
            name="date-of-birth"
            id="date-of-birth"
            value="<?php echo $user_date_of_birth; ?>"
          >
        </label>
        
        <label for="upload-passport">
          <?php if ($user_passport_id) : ?>
            ID or Passport
            <a
              href="<?php echo $user_passport_file['url']; ?>"
              target="_blank"
              rel="noopener noreferrer"
              class="flex-container align-items-center small-padding"
            >
              <img
                class="thumbnail-image"
                src="<?php echo IMAGESPATH . '/default.svg'; ?>"
                alt="default file"
              >
              <?php echo $user_passport_file['filename']; ?>
            </a>
          <?php else : ?>
            Upload ID or Passport
            <input
              type="file"
              id="upload-passport"
              name="upload-passport"
              accept=".jpg,.jpeg,.png,.pdf"
            >
          <?php endif; ?>
        </label>

        <label for="upload-company-letter">
          Company Letter
          <?php if ($user_company_letter) : ?>
            <a
              href="<?php echo $user_company_letter['url']; ?>"
              target="_blank"
              rel="noopener noreferrer"
              class="flex-container align-items-center small-padding"
            >
              <img
                class="thumbnail-image"
                src="<?php echo IMAGESPATH . '/default.svg'; ?>"
                alt="default file"
              >
              <?php echo $user_company_letter['filename']; ?>
            </a>
          <?php else : ?>
            Upload Company Letter
            <input
              type="file"
              name="upload-company-letter"
              id="upload-company-letter"
              accept=".jpg,.jpeg,.png,.pdf"
            >
          <?php endif; ?>
        </label>

        <label for="upload-license">
          Upload License
          <input
            type="file"
            name="upload-license"
            id="upload-license"
            accept=".jpg,.jpeg,.png,.pdf"
          >
        </label>

        <button type="submit">Update Profile Details</button>
      
      </form>
  
    </div>
  
    <div class="courses-section main-padding">
  
      <?php 
        $courses_query = new WP_Query(array(
          'post_type' => 'courses',
          'post__in'  => $user_courses
        ));

        if ( $courses_query->have_posts() ) :
          while( $courses_query->have_posts() ) :
            $courses_query->the_post();
      ?>

            <div class="flex-container align-center small-padding">
              <img
                src="<?php echo IMAGESPATH . '/check-mark.svg'; ?>"
                alt="Checkmark"
                class="small-thumbnail-image"
              >
              <p>
                <?php the_title(); ?>
                &nbsp;
                <a href="#0">
                  View Certificate
                  <i class="fa fa-external-link-alt"></i>
                </a>
              </p>
            </div>

      <?php
        endwhile;
          else :
            get_template_part( 'templates/no_courses_message'); 
      ?>

      <?php endif; ?>
  
    </div>
  
    <div class="change-password-section main-padding">
  
      <form class="change-password max-width-400 one-column-margin">
      
        <label for="change-password">
          New Password
          <input type="password" name="change-password" id="change-password">
        </label>

        <label for="change-password-confirmation">
          Confirm Password
          <input
            type="password"
            name="change-password-confirmation"
            id="change-password-confirmation"
          >
        </label>

        <button type="submit">Change Password</button>
      
      </form>
  
    </div>
  
  </div>

</div>