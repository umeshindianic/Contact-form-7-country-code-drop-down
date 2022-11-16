<?php
/**
 * Add country code with phone tag value in mail
 */
add_filter( 'wpcf7_special_mail_tags', 'iNic_CF_CC_country_code_mail_tags', 10, 3 );
function iNic_CF_CC_country_code_mail_tags( $output, $name, $html ) {
	if ( iNic_CF_CC_country_code_ends_with($name, '-cf7it-national') ):
		return iNic_CF_CC_country_code_recover_field( $name );
        endif;
	if ( iNic_CF_CC_country_code_ends_with($name, '-cf7it-country-code') ):
		return iNic_CF_CC_country_code_recover_field( $name );
        endif;
	if( iNic_CF_CC_country_code_ends_with($name, '-cf7it-country-name') ):
		return iNic_CF_CC_country_code_recover_field( $name );
	endif;
	if( iNic_CF_CC_country_code_ends_with($name, '-cf7it-country-iso2') ):
		return iNic_CF_CC_country_code_recover_field( $name );
	endif;
	return $output;
}

function iNic_CF_CC_country_code_recover_field ($name){
	$value = isset( $_POST[$name] )? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) ) : '';
	return $value;
}

function iNic_CF_CC_country_code_ends_with ($content, $token){
	$length = strlen($token);
	return substr($content, -1*$length) == $token;
}
?>