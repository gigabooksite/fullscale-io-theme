<?php

function _var_dump($dump) {
	if (empty($dump)) {
		return;
	}

	echo '<pre>';
		var_dump($dump);
	echo '</pre>';
}

/**
 * Return the selected ENV
 * 
 * @return Array
 */
function fs_get_env(string $env = 'local') : Array {
	$theme_settings = get_option('fullscale_theme_settings');

	switch($env) {
		case "demo":
				$endpoint_url       = $theme_settings['endpoint_url'];
				$redirection_url    = $theme_settings['redirection_url'];
			break;
		
		case "staging":
				$endpoint_url       = $theme_settings['staging_endpoint_url'];
				$redirection_url    = $theme_settings['staging_redirection_url'];
			break;
		
		case "develop":
				$endpoint_url       = $theme_settings['develop_endpoint_url'];
				$redirection_url    = $theme_settings['develop_redirection_url'];
			break;
		
		case "local":
				$endpoint_url       = 'http://localhost/api';
				$redirection_url    = 'http://clients.localhost:3000/';
			break;
			
		default:
				$endpoint_url       = $theme_settings['prod_endpoint_url'];
				$redirection_url    = $theme_settings['prod_redirection_url'];
			break;
	}

	return [
		$endpoint_url,
		$redirection_url
	];
}

/**
 * Get Rocks tech stack
 * 
 * @param 
 * @return Array
 */
function fs_get_tech_stack() : Array {
	return [
		'dot-net' 		=> '.NET',
		'dot-net' 		=> 'ASP.Net',
		'dot-net' 		=> '.Net Framework',
		'c-sharp' 		=> 'C#',		
		'php' 			=> 'PHP',		
		'java' 			=> 'Java',		
		'python' 		=> 'Python',		
		'node-js' 		=> 'NodeJS',		
		'ruby-on-rails' => 'Ruby on Rails',		
		'typescript' 	=> 'Typescript',		
		'frontend' 		=> 'Frontend',		
		'react' 		=> 'React',		
		'ios' 			=> 'iOS',		
		'android' 		=> 'Android',		
		'javascript' 	=> 'JavaScript',
		'angular' 		=> 'Angular',
		'angular' 		=> 'AngularJS',
		'vue-js' 		=> 'Vue',
		'vue-js' 		=> 'VueJS',
	];
}

/**
 * Move array item to top
 * 
 * @return Array
 */
function fs_move_item_to_first($heystack, $needle) {
	// Check if $heystack is an array, if not, stop
	if (!is_array($heystack)) {
		return;
	}
	
	// Loop through the array of arrays to find the index of the name
	foreach ($heystack as $key => $value) {
		if (strtolower($value['name']) == strtolower($needle)) {
			// Remove the array at the current index
			$removed_array_item = array_splice($heystack, $key, 1);
			
			// Add the removed array to the beginning of the main array
			array_unshift($heystack, $removed_array_item[0]);

			// Break out of the loop
			break;
		}
	}

	return $heystack ?? [];
}

/**
 * Privacy Policy Popup
 */
function fs_data_privacy_popup() {
	// show popup only on these pages
	$show_in_pages = [76, 33];

	if (
		is_page() 
		&& in_array(get_the_ID(), $show_in_pages)
	) {
		if ($_COOKIE['is-proceed'] == null) {
            // get theme setting options
            $theme_settings             = get_option( 'fullscale_theme_settings' );
            $data_privacy_popup_content = $theme_settings['data_privacy_popup_content'];
			?>

				<div class="modal data-privacy" id="draggable">
					<header id="draggable_header">
						<h3>Data Privacy</h3>
					</header>
					
					<div class="body">
						<?php echo wpautop($data_privacy_popup_content); ?>
						<p><a href="javascript: void(0);" id="btn_proceed" class="btn">Proceed</a></p>
					</div>
				</div>
			<?php
		}
	}
}
// add_action('wp_footer', 'fs_data_privacy_popup');