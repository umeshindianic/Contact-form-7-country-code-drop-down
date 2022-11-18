<?php
/**
 * Add country code with phone tag value in mail
 */
add_filter( 'wpcf7_special_mail_tags', 'cf7_cc_country_code_mail_tags', 10, 3 );
function cf7_cc_country_code_mail_tags( $output, $name, $html ) {
	if ( cf7_cc_country_code_ends_with($name, '-cf7-cc-national') ):
		return cf7_cc_country_code_recover_field( $name );
        endif;
	if ( cf7_cc_country_code_ends_with($name, '-cf7-cc-country-code') ):
		return cf7_cc_country_code_recover_field( $name );
        endif;
	if( cf7_cc_country_code_ends_with($name, '-cf7-cc-country-name') ):
		return cf7_cc_country_code_recover_field( $name );
	endif;
	if( cf7_cc_country_code_ends_with($name, '-cf7-cc-country-iso2') ):
		return cf7_cc_country_code_recover_field( $name );
	endif;
	return $output;
}

function cf7_cc_country_code_recover_field ($name){
	$value = isset( $_POST[$name] )? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) ) : '';
	return $value;
}

function cf7_cc_country_code_ends_with ($content, $token){
	$length = strlen($token);
	return substr($content, -1*$length) == $token;
}
?>