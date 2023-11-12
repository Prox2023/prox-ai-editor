<?php
/**
 * PHPUnit bootstrap file for Prox_Ai_Editor plugin.
 */

// Get the path to the WordPress tests directory.
$_tests_dir = getenv('WP_TESTS_DIR');
//$_tests_dir = '/var/www/html/wp-includes';
var_dump($_tests_dir);

if (!$_tests_dir) {
    // Default to /tmp/wordpress-tests-lib if WP_TESTS_DIR environment variable is not set.
    $_tests_dir = rtrim(sys_get_temp_dir(), '/\\') . '/wordpress-tests-lib';
}

// Forward custom PHPUnit Polyfills configuration to PHPUnit bootstrap file, if set.
$_phpunit_polyfills_path = getenv('WP_TESTS_PHPUNIT_POLYFILLS_PATH');
if (false !== $_phpunit_polyfills_path) {
    define('WP_TESTS_PHPUNIT_POLYFILLS_PATH', $_phpunit_polyfills_path);
}

// Check if the WordPress test library is installed.
if (!file_exists("$_tests_dir/includes/functions.php")) {
    echo "Could not find $_tests_dir/includes/functions.php, have you run bin/install-wp-tests.sh?" . PHP_EOL;
    exit(1);
}

// Load the WordPress test library.
require_once "$_tests_dir/includes/functions.php";

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
    // Adjust the path to your plugin's main file as necessary.
    require dirname(__DIR__) . '/prox-ai-editor.php';
}

tests_add_filter('muplugins_loaded', '_manually_load_plugin');

// Start up the WordPress testing environment.
require "$_tests_dir/includes/bootstrap.php";
