<?php
/**
 * This file create for admin side functionality for country drop-down in contact form 7
 */

/**
 *  Admin Menu Function for Apply contact form 7 drop-down field settings
 */



add_action('wpcf7_admin_init', 'iNic_CF_CC_add_tag_generator_country_code', 15);

function iNic_CF_CC_add_tag_generator_country_code()
{
	$tag_generator = WPCF7_TagGenerator::get_instance();
	$tag_generator->add('country_code', __('Tel with ountry code', 'country-code-input-for-contact-form-7'), 'iNic_CF_CC_tag_generator_country_code');
}

function iNic_CF_CC_tag_generator_country_code($contact_form, $args = '')
{
	$args = wp_parse_args($args, array());
	$type = $args['id'];

	$description = __('Create a input field for to insert Country code number with a flag dropdown.', 'country-code-input-for-contact-form-7');

?>
	<div class="control-box iNic-CF-CC-control-box">
		<fieldset>
			<legend><?php echo esc_html($description); ?></legend>

			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><?php echo esc_html(__('Is required', 'country-code-input-for-contact-form-7')); ?></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><?php echo esc_html(__('Is required', 'country-code-input-for-contact-form-7')); ?></legend>
								<label><input type="checkbox" name="required" /> <?php echo esc_html(__('Required field', 'country-code-input-for-contact-form-7')); ?></label>
							</fieldset>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($args['content'] . '-name'); ?>"><?php echo esc_html(__('Name', 'country-code-input-for-contact-form-7')); ?></label></th>
						<td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr($args['content'] . '-name'); ?>" /></td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($args['content'] . '-id'); ?>"><?php echo esc_html(__('ID attribute', 'country-code-input-for-contact-form-7')); ?></label></th>
						<td><input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr($args['content'] . '-id'); ?>" /></td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($args['content'] . '-class'); ?>"><?php echo esc_html(__('Class attribute', 'country-code-input-for-contact-form-7')); ?></label></th>
						<td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr($args['content'] . '-class'); ?>" /></td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($args['content'] . '-initialCountry'); ?>"><?php echo esc_html(__('Initial Country', 'country-code-input-for-contact-form-7')); ?></label></th>
						<td>
							<input type="text" name="initialCountry" class="initialCountryvalue oneline option" id="<?php echo esc_attr($args['content'] . '-initialCountry'); ?>" placeholder="<?php /* translators: 1. Two-letter country codes placeholder */ _e('in', 'country-code-input-for-contact-form-7'); ?>" maxlength="2" />
							<p class="description"><?php _e('Add a two-letters country code. When this option is set, the IP lookup feature will be disabled. Leave blank if you want to use the IP lookup feature.', 'country-code-input-for-contact-form-7') ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($args['content'] . '-preferredCountries'); ?>"><?php echo esc_html(__('Preferred Countries', 'country-code-input-for-contact-form-7')); ?></label></th>
						<td>
							<input type="text" name="preferredCountries" class="preferredCountriesvalue oneline option" id="<?php echo esc_attr($args['content'] . '-preferredCountries'); ?>" placeholder="<?php /* translators: 1. Two-letter country codes placeholder */ _e('uk', 'country-code-input-for-contact-form-7'); ?>" />
							<p class="description"><?php _e('The countries entered here will be moved at the top of the country dropdown list. Use two-letters country codes separated by hyphen.', 'country-code-input-for-contact-form-7') ?></p>
						</td>
					</tr>

				</tbody>
			</table>
		</fieldset>
	</div>

	<div class="insert-box">
		<input type="text" name="<?php echo $type; ?>" class="tag code" readonly="readonly" onfocus="this.select()" />

		<div class="submitbox">
			<input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr(__('Insert Tag', 'country-code-input-for-contact-form-7')); ?>" />
		</div>

		<br class="clear" />
	</div>
<?php
}
/*
Front
*/
add_action( 'wpcf7_init', 'iNic_CF_CC_add_formtag_country_code' );

function iNic_CF_CC_add_formtag_country_code() {
	wpcf7_add_form_tag(
		array( 'country-code', 'country-code*' ),
		'iNic_CF_CC_country_code_formtag_handler', true);
}

function iNic_CF_CC_country_code_formtag_handler ( $tag ){
    
    $tag = new WPCF7_FormTag( $tag );

	if ( empty( $tag->name ) )
		return '';
		
	
    iNic_CF_CC_country_code_add_static_files();
    
	$validation_error = wpcf7_get_validation_error( $tag->name );

	$class = wpcf7_form_controls_class( $tag->type, 'wpcf7-country-code' );

	if ( $validation_error )
		$class .= ' wpcf7-not-valid';

	$atts = array();
	
	$atts['class'] = $tag->get_class_option( $class );
	$atts['id'] = $tag->get_id_option();
	if ( $tag->has_option( 'readonly' ) ):
		$atts['readonly'] = 'readonly';
	endif;
	if ( $tag->is_required() ):
		$atts['aria-required'] = 'true';
	endif;
	$atts['aria-invalid'] = $validation_error ? 'true' : 'false';

	$value = (string) reset( $tag->values );

	if ( $tag->has_option( 'placeholder' ) || $tag->has_option( 'watermark' ) ) {
		$atts['placeholder'] = $value;
		$value = '';
	}
	if ( $tag->has_option( 'size' ) ):
		$atts['size'] = $tag->get_option('size', '', true);
	endif;
	if ($tag->has_option('initialCountry')) :
		$atts['data-initialcountry'] = $tag->get_option('initialCountry', '', true);
	endif;
	if ( $tag->has_option( 'preferredCountries' ) ):
		$atts['data-preferredcountries'] = $tag->get_option('preferredCountries', '', true);
	endif;	

	$value = $tag->get_default_option($value);
	$value = wpcf7_get_hangover( $tag->name, $value );

	$atts['value'] = $value;
	$atts['type'] = 'tel';
	$atts['name'] = $tag->name . '-cf7it-national';

	$atts_hidden=array();
	$atts_hidden['name'] = $tag->name;
	$atts_hidden['type'] = 'hidden';
	$atts_hidden['class'] = 'wpcf7-country-code-full';
	
	$atts_country=array();
	$atts_country['type'] = 'hidden';
	$atts_country['name'] = $tag->name . '-cf7it-country-name';
	$atts_country['class'] = 'wpcf7-country-code-country-name';
	
	$atts_country_code=array();
	$atts_country_code['type'] = 'hidden';
	$atts_country_code['name'] = $tag->name . '-cf7it-country-code';
	$atts_country_code['class'] = 'wpcf7-country-code-country-code';
	
	$atts_country_iso=array();
	$atts_country_iso['type'] = 'hidden';
	$atts_country_iso['name'] = $tag->name . '-cf7it-country-iso2';
	$atts_country_iso['class'] = 'wpcf7-country-code-country-iso2';

	$atts = wpcf7_format_atts( $atts );
	$atts_hidden = wpcf7_format_atts( $atts_hidden );
	$atts_country = wpcf7_format_atts( $atts_country );
	$atts_country_code = wpcf7_format_atts( $atts_country_code );
	$atts_country_iso= wpcf7_format_atts( $atts_country_iso);

	$html = sprintf(
		'<span class="wpcf7-form-control-wrap %1$s"><input %2$s /><input %3$s /><input %5$s /><input %6$s /><input %7$s />%4$s</span>',
		sanitize_html_class( $tag->name ), $atts, $atts_hidden, $validation_error, $atts_country, $atts_country_code, $atts_country_iso );

	return $html;
}

function iNic_CF_CC_country_code_add_static_files(){
	$min='.min';
	if( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) {
		$min='';
	}
  
    wp_enqueue_script( 'wpcf7-country-code-lib-js', INIC_CF_CC_PUBLIC_URL . '/js/intlTelInput'.$min .'.js' ,  array( 'jquery' ), '12.1.3', true);
    wp_enqueue_style( 'wpcf7-country-code-css', INIC_CF_CC_PUBLIC_URL . '/css/intlTelInput'. $min .'.css' , '', '12.1.3', 'all');
    wp_enqueue_script( 'wpcf7-country-code-js', INIC_CF_CC_PUBLIC_URL . '/js/script' . $min . '.js', array('jquery', 'wpcf7-country-code-lib-js'), '1.4.0', true);
    wp_localize_script( 'wpcf7-country-code-js', 'wpcf7_utils_url', INIC_CF_CC_PUBLIC_URL . '/js/utils.js' );
} 

function wpcf7_country_code_random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
/*
filter
*/
add_filter( 'wpcf7_validate_country_code', 'iNic_CF_CC_country_code_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_country_code*', 'iNic_CF_CC_country_code_validation_filter', 10, 2 );

function iNic_CF_CC_country_code_validation_filter( $result, $tag ) {
	$tag = new WPCF7_FormTag( $tag );

	$name = $tag->name;

	$value = isset( $_POST[$name] )? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) ) : '';
		
	if ( $tag->is_required() && '' == $value ) {
	    $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
	}
    elseif ( '' != $value && ! wpcf7_is_tel( $value ) ) {
        $result->invalidate( $tag, wpcf7_get_message( 'invalid_tel' ) );
	}
	
	return $result;
}
/*
mail
*/
add_filter( 'wpcf7_special_mail_tags', 'iNic_CF_CC_country_code_special_mail_tags', 10, 3 );

function iNic_CF_CC_country_code_special_mail_tags( $output, $name, $html ) {
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