<?php
defined( 'FDP_ECFWPB_PLUGIN_DIR' ) || exit; //Exit if not called by FDP PRO


add_action( 'admin_notices','eos_dp_ecfwpb_fdp_wpbakery_not_active' );

//Warn the user FDP is not active
function eos_dp_ecfwpb_fdp_wpbakery_not_active(){
  static $called = false;
  if( $called ) return;
  $called = true;
  ?>
  <div class="notice notice-error" style="display:block !important;padding:20px">
    <?php esc_html_e( 'Editor Cleanup For wpbakery needs that both wpbakery and Freesoul Deactivate Plugins are installed and active!','editor-cleanup-for-wpbakery' ); ?>
    <p>
    <?php
    if( file_exists( FDP_ECFWPB_PLUGINS_DIR.'/js_composer/js_composer.php' ) ){
      $url = wp_nonce_url(
        add_query_arg(
          array(
            'action' => 'activate',
            'plugin' => 'js_composer/js_composer.php',
            'plugin_status' => 'all',
            'paged' => '1'
          ),
          admin_url( 'plugins.php' )
        ),
        'activate-plugin_wpbakery/wpbakery.php'
      );
      ?>
      <a class="button" href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Activate wpbakery','editor-cleanup-for-wpbakery' ); ?></a>
      <?php
    }
    if( file_exists( FDP_ECFWPB_PLUGINS_DIR.'/freesoul-deactivate-plugins/freesoul-deactivate-plugins.php' ) ){
      $url = wp_nonce_url(
        add_query_arg(
          array(
            'action' => 'activate',
            'plugin' => 'freesoul-deactivate-plugins/freesoul-deactivate-plugins.php',
            'plugin_status' => 'all',
            'paged' => '1'
          ),
          admin_url( 'plugins.php' )
        ),
        'activate-plugin_freesoul-deactivate-plugins/freesoul-deactivate-plugins.php'
      );
      ?>
      <a class="button" href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Activate Freesouol Deactivate Plugins','editor-cleanup-for-wpbakery' ); ?></a>
      <?php
    }
    ?>
    </p>
  </div>
  <?php
}
