<?php

/**
 * @desc	If you have something to add in add_action hook add it here.
 * @author	Ryan Sutana
 *
 * @package full-scale
 */

/*
 * @desc Localize wp-ajax
 */
function fs_init() 
{
    [$endpoint_url] = fs_get_env($_GET['env'] ?? '');

	wp_enqueue_script( 'fs-request-script', get_stylesheet_directory_uri() . '/js/ajax.js', array( 'jquery' ) );
	wp_localize_script( 'fs-request-script', 'fs_ajax_params', array(
		'ajaxurl'   => admin_url( 'admin-ajax.php' ),
		'endpoint'  => $endpoint_url,
	) );
}
add_action( 'init', 'fs_init' );

/**
 * Proper way to enqueue scripts and styles
 */
function fs_theme_name_scripts() 
{
	wp_enqueue_style( 'fs-line-awesome-theme', get_stylesheet_directory_uri() . "/css/line-awesome.min.css", [] );
}
add_action( 'wp_enqueue_scripts', 'fs_theme_name_scripts' );

/**
 * Create footer placeholder
 */
function fs_footer_function() 
{
    // if user is not loggedin, stop
    if (! is_user_logged_in()) {
        return;
    }

    // if we're not in the talents-pages, stop
    if (! is_page_template( 'page-templates/talents.php' )) {
        return;
    }
    ?>
    <div class="dialog ">
        <div class="dialog__inner">

            <a href="javascript: void(0);" class="btn-close" id="dialog_close">
                <i class="la la-times fs-la-lg close-x"></i>
            </a>
            
            <div id="profile_single" class="profile-single">
                <section class="elementor-section elementor-top-section elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                
                                <div class="rounded-md dialog__body">

                                    <div class="profile-single__inner">
                                        <section class="elementor-section elementor-inner-section elementor-element">
                                            <div class="elementor-container lg:gap-4">

                                                <div class="elementor-column elementor-col-80 elementor-inner-column">

                                                    <section class="elementor-section elementor-inner-section elementor-element w-full p-4 bg-blue-50 rounded-md profile-section">
                                                        <div class="elementor-container elementor-column-gap-default">

                                                            <div class="elementor-column elementor-col-30 elementor-inner-column">
                                                                <div class="elementor-widget-wrap bg-black-80 rounded-md">
                                                                    <div class="elementor-element">

                                                                        <div class="px-4 py-8 text-white">
                                                                            <div class="mb-8 text-center avatar">
                                                                                <figure class="mb-6">
                                                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/charry-profilepicture.png" alt=""
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
                                                                            
                                                                            <div class="about">
                                                                                <header>
                                                                                    <h3 class="mb-2 d-flex items-center text-uppercase font-gotham text-orange">
                                                                                        <i class="las la-user"></i>
                                                                                        <span class="ml-2">About</span>
                                                                                    </h3>
                                                                                </header>
                                                                                
                                                                                <article class="text-sm">
                                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis viverra nibh. Sed id lacus eu quam imperdiet rutrum at et lacus. Vivamus mauris tellus, varius ut facilisis nec, vehicula quis quam. Suspendisse volutpat dolor eget mi iaculis mollis. Donec ac sem nibh.</p>
                                                                                </article>
                                                                            </div>

                                                                            <div class="skills">
                                                                                <header>
                                                                                    <h3 class="mb-2 d-flex items-center text-uppercase font-gotham text-orange">
                                                                                        <i class="las la-wrench"></i>
                                                                                        <span class="ml-2">Skills</span>
                                                                                    </h3>
                                                                                </header>

                                                                                <div class="px-4 pt-2 pb-2 rounded-md skill-wrap">
                                                                                    <?php
                                                                                        get_template_part(
                                                                                            'template-parts/card/skill',
                                                                                            'card',
                                                                                            [
                                                                                                'skills' => [
                                                                                                    [
                                                                                                        'name'  => 'C#/.NET',
                                                                                                        'rate'  => '93',
                                                                                                        'class' => 'c-sharp',
                                                                                                    ],
                                                                                                    [
                                                                                                        'name'  => 'JavaScript',
                                                                                                        'rate'  => '85',
                                                                                                        'class' => 'js',
                                                                                                    ],
                                                                                                    [
                                                                                                        'name'  => 'ReactJS',
                                                                                                        'rate'  => '68',
                                                                                                        'class' => 'react-js',
                                                                                                    ],
                                                                                                    [
                                                                                                        'name'  => 'CSS/SCSSLess/Sass',
                                                                                                        'rate'  => '83',
                                                                                                        'class' => 'css',
                                                                                                    ],
                                                                                                    [
                                                                                                        'name'  => 'Ruby on Rails',
                                                                                                        'rate'  => '81',
                                                                                                        'class' => 'ruby-rails',
                                                                                                    ]
                                                                                                ],
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
                                                                                        
                                                                                        <div class="elementor-column elementor-col-60 elementor-inner-column">
                                                                                            <div class="elementor-widget-wrap">
                                                                                                <div class="elementor-element">                                                                                                
                                                                                                    <figure class="mb-8">
                                                                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fullscale-logo-full.png" alt=""
                                                                                                            class="w-60"
                                                                                                        >
                                                                                                    </figure>
                                                                                                    
                                                                                                    <div class="mb-8 font-semibold employee-info">
                                                                                                        <h1 class="mb-3 font-gotham text-4xl text-uppercase">
                                                                                                            <span class="d-block font-bold name">Anthony</span>
                                                                                                            <span class="d-block font-semibold ttext-green last-name-initial">D.</span>
                                                                                                        </h1>
                                                                                                        <h2 class="font-gotham role">
                                                                                                            Senior Project Manager
                                                                                                        </h2>
                                                                                                        <h3 class="font-gotham location">
                                                                                                            Cebu, Philippines
                                                                                                        </h3>
                                                                                                    </div>
                                                                                                    
                                                                                                    <?php
                                                                                                        // available shifts
                                                                                                        $shifts = [
                                                                                                            [
                                                                                                                '6 AM - 3 PM, PST',
                                                                                                                '4 PM - 1 AM, CST',
                                                                                                            ],
                                                                                                            [
                                                                                                                '6 PM - 3 AM, PST',
                                                                                                                '4 AM - 1 PM, CST',
                                                                                                            ],
                                                                                                        ];
                                                                                                        get_template_part(
                                                                                                            'template-parts/card/available-shift',
                                                                                                            'card',
                                                                                                            [
                                                                                                                'heading' => 'Available Shifts',
                                                                                                                'shifts'  => $shifts
                                                                                                            ]
                                                                                                        );
                                                                                                    ?>
                                                                                                    </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="elementor-column elementor-col-40 elementor-inner-column">
                                                                                            <!-- video goes here -->
                                                                                        </div>
                                                                                    </div>
                                                                                </section>
                                                                            </div>
                                                                            
                                                                            <div class="relative employee-work-experience">
                                                                                <?php
                                                                                    // work experiences
                                                                                    $work_experiences = [
                                                                                        [
                                                                                            'duration'  => 'Started at Full Scale: May 2018',
                                                                                            'title'     => 'Senior Graphic Artist',
                                                                                            'sub_title' => 'Full Scale',
                                                                                            'description' => 'At Full Scale, I create graphics and images for social media ads, illustrations, logo designs, and infographics. I also do infographics, and web page designs. On top of these, I design the layout of our newsletters and other marketing collaterals.
                                                                                                            
                                                                                                            For one client, I create social media ads, video thumbnails for YouTube, and social media feature images. I also do blog images and social media promo graphics. I design character-centric illustrations and illustrations for shirts.
                                                                                                            
                                                                                                            In addition, I also work with another client where I design and create web page designs, banners, icons, and data infographics.
                                                                                                        '
                                                                                        ],
                                                                                        [
                                                                                            'duration'  => 'Jun 2014 - Oct 2018',
                                                                                            'title'     => 'Graphic Designer',
                                                                                            'sub_title' => 'Full Scale',
                                                                                            'description' => 'As a graphic designer, I created designs for the company\'s marketing materials such as infographics, banners, social media content, and other print & digital materials. I also developed mobile application designs for the company\'s mobile app. Additionally, I mentored and trained junior designers.'
                                                                                        ],
                                                                                    ];
                                                                                    get_template_part(
                                                                                        'template-parts/card/timeline',
                                                                                        'card',
                                                                                        [
                                                                                            'heading'    => '<i class="las la-suitcase"></i> <span class="ml-2">Work Experience</span>',
                                                                                            'timelines'  => $work_experiences
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
                                                                            // this should be coming from the API
                                                                            $talents = [
                                                                                [
                                                                                    'id'        => 1,
                                                                                    'avatar_url'=> get_stylesheet_directory_uri() . '/images/charry-profilepicture.png',
                                                                                    'name'      => 'Charry',
                                                                                    'role'      => 'Developer',
                                                                                    'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor arcu eget mauris sodales scelerisque.',
                                                                                    'tags'      => [
                                                                                        'PHP',
                                                                                        'CSS',
                                                                                        'Android',
                                                                                        'Node.js',
                                                                                        'JavaScript',
                                                                                    ],
                                                                                    'skills' => [
                                                                                        [
                                                                                            'name'  => 'SQL',
                                                                                            'rate'  => '63',
                                                                                            'class' => 'sql',
                                                                                        ],
                                                                                        [
                                                                                            'name'  => 'JavaScript',
                                                                                            'rate'  => '56',
                                                                                            'class' => 'js',
                                                                                        ],
                                                                                        [
                                                                                            'name'  => 'NodeJS',
                                                                                            'rate'  => '55',
                                                                                            'class' => 'node-js',
                                                                                        ]
                                                                                    ],
                                                                                ],
                                                                                [
                                                                                    'id'        => 2,
                                                                                    'avatar_url'=> get_stylesheet_directory_uri() . '/images/belleo-profilepicture.png',
                                                                                    'name'      => 'Belleo',
                                                                                    'role'      => 'Developer',
                                                                                    'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam facilisis nunc in dui bibendum.',
                                                                                    'tags'      => [
                                                                                        'PHP',
                                                                                        'CSS',
                                                                                        'Android',
                                                                                        'Node.js',
                                                                                        'JavaScript',
                                                                                    ],
                                                                                    'skills' => [
                                                                                        [
                                                                                            'name'  => 'SEL',
                                                                                            'rate'  => '90',
                                                                                            'class' => 'angular-js',
                                                                                        ],
                                                                                        [
                                                                                            'name'  => 'Software Engineering',
                                                                                            'rate'  => '90',
                                                                                            'class' => 'software-engineering',
                                                                                        ],
                                                                                        [
                                                                                            'name'  => 'PHP',
                                                                                            'rate'  => '89',
                                                                                            'class' => 'php',
                                                                                        ]
                                                                                    ],
                                                                                ],
                                                                            ];

                                                                            if (count($talents) > 0) {
                                                                                foreach ($talents as $talent) {
                                                                                    get_template_part(
                                                                                        'template-parts/card/profile',
                                                                                        'card',
                                                                                        [
                                                                                            'lang'   => '',
                                                                                            'talent' => $talent,
                                                                                        ]
                                                                                    );
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </section>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'fs_footer_function' );