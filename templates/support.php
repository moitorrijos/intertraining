<div class="main-container main-padding">

	<?php
	
		if( have_posts() ) : while( have_posts() ) : the_post();

		the_title('<h1 class="centered-text">', '</h1>');

    echo '<div class="centered-container centered-text max-width-400">';
    
		the_content();
    
    echo '</div>';

    get_template_part('templates/contact_form');

		endwhile; else :

		get_template_part('templates/404_message');

		endif; wp_reset_query();

	?>

</div>
