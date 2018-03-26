<?php
/**
 * Plugin name: Check Cookie Lite
 * Plugin URI: https://github.com/RomainPetiot/check-cookie-lite
 * Description: Tester si l'utilisateur accepte les cookie celon la réglemetation CNIL
 * Author : Romain Petiot
 * Author URI: https://www.romainpetiot.com
 * Contributors:Romain Petiot
 * Domain Path: /languages
 * Text Domain: check-cookie-lite
 * Version: 1.0
 * Stable tag: 1.0
 */

/**
 * Bloquer les accès directs
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require plugin_dir_path( __FILE__ ) . 'admin.php';
require plugin_dir_path( __FILE__ ) . 'front.php';

add_action( 'init', 'check_cookie_lite_init' );
function check_cookie_lite_init() {
  $plugin_dir = basename( dirname( __FILE__ ) ) . '/languages';
  load_plugin_textdomain( 'check-cookie-lite', false, $plugin_dir );
}
