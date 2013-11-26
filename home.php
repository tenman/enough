<?php

		locate_template( array('functions.php' ),true,true );

			if ( $home_template == 'image' or
				 $home_template == 'gallery' or	
				 $home_template == 'link' or	
				 $home_template == 'chat' or	
				 $home_template == 'quote' or	
				 $home_template == 'status' or	
				 $home_template == 'video') {
				 
				get_template_part( 'approach','format' );
			
			}else{
				get_template_part( 'approach', $home_template );
			}
?>