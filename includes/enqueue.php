<?php
// local $plugin

// Enqueue frontend styles and scripts

add_action('wp_enqueue_scripts', function() use ($plugin) {

  $url = $plugin->url;
  $version = $plugin->version;

  wp_enqueue_style(
    'tangible-blocks-pro',
    $url . 'assets/build/tangible-blocks-pro.min.css',
    [],
    $version
  );

  wp_enqueue_script(
    'tangible-blocks-pro',
    $url . 'assets/build/tangible-blocks-pro.min.js',
    ['jquery'],
    $version
  );

});
