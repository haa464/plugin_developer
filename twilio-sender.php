<?php
/*
Plugin Name: Twilio SMS & WhatsApp Sender
Description: Send SMS and WhatsApp messages using Twilio from your WordPress site.
Version: 1.0.0
Author: Hardik 
Text Domain: twilio-sms-whatsapp
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

define('TSW_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('TSW_PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN', plugin_basename(__FILE__));

function activate_tsw_plugins() {
    TSW\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_tsw_plugins');

function deactivate_tsw_plugins() {
    TSW\Base\Deactivate::deactivate();
}
register_activation_hook(__FILE__, 'deactivate_tsw_plugins');

if(class_exists('TSW\Init')){
    TSW\Init::register_services();
}