<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://viderlab.com
 * @since      1.0.0
 *
 * @package    ViderLab_Basset_Form
 * @subpackage ViderLab_Basset_Form/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    ViderLab_Basset_Form
 * @subpackage ViderLab_Basset_Form/admin
 * @author     ViderLab <contacto@viderlab.com>
 */
class ViderLab_Basset_Form_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/viderlab-basset-form-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/viderlab-basset-form-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function settings_init() {
        // Register a new setting for "viderlab-basset-form-settings" page.
        register_setting( 'viderlab-basset-form-settings', 'viderlab-basset-form-settings_options' );

        // Register a new section in the "viderlab-basset-form-settings" page.
        add_settings_section(
            'viderlab-basset-form-settings_url',
            __( 'Settings', 'viderlab-basset-form' ), 
            [ $this, 'settings_tag' ],
            'viderlab-basset-form-settings'
        );

        // Register a new field in the "viderlab-basset-form-settings_tag" section, inside the "viderlab-basset-form-settings" page.
        add_settings_field(
            'viderlab-basset-form-settings_url', // As of WP 4.6 this value is used only internally.
                                    // Use $args' label_for to populate the id inside the callback.
                __( 'URL', 'viderlab-basset-form' ),
            [ $this, 'url_field' ],
            'viderlab-basset-form-settings',
            'viderlab-basset-form-settings_url',
            array(
                'label_for'		=> 'viderlab-basset-form-settings_url',
                'class'			=> 'viderlab-basset-form-settings_row',
                'custom_data'	=> 'custom',
            )
        );
    }

    /**
     * Filter section callback function.
     *
     * @param array $args  The settings array, defining title, id, callback.
     */
    public function settings_tag( $args ) {
        ?>
        <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Configure your basset account.', 'viderlab-basset-form' ); ?></p>
        <?php
    }

    /**
     * Pill field callbakc function.
     *
     * WordPress has magic interaction with the following keys: label_for, class.
     * - the "label_for" key value is used for the "for" attribute of the <label>.
     * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
     * Note: you can add custom key value pairs to be used inside your callbacks.
     *
     * @param array $args
     */
    public function url_field( $args ) {
        // Get the value of the setting we've registered with register_setting()
        $options = get_option( 'viderlab-basset-form-settings_options' );
        ?>
        <label><?php esc_html_e( 'https://hotels.basset.com/reservation/', 'viderlab-basset-form' ); ?></label>
		<input type="text" 
                id="<?php echo esc_attr( $args['label_for'] ); ?>"
                data-custom="<?php echo esc_attr( $args['custom_data'] ); ?>"
                name="viderlab-basset-form-settings_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
                value="<?php echo $options[ $args['label_for'] ]; ?>">
        <p class="description">
            <?php esc_html_e( 'Insert your booking engine URL.', 'viderlab-basset-form' ); ?>
        </p>
        <?php
    }

	public function admin_menu() {
		$hook = add_management_page( 'Basset', 'Basset', 'manage_options', 'viderlab-basset-form', [ $this, 'admin_page' ], '' );
        add_action( "load-$hook",  [ $this, 'admin_page_load' ] );
	}

	public function admin_page_load() {
		// ...
	}

	public function admin_page() {
        // check user capabilities
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        // add error/update messages

        // check if the user have submitted the settings
        // WordPress will add the "settings-updated" $_GET parameter to the url
        if ( isset( $_GET['settings-updated'] ) ) {
            // add settings saved message with the class of "updated"
            add_settings_error( 'viderlab-basset-form-settings_messages', 'viderlab-basset-form-settings_message', __( 'Settings Saved', 'viderlab-basset-form' ), 'updated' );
        }

        // show error/update messages
        settings_errors( 'viderlab-basset-form-settings_messages' );
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="options.php" method="post">
                <?php
                // output security fields for the registered setting "viderlab-basset-form-settings"
                settings_fields( 'viderlab-basset-form-settings' );
                // output setting sections and their fields
                // (sections are registered for "viderlab-basset-form-settings", each field is registered to a specific section)
                do_settings_sections( 'viderlab-basset-form-settings' );
                // output save settings button
                submit_button( __('Save Settings', 'viderlab-basset-form') );
                ?>
            </form>
        </div>
        <?php
	}
}
