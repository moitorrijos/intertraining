<?php get_header(); ?>

<div class="main-container main-padding fill-height">

	<h1 class="centered-text">Search Results</h1>

  <div class="main-grid-container main-padding">

    <?php

			global $query_string;

			wp_parse_str( $query_string, $search_query );

			$search = new WP_Query( $search_query );

      if ( $search->have_posts() ) :
        
        while( $search->have_posts() ) :
          
          $search->the_post();
    
    ?>

    <a class="course-card" href="<?php the_permalink(); ?>">

      <div class="course-title">
        
        <p><?php the_title(); ?></p>
    
      </div>

      <figure>
      
        <?php if ( has_post_thumbnail() ) : ?>

          <img src="<?php the_post_thumbnail(); ?>" alt="<?php the_title(); ?>">

        <?php else : ?>

          <img src="<?php echo IMAGESPATH; ?>/default-background-pmts-courses-image.jpg" alt="<?php the_title(); ?>">

        <?php endif; ?>
      
      </figure>

      <h2 class="course-abbr"><?php the_field('abbr'); ?></h2>
      
    </a>

    <?php endwhile; else : ?>

    <p class="centered-container">

      The course you are looking for is not available. Check the spelling and try again.

    </p>

    <?php endif; ?>

  </div>

</div>

<?php get_footer(); ?>