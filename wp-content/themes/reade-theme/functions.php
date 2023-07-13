<?php
define('TEXTDOMAIN', 'acl-theme');
define("IS_LOCAL", wp_get_environment_type() == "local");
define("REMOTE_URL", "https://reade.wpengine.com");

ini_set("error_log", get_stylesheet_directory() . "/debug.txt");

require_once( get_stylesheet_directory() . '/lib/theme-setup.php' );
require_once( get_stylesheet_directory() . '/lib/theme-enqueue-scripts.php' );
require_once( get_stylesheet_directory() . '/template-parts/blocks/_index.php' );

//PRE_LAUNCH
require_once (get_stylesheet_directory() . '/lib/tf-db-sync.php');

/** Language Switching -> handled by gtranslate */
// add_action( 'after_setup_theme', 'reade_load_theme_textdomain' );
// function reade_load_theme_textdomain() {
//   load_theme_textdomain( 'reade-theme', get_template_directory() . '/languages' );
// }