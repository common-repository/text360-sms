<?php
function text360_sms_uninstall_plugin(){
    if (!defined('WP_UNINSTALL_PLUGIN')) {
        die;
    }
    $option_name = 'text360-sms-woocommerce';
    delete_option($option_name);
}