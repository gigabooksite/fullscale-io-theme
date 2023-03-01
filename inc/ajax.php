<?php

// user forms
add_action( 'wp_ajax_nopriv_client_onboarding', 'fs_client_onboarding_func' );
add_action( 'wp_ajax_client_onboarding', 'fs_client_onboarding_func' );

/**
 *	@desc Client onboarding form
 */
function fs_client_onboarding_func() 
{
    // get user submission data
    $json   = [];
    $nonce  = $_POST['nonce'];

    // if (! wp_verify_nonce($nonce, 'fs_client_onboarding_action')) {
    //     die('<p class="error">Security checked! validation failed. Please refresh the page and try again.</p>');
    // }
    
    $email_address = $_POST['email'];
    $env           = $_POST['env'];
    
    if (empty($email_address)) {
        $json[] = __('Email address is a required field', 'full-scale');
    } elseif (! is_email($email_address)) {
        $json[] = __('Invalid email address', 'full-scale');
    } else {

        [$endpoint_url, $redirection_url] = fs_get_env($env);

        $body =  [
            "email" => $email_address
        ];

        $response = wp_remote_post($endpoint_url . '/forms/client-onboarding/responses', [
            'timeout'     => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true,
            'headers'     => [
                'Content-Type'      => 'application/json',
                'X-Rocks-Platform'  => 'client',
                'Accept'            => 'application/x.rest.v2+json'
            ],
            'body'        => wp_json_encode($body)
        ]);
        
        $responseBody = json_decode(wp_remote_retrieve_body($response));

        if (200 !== $responseBody->status_code) {
            $json[] = "Something went wrong while sending your data, please try again.";
        } else {
            $json = [
                'status'            => $responseBody->status_code,
                'message'           => $responseBody->message,
                'redirection_url'   => $redirection_url 
                                        . '?email='. urlencode($email_address)
                                        . '&client_id='. $responseBody->group_id
                                        . '&env='. $env
            ];
        }
    }
    
    wp_send_json($json);

    // return proper result
    die();
}