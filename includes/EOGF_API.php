<?php
GFForms::include_addon_framework();
class EOGF_API extends GFAddOn {
	protected $_version = '1.0.0';
	protected $_min_gravityforms_version = '2.3.0';
	protected $_slug = 'EOGF_API';
	protected $_path = 'emailoctopus-gravity-forms/emailoctopus-gravity-forms';
	protected $_full_path = __FILE__;
	protected $_title = 'EmailOctopus';
	protected $_short_title = 'EmailOctopus';
	// Members plugin integration
	protected $_capabilities = array( 'emailoctopus_gravity_forms', 'emailoctopus_gravity_forms_uninstall' );
	// Permissions
	protected $_capabilities_settings_page = 'emailoctopus_gravity_forms';
	protected $_capabilities_form_settings = 'emailoctopus_gravity_forms';
	protected $_capabilities_uninstall = 'emailoctopus_gravity_forms_uninstall';

	private static $_instance = null;

	/**
	 * Returns an instance of this class, and stores it in the $_instance property.
	 *
	 * @return object $_instance An instance of this class.
	 */
	public static function get_instance() {
	    if ( self::$_instance == null ) {
	        self::$_instance = new self();
	    }

	    return self::$_instance;
	}

	public function init() {
		parent::init();
	}

	/**
	 * Plugin settings fields
	 *
	 * @return array Array of plugin settings
	 */
	public function plugin_settings_fields() {
		return array(
			array(
				'title' => __( 'EmailOctopus API Key', 'emailoctopus-gravity-forms' ),
				'description' => '<p>' . __( 'Enter your EmailOctopus API Key.', 'emailoctopus-gravity-forms') . '</p>',
				'fields'      => array(
					array(
						'name'              => 'eogf_api_key',
						'tooltip' 			=> __( 'Enter your EmailOctopus API Key', 'emailoctopus-gravity-forms' ),
						'label'             => __( 'API Key', 'emailoctopus-gravity-forms' ),
						'type'              => 'text',
						'class'             => 'small',
						'feedback_callback' => array( $this, 'initialize_api' )
					),
				)
			)
		);
	}

	public function initialize_api() {
		
	}
}
