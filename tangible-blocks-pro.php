<?php
/**
 * Plugin Name: Tangible Blocks - Pro
 * Plugin URI: https://tangibleblocks.com/pro
 * Description: Extend Tangible Blocks with Pro features: third-party plugin integrations - Easy Digital Downloads, Events Calendar, Gravity Forms, LearnDash, LifterLMS, WooCommerce
 * Version: 3.2.0
 * Author: Team Tangible
 * Author URI: https://teamtangible.com
 * License: GPLv2 or later
 */
use tangible\framework;
use tangible\updater;

define( 'TANGIBLE_BLOCKS_PRO_VERSION', '3.2.0' );

$module_path = is_dir(
  ($path = __DIR__ . '/../../tangible') // Module
) ? $path : __DIR__ . '/vendor/tangible'; // Plugin

require_once $module_path . '/framework/index.php';
require_once $module_path . '/betterdash/index.php';
require_once $module_path . '/betterlifter/index.php';
require_once $module_path . '/template-system/index.php';
require_once $module_path . '/template-system-pro/index.php';
require_once $module_path . '/fields/index.php';
require_once $module_path . '/fields-pro/index.php';
require_once $module_path . '/updater/index.php';

/**
 * Get plugin instance
 */
function tangible_blocks_pro($instance = false) {
  static $plugin;
  return $plugin ? $plugin : ($plugin = $instance);
}

add_action('plugins_loaded', function() {

  $plugin    = framework\register_plugin([
    'name'           => 'tangible-blocks-pro',
    'title'          => 'Tangible Blocks Pro',
    'setting_prefix' => 'tangible_blocks_pro',

    'version'        => TANGIBLE_BLOCKS_PRO_VERSION,
    'file_path'      => __FILE__,
    'base_path'      => plugin_basename( __FILE__ ),
    'dir_path'       => plugin_dir_path( __FILE__ ),
    'url'            => plugins_url( '/', __FILE__ ),
    'assets_url'     => plugins_url( '/assets', __FILE__ ),
  ]);

  framework\register_plugin_dependencies($plugin, [
    'title' => 'Tangible Blocks',
    'url' => 'https://tangibleblocks.com/',
    'active' => function_exists('tangible_blocks'),
  ]);

  tangible_blocks_pro( $plugin );

  updater\register_plugin([
    'name' => $plugin->name,
    'file' => __FILE__,
    // 'license' => ''
  ]);

  if (!framework\has_all_plugin_dependencies($plugin)) return;

  // Features loaded will have in their local scope: $framework, $plugin, ...

  $template_system = tangible_template_system();

  $loop      = $template_system->loop;
  $logic     = $template_system->logic;
  $html      = $template_system->html;
  $interface = $template_system->interface;

  require_once __DIR__.'/includes/index.php';

}, 10);
