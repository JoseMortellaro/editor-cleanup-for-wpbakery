<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

if( file_exists( WPMU_PLUGIN_DIR.'/fdp-mu-wpbakery.php' ) ){
  unlink( WPMU_PLUGIN_DIR.'/fdp-mu-wpbakery.php' );
}
eos_dp_ecfwpb_write_file( FDP_ECFWPB_PLUGIN_DIR.'/mu-plugins/fdp-mu-wpbakery.php',WPMU_PLUGIN_DIR,WPMU_PLUGIN_DIR.'/fdp-mu-wpbakery.php',true );
