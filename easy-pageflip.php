<?php
/*
	Plugin Name: Easy Page Flip
	Version: 1.1.0
	Description: Easy Page Flip is a plugin where you create a Virtual Magazine in few clicks, this plugin has with base <a href="http://builtbywill.com/code/booklet/" target="_blank">jQuery Booklet</a> and is compatible with <a href="http://wordpress.org/plugins/wp-pagenavi/" target="_blank">WP-PageNavi</a>
	Author: CHR Designer
	Author URI: http://www.chrdesigner.com
	Plugin URI: http://www.chrdesigner.com/plugin/easy-pageflip.zip
	License: A slug describing license associated with the plugin (usually GPL2)
	Text Domain: easy-page-flip
	Domain Path: /languages/
*/

load_plugin_textdomain( 'easy-page-flip', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );

require_once('includes/custom_post_easy_pageflip.php');
require_once('includes/pageflip_meta_box.php');

add_image_size( 'chr-imagem-revista', 280, 380, true  );

add_filter( 'use_default_gallery_style', '__return_false' );

add_action( 'wp_enqueue_scripts', 'chr_script_booklet' );
function chr_script_booklet() {
	// Script Easing
	wp_register_script('add-jquery-easing-jquery-ui', plugins_url( '/assets/js/jquery.easing.1.3.js' , __FILE__ ), array('jquery', 'jquery-ui-core', 'jquery-ui-draggable'));
    wp_enqueue_script('add-jquery-easing-jquery-ui');
    // Script BookLet
    wp_register_script('jquery-booklet', plugins_url('/assets/js/jquery.booklet.latest.min.js' , __FILE__ ), array('jquery'));
    wp_enqueue_script('jquery-booklet');
    //Style BookLet
    wp_register_style( 'style-booklet', plugins_url('/assets/css/jquery.booklet.latest.css' , __FILE__ ) );
	wp_enqueue_style( 'style-booklet' );
	//Style PageFlip
    wp_register_style( 'style-easy-pageflip', plugins_url('/assets/css/style-easy-pageflip.css' , __FILE__ ) );
	wp_enqueue_style( 'style-easy-pageflip' );
}

require_once('includes/content-pageflip-single.php');
require_once('includes/content-pageflip-list.php');

/*
 * Add Custom Css Field in Admin Page
 */
add_action('admin_head', 'epf_admin_css');
function epf_admin_css() {
    global $post_type;
    if (($_GET['post_type'] == 'pageflip') || ($post_type == 'pageflip')) :      
        echo "<link type='text/css' rel='stylesheet' href='" . plugins_url('/admin/css/style.min.css', __FILE__) . "' />";
    endif;
}

function chr_admin_style_epc() {
    wp_register_style( 'style.epc.admin', plugins_url('/admin/css/style.epc.admin.css' , __FILE__ ), false, '1.0.0', false );
    wp_enqueue_style( 'style.epc.admin' );
}
add_action( 'admin_enqueue_scripts', 'chr_admin_style_epc' );

add_action( 'init', 'epf_chr_buttons' );
function epf_chr_buttons() {
	add_filter("mce_external_plugins", "epf_chr_add_buttons");
    add_filter('mce_buttons', 'epf_chr_register_buttons');
}

function epf_chr_add_buttons($plugin_array) {
	$plugin_array['chrEpf'] = plugins_url( '/admin/tinymce/chrEpf-tinymce.js' , __FILE__ );
	return $plugin_array;
}

function epf_chr_register_buttons($buttons) {
	array_push( $buttons, 'showEpf' );
	return $buttons;
}