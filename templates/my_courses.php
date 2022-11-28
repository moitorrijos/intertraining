<div class="main-container main-padding">

  <?php

    $current_user_id = get_current_user_id();
    $current_user = wp_get_current_user();

    $is_student = $current_user->roles[0] === 'student';

    if ($is_student) {
      $my_courses = get_my_courses_id($current_user_id);
    }


    if( have_posts() ) : while( have_posts() ) : the_post();

    the_title('<h1 class="centered-text">', '</h1>');

    endwhile; endif; wp_reset_query();

  ?>


    <p class="centered-container">

      In this section you will find all your course materials and exams. If you don't see the course materials you requested, please contact support at <a href="mailto:info@intermaritime.org">info@intermaritime.org</a> or call us at <a href="tel:+5073220013">+(507) 322-0013</a>

    </p>

  <div class="main-grid-container main-padding">

    <?php

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

    <a class="course-card" href="<?php echo get_permalink() . $latest_position; ?>">

      <div class="course-title">
        
        <h2><?php the_title(); ?></h2>
    
      </div>

      <figure>
      
        <?php if ( has_post_thumbnail() ) : ?>

          <img src="<?php the_post_thumbnail(); ?>" alt="<?php the_title(); ?>">

        <?php else : ?>

          <img src="<?php echo IMAGESPATH; ?>/default-background-pmts-courses-image.jpg" alt="<?php the_title(); ?>">

        <?php endif; ?>
      
      </figure>

    </a>

    <?php endwhile; else : ?>

    <?php get_template_part( 'templates/no_courses_message'); ?>

    <?php endif; ?>

  </div>

  <div class="page-navigation">

    <?php
    
      $big = 999;
      echo paginate_links( array(
          'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
          'format'  => '?paged=%#%',
          'current' => max( 1, get_query_var('paged') ),
          'total'   => $query_courses->max_num_pages
      ) );

      wp_reset_query();
    
    ?>

  </div>

</div>
