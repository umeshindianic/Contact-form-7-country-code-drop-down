<?php
/**
 *  Contact form 7 add country code drop-down in front-end side form
 */

/**
 * Initialize function for front-end side
 *
 * @since    	1.0.0
 * @param      	string    $plugin_name       		Contact form 7 country code drop down.
 * @param      	string    $version    				1.0.0.
 */
add_action( 'wpcf7_init', 'cf7_cc_add_formtag_country_code' );
function cf7_cc_add_formtag_country_code() {
	wpcf7_add_form_tag(
		array( 'country-code', 'country-code*' ),
		'cf7_cc_country_code_formtag_handler', true);
}

/**
 * To display country code dropdown in form front-end side
 *
 * @since    	1.0.0
 * @param      	string    $plugin_name       		Contact form 7 country code drop down.
 * @param      	string    $version    				1.0.0.
 */
function cf7_cc_country_code_formtag_handler ( $cf7_cc_tag ){
    
    $cf7_cc_tag = new WPCF7_FormTag( $cf7_cc_tag );

	if ( empty( $cf7_cc_tag->name ) ){
		return '';
	}
		
	
    cf7_cc_country_code_add_static_files();
    
	$validation_error = wpcf7_get_validation_error( $cf7_cc_tag->name );

	$class = wpcf7_form_controls_class( $cf7_cc_tag->type, 'wpcf7-country-code' );

	if ( $validation_error )
		$class .= ' wpcf7-not-valid';

	$atts = array();
	
	$atts['class'] = $cf7_cc_tag->get_class_option( $class );
	$atts['id'] = $cf7_cc_tag->get_id_option();
	if ( $cf7_cc_tag->has_option( 'readonly' ) ):
		$atts['readonly'] = 'readonly';
	endif;
	if ( $cf7_cc_tag->is_required() ):
		$atts['aria-required'] = 'true';
	endif;
	$atts['aria-invalid'] = $validation_error ? 'true' : 'false';

	$value = (string) reset( $cf7_cc_tag->values );

	if ( $cf7_cc_tag->has_option( 'placeholder' ) || $cf7_cc_tag->has_option( 'watermark' ) ) {
		$atts['placeholder'] = $value;
		$value = '';
	}
	if ( $cf7_cc_tag->has_option( 'size' ) ):
		$atts['size'] = $cf7_cc_tag->get_option('size', '', true);
	endif;
	if ($cf7_cc_tag->has_option('initialCountry')) :
		$atts['data-initialcountry'] = $cf7_cc_tag->get_option('initialCountry', '', true);
	endif;
	if ( $cf7_cc_tag->has_option( 'preferredCountries' ) ):
		$atts['data-preferredcountries'] = $cf7_cc_tag->get_option('preferredCountries', '', true);
	endif;
	if ( $cf7_cc_tag->has_option( 'lookup-key' ) ):
		$atts['data-lookup-key'] = $cf7_cc_tag->get_option('lookup-key', '', true);
	endif;	

	$value = $cf7_cc_tag->get_default_option($value);
	$value = wpcf7_get_hangover( $cf7_cc_tag->name, $value );

	$atts['value'] = $value;
	$atts['type'] = 'tel';
	$atts['name'] = $cf7_cc_tag->name . '-cf7-cc-national';

	$atts_hidden=array();
	$atts_hidden['name'] = $cf7_cc_tag->name;
	$atts_hidden['type'] = 'hidden';
	$atts_hidden['class'] = 'wpcf7-country-code-full';
	
	$atts_country=array();
	$atts_country['type'] = 'hidden';
	$atts_country['name'] = $cf7_cc_tag->name . '-cf7-cc-country-name';
	$atts_country['class'] = 'wpcf7-country-code-country-name';
	
	$atts_country_code=array();
	$atts_country_code['type'] = 'hidden';
	$atts_country_code['name'] = $cf7_cc_tag->name . '-cf7-cc-country-code';
	$atts_country_code['class'] = 'wpcf7-country-code-country-code';
	
	$atts_country_iso=array();
	$atts_country_iso['type'] = 'hidden';
	$atts_country_iso['name'] = $cf7_cc_tag->name . '-cf7-cc-country-iso2';
	$atts_country_iso['class'] = 'wpcf7-country-code-country-iso2';

	$atts = wpcf7_format_atts( $atts );
	$atts_hidden = wpcf7_format_atts( $atts_hidden );
	$atts_country = wpcf7_format_atts( $atts_country );
	$atts_country_code = wpcf7_format_atts( $atts_country_code );
	$atts_country_iso= wpcf7_format_atts( $atts_country_iso);

	$html = sprintf(
		'<span class="wpcf7-form-control-wrap %1$s"><input %2$s /><input %3$s /><input %5$s /><input %6$s /><input %7$s />%4$s</span>',
		sanitize_html_class( $cf7_cc_tag->name ), $atts, $atts_hidden, $validation_error, $atts_country, $atts_country_code, $atts_country_iso );

	return $html;
}

/**
 * Add javscript and css files for country code dropdown.
 *
 * @since    	1.0.0
 * @param      	string    $plugin_name       		Contact form 7 country code drop down.
 * @param      	string    $version    				1.0.0.
 */
function cf7_cc_country_code_add_static_files(){
	$min='.min';
	if( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) {
		$min='';
	}
  
    wp_enqueue_script( 'cf7-cc-intlTelInput-js', CF7_CC_PUBLIC_URL . '/js/intlTelInput'.$min .'.js', array('jquery') );
    wp_enqueue_style( 'cf7-cc-css', CF7_CC_PUBLIC_URL . '/css/intlTelInput'. $min .'.css');
    wp_enqueue_script( 'cf7-cc-script-js', CF7_CC_PUBLIC_URL . '/js/script' . $min . '.js', array('jquery','cf7-cc-intlTelInput-js'));
    wp_localize_script( 'cf7-cc-script-js', 'wpcf7_utils_url', CF7_CC_PUBLIC_URL . '/js/utils.js' );
}

/**
 * Filter for the country code dropdown phone number validation
 *
 * @since    	1.0.0
 * @param      	string    $plugin_name       		Contact form 7 country code drop down.
 * @param      	string    $version    				1.0.0.
 */
add_filter( 'wpcf7_validate_country_code', 'cf7_cc_country_code_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_country_code*', 'cf7_cc_country_code_validation_filter', 10, 2 );

function cf7_cc_country_code_validation_filter( $result, $cf7_cc_tag ) {
	$cf7_cc_tag = new WPCF7_FormTag( $cf7_cc_tag );

	$name = $cf7_cc_tag->name;

	$_name = sanitize_text_field($_POST[$name]);

	$value = isset( $_name )? trim( wp_unslash( strtr( (string) $_name, "\n", " " ) ) ) : '';
		
	if ( $cf7_cc_tag->is_required() && '' == $value ) {
	    $result->invalidate( $cf7_cc_tag, wpcf7_get_message( 'invalid_required' ) );
	}
    elseif ( '' != $value && ! wpcf7_is_tel( $value ) ) {
        $result->invalidate( $cf7_cc_tag, wpcf7_get_message( 'invalid_tel' ) );
	}
	
	return $result;
}
?>