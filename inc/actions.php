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
    [$endpoint_url] = fs_get_env($_GET['env'] ?? WP_ENV ?? '');
    
	wp_enqueue_script( 'fs-request-script', get_stylesheet_directory_uri() . '/js/ajax.js', array( 'jquery' ) );
	wp_localize_script( 'fs-request-script', 'fs_ajax_params', array(
		'stylesheet_directory'   => get_stylesheet_directory_uri(),
		'ajaxurl'                => admin_url( 'admin-ajax.php' ),
		'endpoint'               => $endpoint_url,
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
                                        &nbsp;
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