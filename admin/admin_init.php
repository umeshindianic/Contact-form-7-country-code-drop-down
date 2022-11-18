<?php
/**
 * Provide a admin area view for the plugin
 *
 * Contact form 7 add country code drop-down with phone number function
 *
 * @link       https://indianic.com
 * @since      1.0.0
 *
 * @package    cf7-country-code-addon
 * @subpackage cf7-country-code-addon/admin
 */

add_action('wpcf7_admin_init', 'cf7_cc_add_tag_generator_country_code', 15);
function cf7_cc_add_tag_generator_country_code()
{
	$tag_generator = WPCF7_TagGenerator::get_instance();
	$tag_generator->add('country_code', __('Tel with country code', 'cf7-cc-addon'), 'cf7_cc_tag_generator_country_code');
}

function cf7_cc_tag_generator_country_code($CF7_CC, $CF7_CC_args = '')
{
	$CF7_CC_args = wp_parse_args($CF7_CC_args, array());
	$type = $CF7_CC_args['id'];

	$description = __('Create drop-down field for country code number with flag drop-down.', 'cf7-cc-addon');

?>
	<div class="control-box cf7-cc-control-box">
		<fieldset>
			<legend><?php echo esc_html($description); ?></legend>

			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><?php echo esc_html(__('Is required', 'cf7-cc-addon')); ?></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><?php echo esc_html(__('Is required', 'cf7-cc-addon')); ?></legend>
								<label><input type="checkbox" name="required" /> <?php echo esc_html(__('Required field', 'cf7-cc-addon')); ?></label>
							</fieldset>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($CF7_CC_args['content'] . '-name'); ?>"><?php echo esc_html(__('Name', 'cf7-cc-addon')); ?></label></th>
						<td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr($CF7_CC_args['content'] . '-name'); ?>" /></td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($CF7_CC_args['content'] . '-id'); ?>"><?php echo esc_html(__('ID attribute', 'cf7-cc-addon')); ?></label></th>
						<td><input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr($CF7_CC_args['content'] . '-id'); ?>" /></td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($CF7_CC_args['content'] . '-class'); ?>"><?php echo esc_html(__('Class attribute', 'cf7-cc-addon')); ?></label></th>
						<td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr($CF7_CC_args['content'] . '-class'); ?>" /></td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($CF7_CC_args['content'] . '-initialCountry'); ?>"><?php echo esc_html(__('Initial Country', 'cf7-cc-addon')); ?></label></th>
						<td>
							<input type="text" name="initialCountry" class="initialCountryvalue oneline option" id="<?php echo esc_attr($CF7_CC_args['content'] . '-initialCountry'); ?>" placeholder="<?php /* translators: 1. Two-letter country codes placeholder */ _e('in', 'cf7-cc-addon'); ?>" maxlength="2" />
							<p class="description"><?php _e('Add a two-letters country code.', 'cf7-cc-addon') ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($CF7_CC_args['content'] . '-preferredCountries'); ?>"><?php echo esc_html(__('Preferred Countries', 'cf7-cc-addon')); ?></label></th>
						<td>
							<input type="text" name="preferredCountries" class="preferredCountriesvalue oneline option" id="<?php echo esc_attr($CF7_CC_args['content'] . '-preferredCountries'); ?>" placeholder="<?php /* translators: 1. Two-letter country codes placeholder */ _e('in', 'cf7-cc-addon'); ?>" />
							<p class="description"><?php _e('Add a two-letters country code separated by pipe sign(|). The countries entered here will be moved at the top of the country drop-down list.', 'cf7-cc-addon') ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="<?php echo esc_attr($CF7_CC_args['content'] . '-lookup-key'); ?>"><?php echo esc_html(__('IP Lookup API key', 'cf7-cc-addon')); ?></label></th>
						<td>
							<input type="text" name="lookup-key" class="idvalue oneline option" id="<?php echo esc_attr($CF7_CC_args['content'] . '-lookup-key'); ?>" />
							<p class="description"><?php _e('Please get your API Key at <a href="https://extreme-ip-lookup.com/myaccount" target="_blank">https://extreme-ip-lookup.com/myaccount</a>. If you not insert API key then it will not auto detect country code.', 'cf7-cc-addon'); ?></p>
						</td>
					</tr>

				</tbody>
			</table>
		</fieldset>
	</div>

	<div class="insert-box">
		<input type="text" name="<?php echo $type; ?>" class="tag code" readonly="readonly" onfocus="this.select()" />

		<div class="submitbox">
			<input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr(__('Insert Tag', 'cf7-cc-addon')); ?>" />
		</div>

		<br class="clear" />
	</div>
<?php
}