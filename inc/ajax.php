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
    
    if (empty($email_address)) {
        $json[] = __('Email address is a required field', 'full-scale');
    } elseif (! is_email($email_address)) {
        $json[] = __('Invalid email address', 'full-scale');
    } else {

        $env        = $_POST['env'] ?? WP_ENV ?? '';
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


// user forms
add_action( 'wp_ajax_nopriv_view_profile', 'fs_view_profile_func' );
add_action( 'wp_ajax_view_profile', 'fs_view_profile_func' );

/**
 *	@desc Client onboarding form
 */
function fs_view_profile_func() 
{
    // JSON array placeholder
    $json           = [];
    
    // get submitted POST data from font-end with care
    [$endpoint_url] = fs_get_env($_GET['env'] ?? WP_ENV ?? '');

    $lang           = $_POST['lang'];
    $talentId       = $_POST['talentId'];
    $talentUniqueId = $_POST['talentUniqueId'];
    
    // request a get
    $response       = wp_remote_get($endpoint_url . '/io/talent/'. $talentUniqueId);
    
    // if there's something wrong while communicating to the API, stop.
    if (is_wp_error($response)) {
        return;
    }

    $responseBody   = json_decode(wp_remote_retrieve_body($response), true);
    $talentInfo     = $responseBody['data'] ?? [];

    // if no talent info, stop, please stop, don't waste your effort chasing for someone
    if (empty($talentInfo)) {
        return;
    }

    // now request for the Other Talents as well
    $otherTalentResponse = wp_remote_get(
        add_query_arg(
            [
                'keyword'   => urlencode($lang),
                'exclude'   => $talentId,
                'take'      => 3,
            ],
            $endpoint_url . '/io/talents'
        )
    );
    
    $otherResponseBody     = json_decode(wp_remote_retrieve_body($otherTalentResponse), true);
    $otherTalents          = $otherResponseBody['data'] ?? [];
    
    ob_start();
    ?>
        <section class="elementor-section elementor-top-section elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        
                        <div class="rounded-md dialog__body">
                            
                            <div class="profile-single__inner">
                                <section class="elementor-section elementor-inner-section elementor-element">
                                    <div class="elementor-container lg:gap-4">

                                        <div class="elementor-column <?php echo (!empty($otherTalents)) ? 'elementor-col-80' : 'elementor-col-100'; ?> elementor-inner-column">

                                            <section class="elementor-section elementor-inner-section elementor-element w-full p-4 bg-blue-50 rounded-md profile-section">
                                                <div class="elementor-container elementor-column-gap-default">

                                                    <div class="elementor-column elementor-col-30 elementor-inner-column">
                                                        <div class="elementor-widget-wrap bg-black-80 rounded-md">
                                                            <div class="elementor-element">

                                                                <div class="px-4 py-8 text-white">
                                                                    <div class="mb-8 text-center avatar">
                                                                        <figure class="mb-6">
                                                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/avatar-placeholder.png" alt=""
                                                                                class="w-36 h-36 rounded-full"
                                                                            />
                                                                        </figure>

                                                                        <a 
                                                                            href="<?php echo get_the_permalink(33); ?>" 
                                                                            class="btn btn-primary text-uppercase no-underline"
                                                                        >
                                                                            Schedule a Call
                                                                        </a>
                                                                    </div>
                                                                    
                                                                    <?php if (!empty($talentInfo['summary'])) { ?>
                                                                        <div class="about">
                                                                            <header>
                                                                                <h3 class="mb-2 d-flex items-center text-uppercase font-gotham text-orange">
                                                                                    <i class="las la-user"></i>
                                                                                    <span class="ml-2">About</span>
                                                                                </h3>
                                                                            </header>
                                                                            
                                                                            <article class="text-sm">
                                                                                <?php echo wpautop($talentInfo['summary']); ?>
                                                                            </article>
                                                                        </div>
                                                                    <?php } ?>
                                                                    
                                                                    <div class="skills">
                                                                        <header>
                                                                            <h3 class="mb-2 d-flex items-center text-uppercase font-gotham text-orange">
                                                                                <i class="las la-wrench"></i>
                                                                                <span class="ml-2">Skills</span>
                                                                            </h3>
                                                                        </header>

                                                                        <div class="px-4 pt-2 pb-2 rounded-md skill-wrap">
                                                                            <?php
                                                                                $skills = !empty($talentInfo['hackerRank']) 
                                                                                            ? $talentInfo['hackerRank']
                                                                                            : $talentInfo['skills'];

                                                                                // remove duplicates
                                                                                $skills = fs_remove_duplicate_item($skills, 'unique_id');
                                                                                
                                                                                get_template_part(
                                                                                    'template-parts/card/skill',
                                                                                    'card',
                                                                                    [
                                                                                        'skills' => $skills,
                                                                                        'type'   => 'default'   // modern | default
                                                                                    ]
                                                                                );
                                                                            ?>
                                                                        </div>
                                                                    </div>
 
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="elementor-column elementor-col-70 elementor-inner-column">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element">
                                                                
                                                                <div class="profile-meta">
                                                                    <div class="p-4 profile-banner">
                                                                        
                                                                        <section class="elementor-section elementor-inner-section elementor-element">
                                                                            <div class="elementor-container elementor-column-gap-default">
                                                                                
                                                                                <div class="elementor-column elementor-col-80 elementor-inner-column">
                                                                                    <div class="elementor-widget-wrap">
                                                                                        <div class="elementor-element">                                                                                                
                                                                                            <figure class="mb-8">
                                                                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fullscale-logo-full.png" alt=""
                                                                                                    class="w-60"
                                                                                                >
                                                                                            </figure>
                                                                                            
                                                                                            <div class="mb-8 font-semibold employee-info">
                                                                                                <h1 class="mb-3 font-gotham text-4xl text-uppercase">
                                                                                                    <span class="font-bold name"><?php echo $talentInfo['first_name']; ?></span>
                                                                                                    <span class="font-semibold text-green last-name-initial"><?php echo $talentInfo['last_name']; ?>.</span>
                                                                                                </h1>
                                                                                                <h2 class="font-gotham role">
                                                                                                    <?php 
                                                                                                        foreach ($talentInfo['positions'] as $position) {
                                                                                                            echo $position['level'] . ' ' . $position['job_title']; 
                                                                                                        }
                                                                                                    ?>
                                                                                                </h2>
                                                                                                <h3 class="font-gotham location">
                                                                                                    <span>
                                                                                                        <?php
                                                                                                            echo !empty($talentInfo['location']['division'])
                                                                                                                ? $talentInfo['location']['division'] . ',' 
                                                                                                                : '';
                                                                                                        ?>
                                                                                                    </span>
                                                                                                    <span><?php echo $talentInfo['location']['country']; ?></span>
                                                                                                </h3>
                                                                                            </div>
                                                                                            
                                                                                            <?php
                                                                                                get_template_part(
                                                                                                    'template-parts/card/available-shift',
                                                                                                    'card',
                                                                                                    [
                                                                                                        'heading' => 'Available Shifts',
                                                                                                        'shifts'  => $talentInfo['shifts']
                                                                                                    ]
                                                                                                );
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </section>
                                                                    </div>
                                                                    
                                                                    <div class="relative employee-work-experience">
                                                                        <?php
                                                                            // work experiences                                                                            
                                                                            get_template_part(
                                                                                'template-parts/card/timeline',
                                                                                'card',
                                                                                [
                                                                                    'heading'    => '<i class="las la-suitcase"></i> <span class="ml-2">Work Experience</span>',
                                                                                    'timelines'  => $talentInfo['workExperiences']
                                                                                ]
                                                                            );
                                                                        ?>
                                                                        
                                                                        <div class="absolute bottom-0 w-full">
                                                                            <div class="text-center">
                                                                                <a 
                                                                                    href="<?php echo get_the_permalink(33); ?>" 
                                                                                    class="btn btn-ghost px-6 text-uppercase no-underline"
                                                                                >              
                                                                                    <div class="d-inline-flex items-center">
                                                                                        <span class="mr-2">Learn More</span>
                                                                                        <i class="las la-angle-up"></i>
                                                                                    </div>                                                                          
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <!-- education goes here -->
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </section>

                                        </div>

                                        <?php if (!empty($otherTalents)) { ?>
                                            <div class="elementor-column elementor-col-20 elementor-inner-column">
                                                <div class="elementor-widget-wrap">
                                                    <div class="elementor-element">
                                                        
                                                        <div class="other-talents">
                                                            <header class="mb-2">
                                                                <h3 class="d-flex items-center font-gotham text-uppercase">
                                                                    <i class="las la-user-check text-green"></i>
                                                                    <span class="ml-2">Other Talent</span>
                                                                </h3>
                                                            </header>
                                                            
                                                            <div class="pt-1 pb-1 bg-blue-50 rounded-md">
                                                                <div class="tech-talents relax">
                                                                    <?php
                                                                        foreach ($otherTalents as $talent) {
                                                                            get_template_part(
                                                                                'template-parts/card/profile',
                                                                                'card',
                                                                                [
                                                                                    'lang'      => $lang,
                                                                                    'talent'    => $talent,
                                                                                ]
                                                                            );
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </section>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    <?php
    
    wp_send_json(ob_get_clean());
}