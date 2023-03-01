<?php

/**
 * Client onboarding form shortcode
 */
function fs_post_minute_read_func($atts) 
{
    ob_start();
    
    global $post;
    
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil($word_count / 200);
    ?>

    <div class="d-flex text-sm">
        <div>
            <span class="text-uppercase">
                <?php
                    $term_obj_list = get_the_terms($post->ID, 'category');
                    if (count($term_obj_list) > 0) {
                        foreach($term_obj_list as $term_obj) {
                            ?>
                            <a class="no-underline text-black" href="<?php echo esc_url(get_category_link($term_obj->term_id)); ?>">
                                <span><?php echo $term_obj->name; ?></span>
                            </a>
                            <?php
                        }
                    }
                ?>
            </span>
        </div>
        <div class="px-3">
            <span>|</span>
        </div>
        <div>
            <span class="text-uppercase">
                <?php
                    echo $readingtime . ' min read';
                ?>
            </span>
        </div>
    </div>
    <?php
    
	return ob_get_clean();
}
add_shortcode( 'post-meta', 'fs_post_minute_read_func' );

/**
 * Client onboarding form shortcode
 */
function fs_client_onboarding_form_func($atts) 
{
    ob_start();

	$attributes = shortcode_atts( [
        'form-size'             => '',
		'form-alignment'        => 'start',     // start, center, end
		'input-border-color'    => '#eaeaea',
        'btn-color'             => 'orange',    // green, orange
	], $atts );
    ?>

    <section class="client-onboarding <?php echo ($attributes['form-size'] !== '') ? 'form-size-' . $attributes['form-size'] : ''; ?>">
        <form class="client-onboarding-forms" method="POST">
            <?php wp_nonce_field( 'fs_client_onboarding_action', 'fs_client_onboarding_nonce' ); ?>
            
            <div class="d-sm-flex justify-<?php echo $attributes['form-alignment']; ?>">
                <input type="email" id="email" name="email" placeholder="Your Email" required style="border-color:<?php echo $attributes['input-border-color']; ?>;">
                <input type="hidden" id="env" name="env" value="<?php echo $_GET['env'] ?? '' ?>" placeholder="Your Email" />
                
                <button 
                    type="submit" 
                    class="elementor-button btn btn-<?php echo 'green' === $attributes['btn-color'] ? 'secondary' : 'primary'; ?> text-white"
                    id="getting_started_btn"
                >
                    <div class="d-flex items-center justify-center">
                        <img 
                            id="loader" 
                            src="<?php echo get_stylesheet_directory_uri(); ?>/images/rolling-loading.png" alt=""
                            style="display: none;"
                        />
                        <span>Get Started</span>
                    </div>
                </button>
            </div>

            <div id="message"></div>
        </form>
    </section>
    
    <?php
	return ob_get_clean();
}
add_shortcode( 'client-onboarding-form', 'fs_client_onboarding_form_func' );

function fs_talents_func($atts)
{
    ob_start();
    
    ?>
    <section class="talents">
        <div class="elementor-container elementor-column-gap-wide">
            <div class="elementor-column elementor-col-25">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element">
                        
                        <a href="<?php echo get_the_permalink(33); ?>">
                            <div class="avatar">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/charry-profilepicture.png" alt="" />
                            </div>
                            <div class="d-flex justify-center ">
                                <div class="d-flex meta">
                                    <div class="name">Charry</div>
                                    <div class="role bg-green text-white">Developer</div>
                                </div>
                            </div>
                            <div class="skill-scores">
                                <ul class="elementor-icon-list-items">
                                    <li>
                                        <div>
                                            <div class="lang">Angular</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar angular-js" style="width: 90%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        90 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">Python</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar python" style="width: 91%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        91 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">SQL</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar sql" style="width: 62%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        62 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">JavaScript</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar js" style="width: 56%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        56 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">NodeJS</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar node-js" style="width: 55%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        55 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </a>

                    </div>
                </div>
            </div>

            <div class="elementor-column elementor-col-25">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element">
                        
                        <a href="<?php echo get_the_permalink(33); ?>">
                            <div class="avatar">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/belleo-profilepicture.png" alt="" />
                            </div>
                            <div class="d-flex justify-center ">
                                <div class="d-flex meta">
                                    <div class="name">Belleo</div>
                                    <div class="role bg-green text-white">Developer</div>
                                </div>
                            </div>
                            <div class="skill-scores">
                                <ul class="elementor-icon-list-items">
                                    <li>
                                        <div>
                                            <div class="lang">SQL</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar sql" style="width: 90%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        90 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">Software Engineering</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar software-engineering" style="width: 90%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        90 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">PHP</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar php" style="width: 89%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        89 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">Git</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar git" style="width: 74%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        74 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">MySQL</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar mysql" style="width: 71%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        71 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </a>

                    </div>
                </div>
            </div>

            <div class="elementor-column elementor-col-25">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element">
                        
                        <a href="<?php echo get_the_permalink(33); ?>">
                            <div class="avatar">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/mark-profilepicture.png" alt="" />
                            </div>
                            <div class="d-flex justify-center ">
                                <div class="d-flex meta">
                                    <div class="name">Mark</div>
                                    <div class="role bg-green text-white">Developer</div>
                                </div>
                            </div>
                            <div class="skill-scores">
                                <ul class="elementor-icon-list-items">
                                    <li>
                                        <div>
                                            <div class="lang">API Development</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar api-development" style="width: 93%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        93 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">JavaScript</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar js" style="width: 85%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        85 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">CSS/SCSSLess/Sass</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar css" style="width: 83%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        83 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">Ruby on Rails</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar ruby-rails" style="width: 81%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        81 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">ReactJS</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar react-js" style="width: 68%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        68 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </a>

                    </div>
                </div>
            </div>

            <div class="elementor-column elementor-col-25">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element">
                        
                        <a href="<?php echo get_the_permalink(33); ?>">
                            <div class="avatar">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/eramae-profilepicture.png" alt="" />
                            </div>
                            <div class="d-flex justify-center ">
                                <div class="d-flex meta">
                                    <div class="name">Eramae</div>
                                    <div class="role bg-green text-white">Developer</div>
                                </div>
                            </div>
                            <div class="skill-scores">
                                <ul class="elementor-icon-list-items">
                                    <li>
                                        <div>
                                            <div class="lang">C#/.NET</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar c-sharp" style="width: 93%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        93 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">JavaScript</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar js" style="width: 85%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        85 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">CSS/SCSSLess/Sass</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar css" style="width: 83%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        83 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">Ruby on Rails</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar ruby-rails" style="width: 81%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        81 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="lang">ReactJS</div>
                                            <div class="d-flex items-center progress-wrap modern">
                                                <div class="progress">
                                                    <div class="progress-bar react-js" style="width: 68%"></div>
                                                </div>
                                                <div class="percent">
                                                    <div class="value">
                                                        68 <span>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
	return ob_get_clean();
}
add_shortcode( 'talents', 'fs_talents_func' );

/**
 * This display tech talents
 */
function fs_tech_talents_func($atts)
{
    $atts = shortcode_atts( [
		'lang' => '',
	], $atts );
    
    [$endpoint_url, $redirection_url] = fs_get_env();

    $currentTech    = $atts['lang'] ?? '';
    $response       = wp_remote_get($endpoint_url . '/io/talents?keyword='. $currentTech .'&match-any-keywords=false');
    
    // oops, there's something wrong while communicating to the API, better stop.
    if (is_wp_error($response)) {
        return;
    }
    
    $responseBody   = json_decode(wp_remote_retrieve_body($response), true);
    $talents        = $responseBody['data'] ?? [];
    
    // if we don't have data, stop
    if (count($talents) <= 0) {
        return;
    }

    // if there are more than 4 talents, return the first 4 items only
    if (count($talents) > 4) {
        $talents = array_slice($talents, 0, 4);
    }

    // this should be coming from the API
    // $talents = [
    //     [
    //         'id'        => 1,
    //         'avatar_url'=> get_stylesheet_directory_uri() . '/images/charry-profilepicture.png',
    //         'name'      => 'Charry',
    //         'role'      => 'Developer',
    //         'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor arcu eget mauris sodales scelerisque.',
    //         'tags'      => [
    //             'PHP',
    //             'CSS',
    //             'Android',
    //             'Node.js',
    //             'JavaScript',
    //         ],
    //         'skills' => [
    //             [
    //                 'name'  => 'SQL',
    //                 'rate'  => '63',
    //                 'class' => 'sql',
    //             ],
    //             [
    //                 'name'  => 'JavaScript',
    //                 'rate'  => '56',
    //                 'class' => 'js',
    //             ],
    //             [
    //                 'name'  => 'NodeJS',
    //                 'rate'  => '55',
    //                 'class' => 'node-js',
    //             ]
    //         ],
    //     ],
    //     [
    //         'id'        => 2,
    //         'avatar_url'=> get_stylesheet_directory_uri() . '/images/belleo-profilepicture.png',
    //         'name'      => 'Belleo',
    //         'role'      => 'Developer',
    //         'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam facilisis nunc in dui bibendum.',
    //         'tags'      => [
    //             'PHP',
    //             'CSS',
    //             'Android',
    //             'Node.js',
    //             'JavaScript',
    //         ],
    //         'skills' => [
    //             [
    //                 'name'  => 'SEL',
    //                 'rate'  => '90',
    //                 'class' => 'angular-js',
    //             ],
    //             [
    //                 'name'  => 'Software Engineering',
    //                 'rate'  => '90',
    //                 'class' => 'software-engineering',
    //             ],
    //             [
    //                 'name'  => 'PHP',
    //                 'rate'  => '89',
    //                 'class' => 'php',
    //             ]
    //         ],
    //     ],
    //     [
    //         'id'        => 3,
    //         'avatar_url'=> get_stylesheet_directory_uri() . '/images/mark-profilepicture.png',
    //         'name'      => 'Mark',
    //         'role'      => 'Developer',
    //         'excerpt'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor arcu eget mauris sodales scelerisque.',
    //         'tags'      => [
    //             'PHP',
    //             'CSS',
    //             'Android',
    //             'Node.js',
    //             'JavaScript',
    //         ],
    //         'skills' => [
    //             [
    //                 'name'  => 'API Development',
    //                 'rate'  => '93',
    //                 'class' => 'api-development',
    //             ],
    //             [
    //                 'name'  => 'Ruby on Rails',
    //                 'rate'  => '81',
    //                 'class' => 'ruby-rails',
    //             ],
    //             [
    //                 'name'  => 'ReactJS',
    //                 'rate'  => '68',
    //                 'class' => 'react-js',
    //             ]
    //         ],
    //     ],
    //     [
    //         'id'        => 4,
    //         'avatar_url'=> get_stylesheet_directory_uri() . '/images/eramae-profilepicture.png',
    //         'name'      => 'Eramae',
    //         'role'      => 'Developer',
    //         'excerpt'   => 'Sed porttitor arcu eget mauris sodales scelerisque. Nullam facilisis nunc in dui bibendum, id porttitor justo lacinia.',
    //         'tags'      => [
    //             'PHP',
    //             'CSS',
    //             'Android',
    //             'Node.js',
    //             'JavaScript',
    //         ],
    //         'skills' => [
    //             [
    //                 'name'  => 'C#/.NET',
    //                 'rate'  => '93',
    //                 'class' => 'c-sharp',
    //             ],
    //             [
    //                 'name'  => 'JavaScript',
    //                 'rate'  => '85',
    //                 'class' => 'js',
    //             ],
    //             [
    //                 'name'  => 'ReactJS',
    //                 'rate'  => '68',
    //                 'class' => 'react-js',
    //             ]
    //         ],
    //     ],
    // ];

    // turn on output buffering
    ob_start();
    ?>

    <section class="tech-talents">
        <div class="elementor-container elementor-column-gap-wide">

            <?php
            foreach($talents as $talent) {
                ?>
                <div class="elementor-column elementor-col-25">
                    <div class="elementor-widget-wrap">
                        <div class="elementor-element">

                            <?php
                                get_template_part(
                                    'template-parts/card/profile',
                                    'card',
                                    $talent
                                );
                            ?>

                        </div>
                    </div>
                </div>
                <?php 
            }
            ?> 

        </div>
    </section>
    
    <?php
	return ob_get_clean();
}
add_shortcode( 'tech-talents', 'fs_tech_talents_func' );