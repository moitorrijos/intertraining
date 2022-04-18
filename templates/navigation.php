<?php 
	$signout_fa = '<i class="fa fa-sign-out"></i>';
	$user_fa = '<i class="fa fa-user"></i>';
	$current_user = wp_get_current_user();
?>

<header>

  <div class="main-container search-navigation">
  
    <div class="logo">
      <?php echo get_custom_logo(); ?>
    </div>
  
    <div class="search-form">
  
      <?php get_search_form(); ?>
  
    </div>
  
    <div class="navigation">
  
        <?php
          $args = array(
            'theme_location' => 'menu-1',
            'container' => false,
            'menu_class' => 'nav'
          );
  
          wp_nav_menu( $args );
        ?>
  
    </div>
  
  </div>

</header>