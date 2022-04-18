<?php

if ( !current_user_can( 'administrator' ) ) :

	show_admin_bar(false);

endif;
