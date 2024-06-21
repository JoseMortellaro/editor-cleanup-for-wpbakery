<?php
/*
  Plugin Name: Editor Cleanup For WPBakery [ecfwpb]
  Description: mu-plugin automatically installed by Editor CLeanup For WPBakery
  Version: 0.0.1
  Plugin URI: https://freesoul-deactivate-plugins.com/
  Author: Jose Mortellaro
  Author URI: https://josemortellaro.com/
  License: GPLv2
*/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly
define( 'FDP_ECFWPB_MU_VERSION','0.0.1' );

if( isset( $_GET['vc_action'] ) && 'vc_inline' === esc_attr( $_GET['vc_action'] ) ){
  add_filter( 'fdp_backend_plugins',function( $plugins ){
    return eos_dp_ecfwpb_plugins( $plugins,'outer' );
  } );
}
elseif( isset( $_GET['vc_editable'] ) && 'true' === $_GET['vc_editable'] && isset( $_GET['vc_post_id'] ) && absint( $_GET['vc_post_id'] ) > 0 ){
  add_filter( 'fdp_frontend_plugins',function( $plugins ){
    return eos_dp_ecfwpb_plugins( $plugins,'inner' );
  } );
}

add_filter( 'fdp_ajax_plugins',function( $plugins ){
  $wpbakery_actions = array(
    'vc_edit_form',
    'vc_save',
    'vc_editable--vc_post_id--_vcnonce--post_id--vc_inline--action--shortcodes'
  );
  if( isset( $_REQUEST['action'] ) && in_array( sanitize_text_field( $_REQUEST['action'] ),$wpbakery_actions ) ){
    return eos_dp_ecfwpb_plugins( $plugins,'actions' );
  }
  return $plugins;
} );

add_filter( 'fdp_ajax_plugins',function( $plugins ){
  if( isset( $_REQUEST['action'] ) && in_array( sanitize_text_field( $_REQUEST['action'] ),array( 'eos_dp_save_wpbakery_outer_settings','eos_dp_save_wpbakery_inner_settings','eos_dp_save_wpbakery_actions_settings' ) ) ){
    return array_merge( array( 'js_composer/js_composer.php' ),fdp_ecfwpb_plugins( $plugins ) );
  }
  return $plugins;
} );

function eos_dp_ecfwpb_plugins( $plugins,$page ){
  $opts = eos_dp_get_option( 'fdp_wpbakery' );
  $wpbakery_plugins = isset( $opts[$page] ) ? $opts[$page] : array();
  $fdp_plugins = fdp_ecfwpb_plugins( $plugins );
  $wpbakery_plugins = $wpbakery_plugins && is_array( $wpbakery_plugins ) ? array_merge( $wpbakery_plugins,$fdp_plugins ) : $fdp_plugins;
  foreach( $wpbakery_plugins as $plugin ){
    if( in_array( $plugin,$plugins ) || in_array( $plugin,$fdp_plugins ) ){
      unset( $plugins[array_search( $plugin,$plugins )] );
    }
  }
  return array_values( $plugins );
}

function fdp_ecfwpb_plugins( $plugins ){
  $arr = array(
    'freesoul-deactivate-plugins/freesoul-deactivate-plugins.php',
    'editor-cleanup-for-wpbakery/editor-cleanup-for-wpbakery.php'
  );
  if( in_array( 'freesoul-deactivate-plugins-pro/freesoul-deactivate-plugins-pro.php',$plugins ) ){
    $arr[] = 'freesoul-deactivate-plugins-pro/freesoul-deactivate-plugins-pro.php';
  }
  return $arr;
}
