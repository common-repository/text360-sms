<?php

function text360_add_sms_submenu_page(){
    add_submenu_page(
        'woocommerce',
        'TEXT360 SMS',
        'TEXT360 SMS',
        'manage_options',
        'text360-sms-save-api',
        'text360_sms_function'
    );
}
function text360_sms_function(){
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized user');
    }

    if (isset($_POST['save'])) {
        if ( ! isset( $_POST['text360_sms_nonce_field'] )
            || ! wp_verify_nonce( $_POST['text360_sms_nonce_field'], 'text360_sms_api_save_nonce_action' )
        ) {
            echo '<div id="setting-error-settings_updated" class="notice notice-success settings-error is-dismissible"> <p><strong>Sorry, your nonce did not verify.</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
            exit;
        } else {
            if (isset($_POST['sms-api-key'])) {
                $api_key = sanitize_text_field($_POST["sms-api-key"]);
                update_option('sms-api-key', $api_key);
            }
            echo '<div id="setting-error-settings_updated" class="notice notice-success settings-error is-dismissible"> <p><strong>Settings saved.</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
        }
    }
  
    $sms_api_key = get_option('sms-api-key', 'api_key');
    ?>
    <div class="wrap woocommerce">
      <form method="post" id="technoform" action="" enctype="multipart/form-data">
      <?php settings_errors(); ?>
      <img src="<?php echo TEXT360_SMS_PLUGIN_DIR.'assets/img/text360-logo.png' ?>" />
      <hr />
      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row" class="titledesc">
              <label for="sms-api-key">API KEY </label>
            </th>
            <td class="forminp">
              <fieldset>
                <legend class="screen-reader-text"><span>API Key</span></legend>
                <input class="input-text regular-input" style="width:40%" type="text" name="sms-api-key" id="sms-api-key" style="" value="<?php echo $sms_api_key; ?>" placeholder="">
                <p class="description">
                    <ul>
                      <li>- Sign up at <a href="https://my.text360.net/register" target="_blank">Text360.Net</a></li>
                      <li>- If you already have account then <a href="https://my.text360.net/" target="_blank">login</a></li>
                      <li>- After successful login, <a href="https://my.text360.net/user/api/documentation/api_key">click here</a> or navigate to API Docs -> API Key (From left sidebar)</li>
                      <li>- Generate API Key (or copy and paste it here if you already have the API key)</li>
                    </ul>
                    <hr />
                    <h4>Contact support if you face any difficulties</h4>
                    <strong>Phone</strong> +(880) 9617 212121 <strong>or</strong> +(880) 1799 275718 <br />
                    <strong>Email</strong> info@text360.net
                </p>
              </fieldset>
            </td>
          </tr>
        </tbody>
      </table>
      <p class="submit">
        <?php wp_nonce_field( 'text360_sms_api_save_nonce_action','text360_sms_nonce_field' ); ?>
        <button name="save" class="button-primary woocommerce-save-button" type="submit" value="Save changes">Save changes</button>
      </p>
    </form>
    </div>
    <?php
  }