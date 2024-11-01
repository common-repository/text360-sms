<?php
function text360_update_order_sms($id, $status_transition_from, $status_transition_to, $that)
{
    $order = new WC_Order($id);
    $sms_api_key = get_option('sms-api-key', 'api_key');

    $apiKey = $sms_api_key;
    $mobileNo = "88" . $order->get_billing_phone();
    $message = "Hello " . $order->get_billing_first_name() . " " . $order->get_billing_last_name() . "," . "\n Your order status has been changed from ".$status_transition_from." to ".$status_transition_to." \n View Details:\n" . $order->get_checkout_order_received_url();

    $data = array(
        'api_key' => $apiKey,
        'recipient_number' => $mobileNo,
        'message' => $message,
    );

    text360_send_sms($data);
}
