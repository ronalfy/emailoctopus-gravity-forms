<?php
namespace EmailOctopus\API\Helper;
class EOGF_API_Helper {
	/**
	 * Checks for a valid API key
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param string $api_key The API key to check
	 *
	 * @return bool Whether the API key is valid or not
	 */
	public static function is_valid_api_key($api_key) {
		if (!$api_key) {
			return false;
		}

		$api_key = sanitize_text_field( $api_key );

		// Check option for api key status
		$gforms_api_options = get_option('gravityformsaddon_EOGF_API_settings', false);
		$saved_api_key = isset( $forms_api_options['eogf_api_key'] ) ? $forms_api_options['eogf_api_key'] : false;
		$saved_connect_status = isset( $forms_api_options['eogf_connected'] ) ? $forms_api_options['eogf_connected'] : false;

		if ($saved_api_key && $saved_connect_status === 'connected') {
			return true;
		}

		// Format API call
		$api_endpoint = 'https://emailoctopus.com/api/1.5/lists';
		$api_url = add_query_arg(
			array(
				'api_key' => $api_key,
				'limit' => 100,
				'page' => 1,
			),
			$api_endpoint
		);
		$api_response = wp_remote_get($api_url);
		if (!is_wp_error($api_response)) {
			$body = json_decode(wp_remote_retrieve_body($api_response));
			if (isset($body->error)) {
				return false;
			}
			$gforms_api_options = get_option('gravityformsaddon_EOGF_API_settings', false);
			$gforms_api_options['eogf_api_key'] = $api_key;
			$gforms_api_options['eogf_connected'] = 'connected';
			update_option('gravityformsaddon_EOGF_API_settings', $gforms_api_options);
			return true;
		}
		return false;
	}
}
