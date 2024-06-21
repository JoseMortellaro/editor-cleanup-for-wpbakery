<?php

defined( 'FDP_ECFWPB_PLUGIN_DIR' ) || exit;

if( isset( $_GET['page'] ) && in_array( $_GET['page'],array( 'eos_dp_ecfwpb_outer','eos_dp_ecfwpb_inner','eos_dp_ecfwpb_actions' ) ) ){
  //Clean settings page and load scripts
  remove_all_actions( 'parse_request' );
  if( function_exists( 'eos_dp_remove_other_admin_notices' ) ){
    add_action( 'admin_init','eos_dp_remove_other_admin_notices' );
  }
  if( function_exists( 'eos_dp_scripts' ) ){
    add_action( 'admin_enqueue_scripts', 'eos_dp_scripts',999999 );
  }
  if( function_exists( 'eos_dp_dequeue_stylesheets' ) ){
    add_action( 'admin_enqueue_scripts', 'eos_dp_dequeue_stylesheets',999999 );
    add_action( 'admin_head', 'eos_dp_dequeue_stylesheets',999999 );
    add_action( 'admin_print_scripts', 'eos_dp_dequeue_stylesheets',999999 );
  }
  //Add notice to the footer
  add_action( 'fdp_after_save_button',function(){
    ?>
    <p style="margin-top:64px"><?php esc_html_e( 'Many thanks for using Editor Cleanup For WPBakery with Freesoul Deactivate Plugins, the plugin to selectively disable all other plugins where you don\'t need them','editor-cleanup-for-wpbakery' ); ?></p>
    <?php
  } );
}

add_filter( 'fdp_pages',function( $pages ){
  //Add settings page to FDP pages
  $pages[] = 'eos_dp_ecfwpb_inner';
  $pages[] = 'eos_dp_ecfwpb_outer';
  $pages[] = 'eos_dp_ecfwpb_actions';
  return $pages;
} );
add_action( 'admin_menu',function(){
  $titles = eos_dp_ecfwpb_titles();
  //Add sub menu settings page
  add_submenu_page( 'vc-general',esc_attr__( 'Frontend Editor Cleanup','editor-cleanup-for-wpbakery' ),esc_attr__( 'Frontend Editor Cleanup','fdp-ecfwpb' ),apply_filters( 'eos_dp_settings_capability','activate_plugins' ),'eos_dp_ecfwpb_outer','eos_dp_ecfwpb_outer_settings_callback',999999 );
  $n = 10;
  foreach( $titles as $k => $title ){
    add_submenu_page( null,esc_attr( $titles[$k] ),esc_attr( $titles[$k] ),apply_filters( 'eos_dp_settings_capability','activate_plugins' ),'eos_dp_ecfwpb_'.$k,'eos_dp_ecfwpb_'.$k.'_settings_callback',$n );
    ++$n;
  }
},999999 );

//Callback function for the outer settings page
function eos_dp_ecfwpb_outer_settings_callback(){
  if( isset( $_GET['page'] ) && 'eos_dp_ecfwpb_outer' === $_GET['page'] ){
    require_once FDP_ECFWPB_PLUGIN_DIR.'/admin/ecfwpb-outer-settings.php';
  }
}
//Callback function for the inner settings page
function eos_dp_ecfwpb_inner_settings_callback(){
  if( isset( $_GET['page'] ) && 'eos_dp_ecfwpb_inner' === $_GET['page'] ){
    require_once FDP_ECFWPB_PLUGIN_DIR.'/admin/ecfwpb-inner-settings.php';
  }
}
//Callback function for the actions settings page
function eos_dp_ecfwpb_actions_settings_callback(){
  if( isset( $_GET['page'] ) && 'eos_dp_ecfwpb_actions' === $_GET['page'] ){
    require_once FDP_ECFWPB_PLUGIN_DIR.'/admin/ecfwpb-actions-settings.php';
  }
}

function eos_dp_ecfwpb_inline_style( $column_count ){
  ?>
  <style id="fdp-wpbakery">
  #eos-dp-wpbakery-section #eos-dp-setts td:first-child:before{content:none !important}
  #eos-dp-setts{column-count:<?php echo esc_attr( $column_count ); ?>}
  #eos-dp-setts tr {
    -webkit-column-break-inside:avoid;
    column-break-inside:avoid
  }
  #eos-dp-setts .eos-dp-name-td {
      padding:0 10px;
      background: transparent;
      border: none;
  }
  #eos-dp-setts td .eos-dp-td-chk-wrp input {
      width: 24px;
      height: 24px;
  }
  @media screen and (max-width:1350px){
    #eos-dp-setts{column-count:<?php echo esc_attr( min( 2,$column_count ) ); ?>}
  }
  @media screen and (max-width:967px){
    #eos-dp-setts{column-count:1}
  }
  </style>
  <?php
}

//Settings page navigation
function eos_dp_ecfwpb_navigation(){
  $titles = eos_dp_ecfwpb_titles();
  ?>
  <nav id="fdp-wpbakery-navigation" style="margin-top:32px;margin-bottom:32px">
  <?php
  foreach( $titles as $k => $title ){ ?>
    <a id="fdp-wpbakery-<?php echo esc_attr( $k ); ?>-setts-url" class="button<?php echo isset( $_GET['page'] ) && $k === str_replace( 'eos_dp_ecfwpb_','',sanitize_key( $_GET['page'] ) ) ? ' eos-active' : ''; ?>" href="<?php echo esc_attr( esc_url( admin_url( 'admin.php?page=eos_dp_ecfwpb_'.esc_attr( $k ) ) ) ); ?>"><?php echo esc_html( $title ); ?></a>
  <?php } ?>
  </nav>
  <p><?php esc_html_e( '(If you need to clean up the backend editor, use the "Edit single" options that you will find for each post type on Freesoul Deactivate Plugins => Backend => Backend Singles)','editor-cleanup-for-wpbakery' ); ?></p>
  <?php
}

//Array of titles for each settings page
function eos_dp_ecfwpb_titles(){
  return array(
    'outer' => esc_attr__( 'Outer Frontend Editor','fdp-ecfwpb' ),
    'inner' => esc_attr__( 'Inner Frontend Editor','fdp-ecfwpb' ),
    'actions' => esc_attr__( 'Editor Actions','fdp-ecfwpb' ),
  );
}

//It adds a settings link to the action links in the plugins page
add_filter( "plugin_action_links_editor-cleanup-for-wpbakery/editor-cleanup-for-wpbakery.php", 'eos_dp_ecfwpb_plugin_add_settings_link' );
//It adds a settings link to the action links in the plugins page
function eos_dp_ecfwpb_plugin_add_settings_link( $links ) {
    $settings_link = '<a class="fdp-wpbakery" href="'.admin_url( 'admin.php?page=eos_dp_ecfwpb_outer' ).'">'.esc_html__( 'Settings','editor-cleanup-for-wpbakery' ).'</a>';
    array_push( $links, $settings_link );
  	return $links;
}
