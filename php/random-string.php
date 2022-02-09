<?php

# Random number function

function rand_string( $length ) {
		$chars = "0123456789abcdefghijklmnopqrstuvwxyz";	
		
		$size = strlen( $chars );

		for( $i = 0; $i < $length; $i++ ) {
    		$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		
		return $str;
	}

#$code = rand_string( 35 );

?>
