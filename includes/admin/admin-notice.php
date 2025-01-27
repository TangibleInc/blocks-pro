<?php

namespace tangible\framework;
use tangible\framework;

framework\register_admin_notice(function() use ($plugin) {

  $welcome_notice_key = $plugin->setting_prefix . '_welcome_notice';

  if ( framework\is_admin_notice_dismissed( $welcome_notice_key ) ) {
    return;
  }

  if (isset($_GET['dismiss_admin_notice'])) {
    // Remove notice after clicking link to welcome page
    framework\dismiss_admin_notice( $welcome_notice_key );
    return;
  }

  ?>
  <div class="notice notice-info is-dismissible"
    data-tangible-admin-notice="<?php echo $welcome_notice_key; ?>"
  >
    <p>Welcome to <b><?php echo $plugin->title; ?></b>. Please see the <a href="<?php echo framework\get_plugin_settings_page_url($plugin, 'welcome'); ?>&dismiss_admin_notice=true">plugin settings page</a> to get started.</p>
  </div>
  <?php

});
