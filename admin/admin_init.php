<?php
/**
 *  Contact form 7 add country code drop-down with phone number function
 */

add_action('wpcf7_admin_init', 'iNic_CF_CC_add_tag_generator_country_code', 15);
function iNic_CF_CC_add_tag_generator_country_code()
{
	$tag_generator = WPCF7_TagGenerator::get_instance();
	$tag_generator->add('country_code', __('Tel with country code', 'country-code-input-for-contact-form-7'), 'iNic_CF_CC_tag_generator_country_code');
}

function iNic_CF_CC_tag_generator_country_code($iNic_CF7_CC, $iNic_CF7_CC_args = '')
{
	$iNic_CF7_CC_args = wp_parse_args($iNic_CF7_CC_args, array());
	$type = $iNic_CF7_CC_args['id'];

	$description = __('Create dropdown field for country code number with flag dropdown.', 'country-code-input-for-contact-form-7');

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
						<th scope="row"><label for="<?php echo esc_attr($iNic_CF7_CC_args['content'] . '-name'); ?>"><?php echo esc_html(__('Name', 'country-code-input-for-contact-form-7')); ?></label></th>
						<td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr($iNic_CF7_CC_args['content'] . '-name'); ?>" /></td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($iNic_CF7_CC_args['content'] . '-id'); ?>"><?php echo esc_html(__('ID attribute', 'country-code-input-for-contact-form-7')); ?></label></th>
						<td><input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr($iNic_CF7_CC_args['content'] . '-id'); ?>" /></td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($iNic_CF7_CC_args['content'] . '-class'); ?>"><?php echo esc_html(__('Class attribute', 'country-code-input-for-contact-form-7')); ?></label></th>
						<td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr($iNic_CF7_CC_args['content'] . '-class'); ?>" /></td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($iNic_CF7_CC_args['content'] . '-initialCountry'); ?>"><?php echo esc_html(__('Initial Country', 'country-code-input-for-contact-form-7')); ?></label></th>
						<td>
							<input type="text" name="initialCountry" class="initialCountryvalue oneline option" id="<?php echo esc_attr($iNic_CF7_CC_args['content'] . '-initialCountry'); ?>" placeholder="<?php /* translators: 1. Two-letter country codes placeholder */ _e('in', 'country-code-input-for-contact-form-7'); ?>" maxlength="2" />
							<p class="description"><?php _e('Add a two-letters country code.', 'country-code-input-for-contact-form-7') ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($iNic_CF7_CC_args['content'] . '-preferredCountries'); ?>"><?php echo esc_html(__('Preferred Countries', 'country-code-input-for-contact-form-7')); ?></label></th>
						<td>
							<input type="text" name="preferredCountries" class="preferredCountriesvalue oneline option" id="<?php echo esc_attr($iNic_CF7_CC_args['content'] . '-preferredCountries'); ?>" placeholder="<?php /* translators: 1. Two-letter country codes placeholder */ _e('in', 'country-code-input-for-contact-form-7'); ?>" />
							<p class="description"><?php _e('Add a two-letters country code separated by pipe sign(|). The countries entered here will be moved at the top of the country dropdown list.', 'country-code-input-for-contact-form-7') ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($iNic_CF7_CC_args['content'] . '-lookup-key'); ?>"><?php echo esc_html(__('IP Lookup API key', 'country-code-input-for-contact-form-7')); ?></label></th>
						<td>
							<input type="text" name="lookup-key" class="idvalue oneline option" id="<?php echo esc_attr($iNic_CF7_CC_args['content'] . '-lookup-key'); ?>" />
							<p class="description"><?php _e('Please get your API Key at https://extreme-ip-lookup.com', 'country-code-input-for-contact-form-7'); ?></p>
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