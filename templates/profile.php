<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<h1 class="centered-text"><?php the_title(); ?></h1>

<?php	endwhile; endif; wp_reset_query(); ?>

<?php 
  $current_user_id = get_current_user_id();
  $current_user = wp_get_current_user();
  $user_courses = get_my_courses_id($current_user_id);
  $user_country_of_birth = get_field('country_of_birth', 'user_' . $current_user_id);
  $user_nationality = get_field('nationality', 'user_' . $current_user_id);
  $user_passport_id = get_field('passportid_no', 'user_' . $current_user_id);
  $user_date_of_birth = get_field('date_of_birth', 'user_' . $current_user_id);
  $user_date_of_birth = $user_date_of_birth ? DateTime::createFromFormat('Ymd', $user_date_of_birth)->format('j F Y') : '';
?>

<div class="main-container main-padding fill-height">

  <div class="profile-tabs">
  
    <button class="courses-section-button current-tab">
      Completed Courses and Certificates
    </button><button class="profile-section-button">
      Your Details
    </button><button class="password-section-button">
      Change Password
    </button>
  
  </div>
  
  <div class="profile-tabs-body">

    <div class="courses-section current-section main-padding">
    
      <?php 
        $my_courses = get_my_courses($current_user_id);

        $courses_query = new WP_Query(array(
          'post_type' => 'courses',
          'post__in'  => $user_courses
        ));

        if ( $courses_query->have_posts() ) :
          while( $courses_query->have_posts() ) :
            $courses_query->the_post();
            $index = $courses_query->current_post;
            $my_score = $my_courses[$index]['score'];
            $my_course_id = $my_courses[$index]['course']->ID;
      ?>

        <div class="flex-container align-center small-padding">
          <img
            src="<?php 
              if ( passing_score((int)$my_score) ) {
                echo IMAGESPATH . '/check-mark.svg';
              } else {
                echo IMAGESPATH . '/cross-mark.svg';
              }
            ?>"
            alt="Pass/Fail"
            class="small-thumbnail-image"
            title="<?php echo passing_score((int)$my_score) ? "Passed" : "Failed"; ?>"
          >
          <p>
            <?php the_title(); ?>
            &nbsp;
            <?php if ( passing_score((int)$my_score) ) : ?>
              <a href="#0">
                View Certificate
              </a>
            <?php else : ?>
              <a href="<?php echo get_permalink($my_course_id); ?>">
                Take course
              </a>
            <?php endif; ?>
          </p>
        </div>

      <?php
        endwhile;
          else :
            get_template_part( 'templates/no_courses_message'); 
      ?>

      <?php endif; ?>

    </div>
  
    <div class="profile-details-section main-padding">
  
      <form class="profile-details max-width-900 main-grid-container" enctype="multipart/form-data">
      
        <label for="full-name">
          Full Name
          <input
            type="text"
            name="full-name"
            id="full-name"
            value="<?php echo $current_user->first_name . " " . $current_user->last_name; ?>"
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

        <button type="submit">Update Profile Details</button>
      
      </form>
  
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