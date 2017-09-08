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

	$fsmwThemeOptions = array('light', 'dark');

	$fsmwFloatOptions = array('left', 'right');


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

//Load social links data
function fsmw_load_data() {
	
}

//Get html
function fsmw_get_html( $options ) {
	
}

//Main function
function fsmw() {
	
}

//Display the widget
add_action( 'the_content', 'fsmw' );


//add options page on the settings menu
function fsmw_options_page() {
	add_options_page( 'Social Media Icons Widget Settings', 'Floating Social Media Icons', 'edit_plugins', 'fsmw', 'fsmw_options_page_view' );
}
add_action('admin_menu', 'fsmw_options_page');

function fsmw_options_page_view() {
	//on form post

	/*$_POST['fsmw_facebook'], $_POST['fsmw_twitter'], $_POST['fsmw_linkedin'], $_POST['fsmw_youtube'], $_POST['fsmw_googleplus'], $_POST['fsmw_instagram']))*/

	if(isset($_POST['Submit'])) {
		$postValues = array(
			'facebook' => esc_attr( $_POST('fsmw_facebook' )),
			'twitter' => esc_attr( $_POST('fsmw_twitter' )),
			'linkedin' => esc_attr($_POST('fsmw_linkedin')),
			'youtube' => esc_attr($_POST('fsmw_youtube')),
			'googleplus' => esc_attr($_POST('fsmw_googleplus')),
			'instagram' => esc_attr($_POST('fsmw_instagram'))
			);
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
