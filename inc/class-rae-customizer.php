<?php
/**
 * Customizer settings.
 *
 * @package REST API ENDPOINTS
 */

/**
 * Class Rae_Customizer
 */
class Rae_Customizer {

	/**
	 * Construct method.
	 */
	function __construct() {
		$this->_setup_hooks();
	}

	/**
	 * To register action/filter.
	 *
	 * @return void
	 */
	function _setup_hooks() {
		/**
		 * Actions
		 */
		add_action( 'customize_register', [ $this, 'customize_register' ] );
	}

	/**
	 * Customize register.
	 *
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @action customize_register
	 */
	public function customize_register( \WP_Customize_Manager $wp_customize ) {

		$social_icons = [ 'facebook', 'twitter', 'instagram', 'youtube' ];

		$wp_customize->add_section(
			'rae_social_links',
			[
				'title'       => esc_html__( 'Social Links', 'rest-api-endpoints' ),
				'description' => esc_html__( 'Social links', 'rest-api-endpoints' ),
			]
		);

		foreach ( $social_icons as $social_icon ) {

			$setting_id = sprintf( 'rae_%s_link', $social_icon );

			$wp_customize->add_setting(
				$setting_id,
				[
					'default'           => '',
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => 'esc_url',
				]
			);

			$wp_customize->add_control(
				$setting_id,
				[
					'label'    => esc_html( $social_icon ),
					'section'  => 'rae_social_links',
					'settings' => $setting_id,
					'type'     => 'text',
				]
			);
		}

	}
}

new Rae_Customizer();
