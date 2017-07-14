<?php
/**
 * User: xuantruong
 * Date: 03/23/16
 * Time: 10:13 PM
 * Plugin Name: Add shortcode button to tinymce
 * Description: Add shortcode button to tinymce
 * Plugin URI: http://xuantruong.info/
 * Author: truong.luu
 * Author URI: http://xuantruong.info/
 * Version: 1.0.1
 *
 */
if( !defined( 'ABSPATH' ) )
    return;

define( 'ADD_SHORTCODE_BUTTON_TINYMCE_VERSION', '1.0.1' );
define( 'ADD_SHORTCODE_BUTTON_TINYMCE_BASE', dirname(__FILE__) );
define( 'ADD_SHORTCODE_BUTTON_TINYMCE_PATH', plugin_dir_url(  __FILE__ ) );

require ADD_SHORTCODE_BUTTON_TINYMCE_BASE . '/inc/add-shortcode-button-tinymce.class.php';
$addShortcodeTinymce = new Add_Shortcode_Tinymce;
register_activation_hook( ADD_SHORTCODE_BUTTON_TINYMCE_BASE . '/plugin.php', array( $addShortcodeTinymce, 'plugin_activate') );
register_deactivation_hook(  ADD_SHORTCODE_BUTTON_TINYMCE_BASE . '/plugin.php', array( $addShortcodeTinymce, 'plugin_deactivate') );