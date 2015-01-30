<?php
/*
Plugin Name: Simple Mail Chimp Signup
Plugin URL: http://pippinsplugins.com/simple-mailchimp-signup
Description: Display a signup form for any Mail Chimp email list
Version: 1.2
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
Contributors: mordauk
*/

/**************************************************
* CONSTANTS
**************************************************/

if ( !defined( 'PMC_PLUGIN_DIR' ) ) {
	define( 'PMC_PLUGIN_DIR', dirname( __FILE__ ) );
}

/**************************************************
* globals
**************************************************/

global $pmc_options;

$pmc_options = get_option( 'pmc_mc_settings' );

/**************************************************
* languages
**************************************************/

function pmc_load_textdomain() {
	load_plugin_textdomain( 'pmc', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'init', 'pmc_load_textdomain' );

/**************************************************
* includes
**************************************************/

include_once PMC_PLUGIN_DIR . '/includes/settings.php';
include_once PMC_PLUGIN_DIR . '/includes/functions.php';
include_once PMC_PLUGIN_DIR . '/includes/widgets.php';
include_once PMC_PLUGIN_DIR . '/includes/signup-form.php';
