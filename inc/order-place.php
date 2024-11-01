<?php
function text360_new_order_sms($order_id)
{
    $order = new WC_Order($order_id);
    $sms_api_key = get_option('sms-api-key', 'api_key');

    $apiKey = $sms_api_key;
    $mobileNo = "88" . $order->get_billing_phone();
    $message = "Hello " . $order->get_billing_first_name() . " " . $order->get_billing_last_name() . "," . "\n Your Order has been successfully placed \n View Details :" . $order->get_checkout_order_received_url();

    $data = array(
        'api_key' => $apiKey,
        'recipient_number' => $mobileNo,
        'message' => $message,
    );

    text360_send_sms($data);
}
