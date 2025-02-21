<?php
namespace tests\blocks;

class Basic_TestCase extends \WP_UnitTestCase {
  function test_plugin_function() {
    $this->assertTrue( function_exists( 'tangible_blocks_pro' ) );
  }
  /**
   * @dataProvider _test_third_party_plugin_is_active_data
   */
  function test_third_party_plugin_is_active(
    $exists
  ) {
    $this->assertTrue( is_callable($exists) ? $exists() : $exists );
  }
  function _test_third_party_plugin_is_active_data() {
    return [
      'Advanced Custom Fields' => [
        function_exists( 'acf' )
      ],
      'Beaver Builder' => [
        class_exists( 'FLBuilder' )
      ],
      'Elementor' => [
        function() { return class_exists( 'Elementor\\Plugin' ); }
      ],

      // Integrations
      'Easy Digital Downloads' => [
        function() { return function_exists( 'EDD' ); }
      ],
      'The Events Calendar' => [
        function_exists( 'tribe_get_events' )
      ],
      // 'Gravity Forms' => [
      //   class_exists( 'GFForms' )
      // ],
      // 'LearnDash' => [
      //   defined( 'LEARNDASH_VERSION' )
      // ],
      'Lifter LMS' => [
        function_exists( 'llms' )
      ],
      'WooCommerce' => [
        function_exists( 'WC' )
      ],
    ];
  }
}
