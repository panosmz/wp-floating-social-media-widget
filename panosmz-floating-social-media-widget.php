<?php
/*
Plugin Name: Floating Social Media Widget
Description: Displays a floating social media links widget on the webpage.
Author: Panos Mazarakis
Version: 1.0
Author URI: https://panosmazarakis.com
*/

//initialize social links data
function fsmw_initialize_data() {
	$fsmwSocialMediaList = array(
		array('slug'=>'facebook','title'=>'Facebook', 'color'=>'#3b5998', 'url'=>''),
		array('slug'=>'twitter','title'=>'Twitter', 'color'=>'#4099FF', 'url'=>''),
		array('slug'=>'linkedin','title'=>'LinkedIn', 'color'=>'#007bb5', 'url'=>''),
		array('slug'=>'youtube','title'=>'Youtube', 'color'=>'#bb0000', 'url'=>''),
		array('slug'=>'googleplus','title'=>'Google+', 'color'=>'#d34836', 'url'=>''),
		array('slug'=>'instagram','title'=>'Instagram', 'color'=>'#e95950', 'url'=>''),
		);

	$fsmwThemeOptions = array(array('slug'=>'light', 'title'=>'Transparent Light'), 
							  array('slug'=>'dark',  'title'=>'Transparent Dark')
							  );

	$fsmwFloatOptions = array('slug'=>'left', 'slug'=>'right');


	$fsmwInitialData = array(
		'theme-options' => $fsmwThemeOptions,
		'float-mobile-options' => $fsmwFloatOptions,
		'float-desktop-options' => $fsmwFloatOptions,
		'theme' => $fsmwThemeOptions[0],
		'float-mobile' => $fsmwFloatOptions[0],
		'float-desktop' => $fsmwFloatOptions[0],
		'social-media-links' => $fsmwSocialMediaList
		);

	return($fsmwInitialData);
}

//updates option data
function fsmw_update_data( $data ) {
	$fsmwData = get_option('fsmw_options');

	// update social links data
	foreach ($data['socialLinks'] as $postKey => $postData) {
		$index = fsmw_get_array_index($postKey, $fsmwData['social-media-links']);
		$fsmwData['social-media-links'][$index]['url'] = $postData;
	}

	// update settings (theme)
	$fsmwData['theme'] = $data['settings']['theme'];

	update_option('fsmw_options', $fsmwData);
}

//searches array for key
function fsmw_get_array_index( $slug , $dataArray) {
	for($i = 0, $l = count($dataArray); $i < $l; ++$i) {
		if(in_array($slug, $dataArray[$i])) return $i;
	}
	return false;
}

//Main function
function fsmw( $content ) {
	$fsmwData = get_option('fsmw_options');

	$linkHtml = '<div class="fsmw-container fsmw-float-l--'.$fsmwData['float-desktop'].' fsmw-float-m--'.$fsmwData['float-mobile'].' fsmw-theme--'.$fsmwData['theme'].'">';

	foreach ($fsmwData['social-media-links'] as $socialLink) {
		if(!empty($socialLink['url'])) {
			$linkHtml .= '<a target="_blank" href="'.$socialLink['url'].'">';
			$linkHtml .= '<div class="fsmw-icon fsmw-site--'.$socialLink['slug'].'">';
			$linkHtml .= '<img src="'.plugin_dir_url( __FILE__ ).'assets/fsmw-'.$socialLink['slug'].'.png" alt="'.$socialLink['title'].'">';
			$linkHtml .= '</div></a>';
		}
	}

	$linkHtml .= '</div>';

	wp_register_style ('fsmw', plugin_dir_url( __FILE__ ).'style.css' );
	wp_enqueue_style ('fsmw');

	echo $linkHtml;
}

//Display the widget
add_filter( 'wp_footer', 'fsmw' );


//add options page on the settings menu
function fsmw_options_page() {
	add_options_page( 'Social Media Icons Widget Settings', 'Floating Social Media Icons', 'edit_plugins', 'fsmw', 'fsmw_options_page_view' );
}
add_action('admin_menu', 'fsmw_options_page');

//display widget options page
function fsmw_options_page_view() {
	//on form post
	if(isset($_POST['Submit'])) {
		$postLinks = array(
			'facebook' => esc_attr( $_POST['fsmw_facebook' ]),
			'twitter' => esc_attr( $_POST['fsmw_twitter' ]),
			'linkedin' => esc_attr($_POST['fsmw_linkedin']),
			'youtube' => esc_attr($_POST['fsmw_youtube']),
			'googleplus' => esc_attr($_POST['fsmw_googleplus']),
			'instagram' => esc_attr($_POST['fsmw_instagram'])
			);

		$postSettings = array(
			'theme' => esc_attr( $_POST['fsmw_theme'] )
			);

		$postValues = array(
			'socialLinks' => $postLinks,
			'settings' => $postSettings
			);

		fsmw_update_data($postValues);

		?>
    		<div class="notice notice-success is-dismissible">
    		    <p><?php _e( 'Settings saved!', 'fsmw-message' ); ?></p>
    		</div>
    	<?php
	}


	$fsmwData = get_option('fsmw_options');

	include( plugin_dir_path( __FILE__ ) . 'panosmz-floating-social-media-widget-settings.php');
}

//on plugin activation
function fsmw_activate() {
	//add plugin options
	if(!get_option('fsmw_options')) {
		$fsmwInitial = fsmw_initialize_data();
		add_option('fsmw_options', $fsmwInitial);
	}
}
register_activation_hook( __FILE__, 'fsmw_activate' );

//on plugin deactivation
function fsmw_deactivate() {
	//remove plugin options
	delete_option( 'fsmw_options' );
}
register_deactivation_hook(__FILE__, 'fsmw_deactivate');


//on plugin uninstall
function fsmw_uninstall() {
	//remove plugin options
	delete_option( $fsmw_options );
}
register_uninstall_hook(__FILE__, 'fsmw_uninstall');


?>
