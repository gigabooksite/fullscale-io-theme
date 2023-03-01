<?php

/**
 * FullScale Theme Customizer.
 *
 * @package fullscale
 */

/**
 * Register FullScale customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fullscale_customize_register( $wp_customize )
{
    // Client Onboarding
    $wp_customize->add_section( 'client_onboarding_section' , [
        'title'        => __('Client Onboarding', 'full-scale'),
        'priority'     => 99,
    ]);

    $wp_customize->add_setting( 'fullscale_theme_settings[endpoint_url]', [
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ]);
    $wp_customize->add_control( 'endpoint_url', [
        'label'         => __( 'Endpoint URL', 'full-scale' ),
        'description'   => __( 'Please set the client onboarding endpoint URL.', 'full-scale' ),
        'section'       => 'client_onboarding_section',
        'settings'      => 'fullscale_theme_settings[endpoint_url]',
        'type'          => 'url',
    ]);

    $wp_customize->add_setting( 'fullscale_theme_settings[redirection_url]', [
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ]);
    $wp_customize->add_control( 'redirection_url', [
        'label'         => __( 'Redirection URL', 'full-scale' ),
        'description'   => __( 'Please set the client onboarding redirection URL.', 'full-scale' ),
        'section'       => 'client_onboarding_section',
        'settings'      => 'fullscale_theme_settings[redirection_url]',
        'type'          => 'url',
    ]);

    // Develop
    $wp_customize->add_setting( 'fullscale_theme_settings[develop_endpoint_url]', [
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ]);
    $wp_customize->add_control( 'develop_endpoint_url', [
        'label'         => __( 'Develop Endpoint URL', 'full-scale' ),
        'description'   => __( 'Please set the client onboarding develop endpoint URL.', 'full-scale' ),
        'section'       => 'client_onboarding_section',
        'settings'      => 'fullscale_theme_settings[develop_endpoint_url]',
        'type'          => 'url',
    ]);

    $wp_customize->add_setting( 'fullscale_theme_settings[develop_redirection_url]', [
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ]);
    $wp_customize->add_control( 'develop_redirection_url', [
        'label'         => __( 'Develop Redirection URL', 'full-scale' ),
        'description'   => __( 'Please set the client onboarding redirection URL.', 'full-scale' ),
        'section'       => 'client_onboarding_section',
        'settings'      => 'fullscale_theme_settings[develop_redirection_url]',
        'type'          => 'url',
    ]);

    // Staging
    $wp_customize->add_setting( 'fullscale_theme_settings[staging_endpoint_url]', [
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ]);
    $wp_customize->add_control( 'staging_endpoint_url', [
        'label'         => __( 'Staging Endpoint URL', 'full-scale' ),
        'description'   => __( 'Please set the client onboarding develop endpoint URL.', 'full-scale' ),
        'section'       => 'client_onboarding_section',
        'settings'      => 'fullscale_theme_settings[staging_endpoint_url]',
        'type'          => 'url',
    ]);

    $wp_customize->add_setting( 'fullscale_theme_settings[staging_redirection_url]', [
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ]);
    $wp_customize->add_control( 'staging_redirection_url', [
        'label'         => __( 'Staging Redirection URL', 'full-scale' ),
        'description'   => __( 'Please set the client onboarding redirection URL.', 'full-scale' ),
        'section'       => 'client_onboarding_section',
        'settings'      => 'fullscale_theme_settings[staging_redirection_url]',
        'type'          => 'url',
    ]);

    // Production
    $wp_customize->add_setting( 'fullscale_theme_settings[prod_endpoint_url]', [
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ]);
    $wp_customize->add_control( 'prod_endpoint_url', [
        'label'         => __( 'Production Endpoint URL', 'full-scale' ),
        'description'   => __( 'Please set the client onboarding develop endpoint URL.', 'full-scale' ),
        'section'       => 'client_onboarding_section',
        'settings'      => 'fullscale_theme_settings[prod_endpoint_url]',
        'type'          => 'url',
    ]);

    $wp_customize->add_setting( 'fullscale_theme_settings[prod_redirection_url]', [
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ]);
    $wp_customize->add_control( 'prod_redirection_url', [
        'label'         => __( 'Production Redirection URL', 'full-scale' ),
        'description'   => __( 'Please set the client onboarding redirection URL.', 'full-scale' ),
        'section'       => 'client_onboarding_section',
        'settings'      => 'fullscale_theme_settings[prod_redirection_url]',
        'type'          => 'url',
    ]);

    // Data Privacy
    $wp_customize->add_section( 'data_privacy_section' , [
        'title'        => __('Data Privacy', 'full-scale'),
        'priority'     => 99,
    ]);
    
    $wp_customize->add_setting( 'fullscale_theme_settings[data_privacy_popup_content]', [
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ]);
    $wp_customize->add_control( 'data_privacy_popup_content', [
        'label'         => __( 'Data Privacy Popup Content', 'full-scale' ),
        'description'   => __( 'Data Privacy Popup Content', 'full-scale' ),
        'section'       => 'data_privacy_section',
        'settings'      => 'fullscale_theme_settings[data_privacy_popup_content]',
        'type'          => 'textarea',
    ]);
}
add_action( 'customize_register', 'fullscale_customize_register' );