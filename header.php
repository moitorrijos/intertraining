<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >

<?php if ( (!is_front_page() && !is_singular('courses')) && is_user_logged_in() ) : ?>

<div class="top-bar flex-container align-items-center main-container">
  <h2>InterMaritime Surveyor's Training</h2>
  <p>
    <a href="tel:+5073220013">
      <i class="fa fa-phone"></i>
      +(507) 322-0013
    </a>
    &nbsp;
    <a href="mailto:info@intermaritime.org">
      <i class="fa fa-envelope"></i>
      info@intermaritime.org
    </a>
  </p>
</div>

<?php get_template_part( 'templates/navigation' ); ?>

<div class="top-image"></div>

<?php endif; ?>