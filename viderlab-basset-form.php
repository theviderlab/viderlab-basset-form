<?php

/**
 *
 * @link              https://viderlab.com
 * @since             1.0.0
 * @package           ViderLab_Basset_Form
 *
 * @wordpress-plugin
 * Plugin Name:       ViderLab Basset Form
 * Plugin URI:        https://viderlab.com/viderlab-basset-form/
 * Description:       Creates a simple form to begin a search on Basset
 * Version:           1.0.0
 * Author:            ViderLab
 * Author URI:        http://viderlab.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       viderlab-basset-form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'VIDERLAB_BASSET_FORM_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-viderlab-basset-form-activator.php
 */
function activate_viderlab_basset_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-viderlab-basset-form-activator.php';
	ViderLab_Basset_Form_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-viderlab-basset-form-deactivator.php
 */
function deactivate_viderlab_basset_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-viderlab-basset-form-deactivator.php';
	ViderLab_Basset_Form_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_viderlab_basset_form' );
register_deactivation_hook( __FILE__, 'deactivate_viderlab_basset_form' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-viderlab-basset-form.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_viderlab_basset_form() {

	$plugin = new ViderLab_Basset_Form();
	$plugin->run();

}
run_viderlab_basset_form();
