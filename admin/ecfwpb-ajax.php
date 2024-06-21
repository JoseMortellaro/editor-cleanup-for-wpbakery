<?php
defined( 'ABSPATH' ) || exit;

foreach( array( 'outer','inner','actions' ) as $page ){
	add_action( 'wp_ajax_eos_dp_save_wpbakery_'.$page.'_settings','eos_dp_save_wpbakery_'.$page.'_settings' );
}
//Saves activation/deactivation settings for wpbakery outer editor
function eos_dp_save_wpbakery_outer_settings(){
	eos_dp_save_wpbakery_settings( 'outer' );
}
//Saves activation/deactivation settings for wpbakery inner editor
function eos_dp_save_wpbakery_inner_settings(){
	eos_dp_save_wpbakery_settings( 'inner' );
}
//Saves activation/deactivation settings for wpbakery actions editor
function eos_dp_save_wpbakery_actions_settings(){
	eos_dp_save_wpbakery_settings( 'actions' );
}
//Callback for saving wpbakery editor settings
function eos_dp_save_wpbakery_settings( $page ){
	eos_dp_check_intentions_and_rights( 'eos_dp_wpbakery_'.$page.'_setts' );
	if( isset( $_POST['eos_dp_wpbakery_data'] ) && !empty( $_POST['eos_dp_wpbakery_data'] ) && isset( $_POST['page'] ) && !empty( $_POST['page'] ) ){
		$opts = eos_dp_get_option( 'fdp_wpbakery' );
		$opts[sanitize_key( $_POST['page'] )] = array_filter( explode( ',',sanitize_text_field( $_POST['eos_dp_wpbakery_data'] ) ) );
		eos_dp_update_option( 'fdp_wpbakery',$opts,false );
		echo 1;
		die();
	}
	echo 0;
	die();
}
