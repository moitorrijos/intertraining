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
      
      <?php the_field('course_description_title'); ?>
    
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
    
      <h2><?php the_field('course_description_title'); ?></h2>

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

      <form id="theoretical-exam">

        <?php

          while( have_rows('theorical_exam_questions') ) :

            the_row(); 

            if ( get_row_layout() === 'best_answer' ) :

            ?>

              <h3><?php echo get_row_index() . '. ' . get_sub_field( 'question_text' ); ?></h3>

                <?php for ($i = 1; $i <= 7; $i++) : ?>

                  <?php if (get_sub_field('choice_' . $i)) : ?>

                    <p class="checkbox-grid <?php echo 'checkbox-' . $i;?>">

                      <input
                        type="radio"
                        name="question_<?php echo get_row_index(); ?>"
                        value="choice_<?php echo $i; ?>"
                        id="selected_choice_<?php echo get_row_index() . '_' . $i; ?>"
                        required
                      >

                      <label for="selected_choice_<?php echo get_row_index() . '_' . $i; ?>">

                        <?php the_sub_field('choice_' . $i); ?>

                      </label>

                    </p>

                  <?php endif; ?>

                <?php endfor; ?>
              
            <?php elseif ( get_row_layout() === 'true_or_false' ) : ?>
            
              <h3><?php echo get_row_index() . '. ' . get_sub_field( 'question' );  ?></h3>

              <p class="checkbox-grid checkbox-1">

                <input
                  type="radio"
                  name="true_false_<?php echo get_row_index(); ?>"
                  value="true"
                  id="true_false_<?php echo get_row_index() . '_' . $i; ?>"
                  required
                >

                <label for="true_false_<?php echo get_row_index() . '_' . $i; ?>">

                  True

                </label>

              </p>

              <p class="checkbox-grid checkbox-2">

                <input
                  type="radio"
                  name="true_false_<?php echo get_row_index(); ?>"
                  value="false"
                  id="true_false_<?php echo get_row_index() . '_' . $i; ?>"
                  required
                >

                <label for="true_false_<?php echo get_row_index() . '_' . $i; ?>">

                  False

                </label>

              </p>
            <?php endif; ?>

        <?php endwhile; endif; ?>
        
        <?php
          $user_id = get_current_user_id();
          $course_id = get_the_ID();
          $course_submitted = is_course_submitted( $user_id, $course_id );
        ?>
        <?php if (!$course_submitted) : ?>
          <button class="secondary-button submit-answers">
            Submit Answers
          </button>
        <?php else : ?>
          <p class="submitted-message">
            You have already submitted your answers for this course.
            <a href="<?php echo get_permalink(51127); ?>">Get Certificate</a>
          </p>
        <?php endif; ?>
      </form>
    
    </section>

  </div>

</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>