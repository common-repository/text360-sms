<?php
/*
Plugin Name: Text360 SMS
Plugin URI:  https://www.text360.net
Description: This plugin send SMS using Text360 API when a new order is placed or order status changed. It will require you to sign up first at <a href="https://my.text360.net/register" target="_blank">https://my.text360.net/register</a>
Version:     1.0.2
Author:      TEXT360 Team
Author URI:  https://text360.net/contact
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined('ABSPATH') or die('Direct access denied.');

// Setup
define('TEXT360_SMS_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );

include('inc/activate.php');
include('inc/deactivate.php');
include('inc/text360.php');
include('inc/order-place.php');
include('inc/order-update.php');
include('admin/integration.php');
include('uninstall.php');

// Hooks
register_activation_hook( __FILE__, 'text360_sms_activate_plugin');
register_deactivation_hook( __FILE__, 'text360_sms_deactivate_plugin');
register_uninstall_hook( __FILE__, 'text360_sms_uninstall_plugin');
add_action("admin_menu", "text360_add_sms_submenu_page");
add_action( 'woocommerce_new_order', 'text360_new_order_sms',  10, 3 );
add_action( 'woocommerce_order_status_changed', 'text360_update_order_sms', 10, 4 );

