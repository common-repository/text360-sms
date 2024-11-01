<?php

function text360_send_sms($data)
{
    $url = 'https://my.text360.net/api/user/send/sms';

    $response = wp_remote_post( $url, array(
        'body'    => wp_json_encode($data),
        'headers' => array(
            'Content-Type' => 'application/json',
        )
    ));

    return $response;
}