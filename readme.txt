=== Editor Cleanup For WPBakery: FDP add-on to clean up the WPBakery frontend editor ===
Contributors: giuse
Tags:  visual composer, wpbakery, cleanup, debugging, conflicts
Requires at least: 4.6
Tested up to: 6.5
Stable tag: 0.0.3
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


FDP add-on to cleanup the frontend editor of WPBakery page builder. Your WPBakery frontend editor will be faster and without conflicts with other plugins.


== Description ==

Editor Cleanup For WPBakery is an add-on of <a href="https://wordpress.org/plugins/freesoul-deactivate-plugins/" target="_blank">Freesoul Deactivate Plugins</a> to clean up the frontend editor of <a href="https://wpbakery.com/" target="_blank">WPBakery</a>.

It will not only clean up the assets of other plugins, but their PHP code will not run either.

Your WPBakery frontend editor will be faster and without conflicts with other plugins.

Freesoul Deactivate Plugins and WPBakery page builder must be installed and active, in another case this plugin will not run.

If you need to clean up the backend editor of WPBakery, you need only Freesoul Deactivate Plugins. You can do the cleanup by going to Freesoul Deactivate Plugins => Backend Singles.
Then use the "Edit single" options that you will find for each post type.


== How to clean up the WPBakery editor ==
* Install and activate Freesoul Deactivate Plugins if not active yet
* Install and activate WPBakery if not active yet
* Install and activate Editor Cleanup For WPBakery
* Go to WPBakery/Page Builder => Frontend Editor Cleanup
* Click on "Outer editor cleanup" to disable plugins that the outer editor does't need (usually no plugin needed)
* Click on "Inner editor cleanup" to disable plugins that the inner editor does't need (the inner editor is like the page on frontend, but loaded inside the WPBakery editor)
* Click on "Editor actions cleanup" to disable the plugins that are called during the actions of the editor (usually no plugin needed, disabling plugins here can solve conflicts with other plugins)


== Similar add-ons for cleanup ==
* <a href="https://wordpress.org/plugins/editor-cleanup-for-oxygen/">Editor Cleanup For Oxygen</a>
* <a href="https://wordpress.org/plugins/editor-cleanup-for-elementor/">Editor Cleanup For Elementor</a>
* <a href="https://wordpress.org/plugins/editor-cleanup-for-avada/">Editor Cleanup For Avada</a>
* <a href="https://wordpress.org/plugins/editor-cleanup-for-divi-builder/">Editor Cleanup For Divi Builder</a>
* <a href="https://wordpress.org/plugins/editor-cleanup-for-flatsome/">Editor Cleanup For Flatsome</a>



== Help ==
For any question or if something doesn't work, don't hesitate to open a thread on the <a href="https://wordpress.org/support/plugin/editor-cleanup-for-wpbakery/">support forum</a>.



== Changelog ==


= 0.0.3 =
*Fix: settings not saving (need FDP >= 2.1.7)

= 0.0.2 =
*Fix: fatal error in the plugins settings page

= 0.0.1 =
*Initial release


== Screenshots ==

1. How disable plugins in the frontend editor of WPBakery
