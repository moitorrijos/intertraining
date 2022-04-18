<?php

get_header();

$back = wp_get_referer();

?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<header class="course-header" data-post-id="<?php echo get_the_ID(); ?>">

  <a
    href="<?php echo $back ? $back : get_permalink( 51118 ); ?>"
    class="back-button"
  >
  
    &laquo; Back to My Courses
  
  </a>

</header>

<div class="course-container">

  <nav class="course-navigation">

    <a href="#description" class="current-section">

      <i class="fas fa-info-circle"></i>
      
      Course Description
    
    </a>
  
    <?php if ( have_rows('course_material') ) :
      
      while( have_rows('course_material') ) : 
      
        the_row(); ?>

        <a href="<?php echo '#' . the_slug_sub_field('course_section_title'); ?>">

          <?php the_sub_field('icons'); ?>
        
          <?php the_sub_field('course_section_title'); ?>
        
        </a>

    <?php endwhile; endif; ?>

    <a href="#exam-questions">
    
      <i class="fa fa-pencil-alt"></i>

      Exam
    
    </a>

    <a href="#competences">

      <i class="fa fa-user-tie"></i>
    
      Competences Obtained on Board

    </a>
  
  </nav>

  <div class="course-section">
	
    <?php the_title('<h1>', '</h1>'); ?>

    <?php 

      if ( is_array( get_field('course_material') ) ) {

        $count = count( get_field('course_material') );
        
      } else {

        $count = 0;

      }

    ?>

    <section id="description">
    
      <h2>Course Description</h2>

      <?php the_field('course_description'); ?>

      <?php if ( $count >= 1 ) : ?>

        <div class="buttons">
        
          <button class="next-section">

            Next Section &raquo;

          </button>

        </div>

      <?php endif; ?>
    
    </section>

    <?php

      if ( have_rows('course_material') ) :
      
        while( have_rows('course_material') ) : 
      
          the_row(); 
          
          $row_index = get_row_index();

    ?>

      <section id="<?php echo the_slug_sub_field('course_section_title'); ?>">

        <?php the_sub_field('course_section'); ?>

        <div class="buttons">

          <button class="prev-section">

            &laquo; Previous Section

          </button>

          <?php if ($row_index < $count ) : ?>

            <button class="next-section"> 

              Next Section &raquo;

            </button>

          <?php endif; ?>

          <?php if ($row_index === $count ) : ?>

            <a class="secondary-button next-section" href="#exam-questions">

              Start Exam &raquo;

            </a>

          <?php endif; ?>

        </div>
      
      </section>

    <?php endwhile; endif; ?>

    <section id="exam-questions">
    
      <?php if ( have_rows('theorical_exam_questions') ) : ?>

      <h2>Exam Questions</h2>

      <?php

        while( have_rows('theorical_exam_questions') ) :

          the_row(); 
          
            if ( get_row_layout() === 'best_answer' ) :

          ?>

          <!-- Add table for best answer with radio button -->
          <h3><?php echo get_row_index() . '. ' . get_sub_field( 'question_text' ); ?></h3>

          <div class="choices">
          
            <?php for ($i = 1; $i <= 4; $i++) : ?>

              <p class="checkbox-grid">

                <input
                  type="radio"
                  name="best_choice_<?php echo get_row_index(); ?>"
                  value="choice_<?php echo $i; ?>"
                  id="choice_<?php echo get_row_index() . '_' . $i; ?>"
                >

                <label for="choice_<?php echo get_row_index() . '_' . $i; ?>">

                  <?php the_sub_field('choice_' . $i); ?>

                </label>

              </p>

            <?php endfor; ?>
          
          </div>

          <?php elseif ( get_row_layout() === 'fill_in_the_blank' ) : ?>
          
          <h2>Fill in the Blank</h2>

          <?php elseif ( get_row_layout() === 'essay_question' ) : ?>

          <h2>Essay Question</h2>

          <?php endif; ?>

      <?php endwhile; endif; ?>

      <button class="secondary-button submit-answers">
      
        Submit Answers
      
      </button>
    
    </section>

    <section id="competences">

        <?php
          $current_user_id = get_current_user_id();
          $current_user = wp_get_current_user();
          $user_courses = get_field('courses_taken', 'user_' . $current_user_id);
          $user_country_of_birth = get_field('country_of_birth', 'user_' . $current_user_id);
          $user_nationality = get_field('nationality', 'user_' . $current_user_id);
          $user_passport_id = get_field('passportid_no', 'user_' . $current_user_id);
          $user_date_of_birth = get_field('date_of_birth', 'user_' . $current_user_id);
          $user_date_of_birth = $user_date_of_birth ? DateTime::createFromFormat('Ymd', $user_date_of_birth)->format('j F Y') : '';
        ?>
    
        <h3>Declaration on Competences Obtained on Board</h3>

        <p>
            I, <span class="undies"><?php echo $current_user->first_name; ?></span> with identification No. <span class="undies"><?php echo $user_passport_id; ?></span>, of <span class="undies"><?php echo $user_nationality; ?></span> nationality, and currently holding the License of <span class="undies">Panama</span>, with full use of my practical, theoretical and technical knowledge, I declare, the following skills, I have acquired both in courses and work done on land and on board.
        <p>

        <?php

          if ( have_rows('competence') ) : 

            while ( have_rows('competence') ) :

              the_row();

              $competence_section = get_sub_field('competence_section'); 

        ?>

          <h3><?php echo $competence_section['competence_section_title']; ?></h3>

          <p><?php echo $competence_section['competence_description']; ?></p>

          <?php

            $competence_section_list = $competence_section['competence_section_list'];


            if ( is_array( $competence_section_list ) ) :

          ?>
            
              <?php

                  foreach ( $competence_section_list as $competence ) :
                
              ?>

                <p class="checkbox-grid">
                  <input type="checkbox" name="competence" id="competence" checked="<?php echo $competence['checked']; ?>">
                  <label for="competence">
                    <?php echo $competence['competence']; ?>
                  </label>
                </p>

              <?php endforeach; ?>
            
          <?php endif; ?>

        <?php endwhile; endif; ?>

    </section>

  </div>

</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>