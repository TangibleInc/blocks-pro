<?php
/**
 * Plugin Name: Tangible Blocks - Pro
 * Plugin URI: https://tangibleblocks.com/pro
 * Description: Extend Tangible Blocks with Pro features: third-party plugin integrations (Easy Digital Downloads, Events Calendar, Gravity Forms, LearnDash, LifterLMS, WooCommerce); Form module; Cloud access
 * Version: 3.0.0
 * Author: Team Tangible
 * Author URI: https://teamtangible.com
 * License: GPLv2 or later
 */

define( 'TANGIBLE_BLOCKS_PRO', '3.0.0' );

require_once __DIR__ . '/vendor/tangible/plugin-framework/index.php';
require_once __DIR__ . '/vendor/tangible/plugin-updater/index.php';
require_once __DIR__ . '/vendor/tangible/template-system-pro/index.php';

/**
 * Get plugin instance
 */
function tangible_blocks_pro($instance = false) {
  static $plugin;
  return $plugin ? $plugin : ($plugin = $instance);
}

add_action('plugins_loaded', function() {

  $framework = tangible();
  $plugin    = $framework->register_plugin([
    'name'           => 'tangible-blocks-pro',
    'title'          => 'Tangible Blocks Pro',
    'setting_prefix' => 'tangible_blocks_pro',

    'version'        => TANGIBLE_BLOCKS_PRO,
    'file_path'      => __FILE__,
    'base_path'      => plugin_basename( __FILE__ ),
    'dir_path'       => plugin_dir_path( __FILE__ ),
    'url'            => plugins_url( '/', __FILE__ ),
    'assets_url'     => plugins_url( '/assets', __FILE__ ),
  ]);

  $plugin->register_dependencies([
    'tangible-blocks/tangible-blocks.php' => [
      'title' => 'Tangible Blocks',
      'url' => 'https://tangibleblocks.com/',
      'fallback_check' => function() {
        return function_exists('tangible_blocks');
      }
    ]
  ]);

  tangible_blocks_pro( $plugin );

  tangible_plugin_updater()->register_plugin([
    'name' => $plugin->name,
    'file' => __FILE__,
    // 'license' => ''
  ]);

  if (!$plugin->has_all_dependencies()) return;

  // Features loaded will have in their local scope: $framework, $plugin, ...

  $template_system = tangible_template_system();

  $loop      = $template_system->loop;
  $logic     = $template_system->logic;
  $html      = $template_system->html;
  $interface = $template_system->interface;

  require_once __DIR__.'/includes/index.php';

}, 10);
