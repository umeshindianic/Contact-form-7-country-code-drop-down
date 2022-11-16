<?php
/**
 *  Contact form 7 add country code drop-down in front-end side form
 */

/**
 * Initialize function for front-end side
 */
add_action( 'wpcf7_init', 'iNic_CF_CC_add_formtag_country_code' );
function iNic_CF_CC_add_formtag_country_code() {
	wpcf7_add_form_tag(
		array( 'country-code', 'country-code*' ),
		'iNic_CF_CC_country_code_formtag_handler', true);
}

/**
 * To display country code dropdown in form front-end side
 */
function iNic_CF_CC_country_code_formtag_handler ( $iNic_CF_CC_tag ){
    
    $iNic_CF_CC_tag = new WPCF7_FormTag( $iNic_CF_CC_tag );

	if ( empty( $iNic_CF_CC_tag->name ) )
		return '';
		
	
    iNic_CF_CC_country_code_add_static_files();
    
	$validation_error = wpcf7_get_validation_error( $iNic_CF_CC_tag->name );

	$class = wpcf7_form_controls_class( $iNic_CF_CC_tag->type, 'wpcf7-country-code' );

	if ( $validation_error )
		$class .= ' wpcf7-not-valid';

	$atts = array();
	
	$atts['class'] = $iNic_CF_CC_tag->get_class_option( $class );
	$atts['id'] = $iNic_CF_CC_tag->get_id_option();
	if ( $iNic_CF_CC_tag->has_option( 'readonly' ) ):
		$atts['readonly'] = 'readonly';
	endif;
	if ( $iNic_CF_CC_tag->is_required() ):
		$atts['aria-required'] = 'true';
	endif;
	$atts['aria-invalid'] = $validation_error ? 'true' : 'false';

	$value = (string) reset( $iNic_CF_CC_tag->values );

	if ( $iNic_CF_CC_tag->has_option( 'placeholder' ) || $iNic_CF_CC_tag->has_option( 'watermark' ) ) {
		$atts['placeholder'] = $value;
		$value = '';
	}
	if ( $iNic_CF_CC_tag->has_option( 'size' ) ):
		$atts['size'] = $iNic_CF_CC_tag->get_option('size', '', true);
	endif;
	if ($iNic_CF_CC_tag->has_option('initialCountry')) :
		$atts['data-initialcountry'] = $iNic_CF_CC_tag->get_option('initialCountry', '', true);
	endif;
	if ( $iNic_CF_CC_tag->has_option( 'preferredCountries' ) ):
		$atts['data-preferredcountries'] = $iNic_CF_CC_tag->get_option('preferredCountries', '', true);
	endif;
	if ( $iNic_CF_CC_tag->has_option( 'lookup-key' ) ):
		$atts['data-lookup-key'] = $iNic_CF_CC_tag->get_option('lookup-key', '', true);
	endif;	

	$value = $iNic_CF_CC_tag->get_default_option($value);
	$value = wpcf7_get_hangover( $iNic_CF_CC_tag->name, $value );

	$atts['value'] = $value;
	$atts['type'] = 'tel';
	$atts['name'] = $iNic_CF_CC_tag->name . '-cf7it-national';

	$atts_hidden=array();
	$atts_hidden['name'] = $iNic_CF_CC_tag->name;
	$atts_hidden['type'] = 'hidden';
	$atts_hidden['class'] = 'wpcf7-country-code-full';
	
	$atts_country=array();
	$atts_country['type'] = 'hidden';
	$atts_country['name'] = $iNic_CF_CC_tag->name . '-cf7it-country-name';
	$atts_country['class'] = 'wpcf7-country-code-country-name';
	
	$atts_country_code=array();
	$atts_country_code['type'] = 'hidden';
	$atts_country_code['name'] = $iNic_CF_CC_tag->name . '-cf7it-country-code';
	$atts_country_code['class'] = 'wpcf7-country-code-country-code';
	
	$atts_country_iso=array();
	$atts_country_iso['type'] = 'hidden';
	$atts_country_iso['name'] = $iNic_CF_CC_tag->name . '-cf7it-country-iso2';
	$atts_country_iso['class'] = 'wpcf7-country-code-country-iso2';

	$atts = wpcf7_format_atts( $atts );
	$atts_hidden = wpcf7_format_atts( $atts_hidden );
	$atts_country = wpcf7_format_atts( $atts_country );
	$atts_country_code = wpcf7_format_atts( $atts_country_code );
	$atts_country_iso= wpcf7_format_atts( $atts_country_iso);

	$html = sprintf(
		'<span class="wpcf7-form-control-wrap %1$s"><input %2$s /><input %3$s /><input %5$s /><input %6$s /><input %7$s />%4$s</span>',
		sanitize_html_class( $iNic_CF_CC_tag->name ), $atts, $atts_hidden, $validation_error, $atts_country, $atts_country_code, $atts_country_iso );

	return $html;
}

/**
 * Add javscript and css files for country code dropdown.
 */
function iNic_CF_CC_country_code_add_static_files(){
	$min='.min';
	if( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) {
		$min='';
	}
  
    wp_enqueue_script( 'iNic-CF-CC-intlTelInput-js', INIC_CF_CC_PUBLIC_URL . '/js/intlTelInput'.$min .'.js', array('jquery') );
    wp_enqueue_style( 'iNic-CF-CC-css', INIC_CF_CC_PUBLIC_URL . '/css/intlTelInput'. $min .'.css');
    wp_enqueue_script( 'iNic-CF-CC-script-js', INIC_CF_CC_PUBLIC_URL . '/js/script' . $min . '.js', array('jquery','iNic-CF-CC-intlTelInput-js'));
    wp_localize_script( 'iNic-CF-CC-script-js', 'wpcf7_utils_url', INIC_CF_CC_PUBLIC_URL . '/js/utils-new.js' );
}

/**
 * Filter for the country code dropdown phone number validation
 */
add_filter( 'wpcf7_validate_country_code', 'iNic_CF_CC_country_code_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_country_code*', 'iNic_CF_CC_country_code_validation_filter', 10, 2 );

function iNic_CF_CC_country_code_validation_filter( $result, $iNic_CF_CC_tag ) {
	$iNic_CF_CC_tag = new WPCF7_FormTag( $iNic_CF_CC_tag );

	$name = $iNic_CF_CC_tag->name;

	$value = isset( $_POST[$name] )? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) ) : '';
		
	if ( $iNic_CF_CC_tag->is_required() && '' == $value ) {
	    $result->invalidate( $iNic_CF_CC_tag, wpcf7_get_message( 'invalid_required' ) );
	}
    elseif ( '' != $value && ! wpcf7_is_tel( $value ) ) {
        $result->invalidate( $iNic_CF_CC_tag, wpcf7_get_message( 'invalid_tel' ) );
	}
	
	return $result;
}
?>