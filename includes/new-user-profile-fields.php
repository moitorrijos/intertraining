<?php

add_action( 'edit_user_profile', 'pmtsc_new_profile_fields' );
add_action( 'user_new_form', 'pmtsc_new_profile_fields' );

function pmtsc_new_profile_fields( $user ) {
	
	$current_screen = get_current_screen()->base;
	
	if ($current_screen == 'user-edit') :
		$active_user_form = get_the_author_meta( 'pmtsc_form', $user->ID );
	endif;

?>
	<table class="form-table">
	    <tr>
			<th scope="row"><?php _e( 'Courses User Can See' ) ?></th>
			<td>
				<input type="text" size="50" id="course_filter" name="course_filter" class="course_filter" placeholder="Filter Courses" class="input" aria-required="true" aria-describedby="course_filter">
				<?php 
					$pmtsc_courses_args_no_offset = array(
						'post_type' => 'courses',
						'posts_per_page' => -1,
					);
					$pmtsc_courses = new WP_Query ( $pmtsc_courses_args_no_offset );
					if ( $pmtsc_courses->have_posts() ) : while ( $pmtsc_courses->have_posts() ) : $pmtsc_courses->the_post();
				?>
					<label class="user-course-label">
						<input 
							type="checkbox" 
							name="pmtsc_form[]" 
							value="<?php echo basename(get_permalink()); ?>"
							<?php 
								if ( $current_screen == 'user-edit' ) :
									if ( $active_user_form ) :
										if ( in_array( basename(get_permalink()), $active_user_form ) )  :
											echo 'checked';
										endif;
									endif;
								endif;
							 ?>
						>
						<p class="user-course"><?php the_title(); ?></p>
					</label>
					<br />
				<?php endwhile; endif; wp_reset_query(); ?>
			</td>
		</tr>	
	</table>
<?php
}

add_action( 'edit_user_profile_update', 'pmtsc_courses_save_extra_user_profile_fields' );
add_action( 'user_register', 'pmtsc_courses_save_extra_user_profile_fields' );

function pmtsc_courses_save_extra_user_profile_fields( $user_id ) {

  if ( current_user_can( 'edit_user', $user_id ) ) {
    update_user_meta( $user_id, 'pmtsc_form', $_POST['pmtsc_form'] );

  }

}