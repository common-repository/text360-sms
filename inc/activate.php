<?php
function text360_sms_activate_plugin(){
    if(version_compare(get_bloginfo('version'), '5.0', '<')){
        wp_die('You must update your WordPress installation to use this plugin');
    }  
}