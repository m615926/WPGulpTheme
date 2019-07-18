<?php
/**
 * Theme Functions
 *
 * Entire theme's function definitions.
 *
 * @since   1.0.0
 * @package WP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Scripts & Styles.
 *
 * Frontend with no conditions, Add Custom styles to wp_head.
 *
 * @since  1.0.0
 */

 function wpgt_scripts() {
	// Frontend scripts.
	if ( ! is_admin() ) {
		// Enqueue vendors first.
		wp_enqueue_script( 'wpgt_vendorsJs', get_template_directory_uri() . '/assets/js/vendors.min.js' );
		// Enqueue custom JS after vendors.
		wp_enqueue_script( 'wpgt_customJs', get_template_directory_uri() . '/assets/js/custom.min.js' );
		// Minified and Concatenated styles.
		wp_enqueue_style( 'wpgt_style', get_template_directory_uri() . '/style.min.css', array(), '1.0', 'all' );
	}
}
// Hook.
add_action( 'wp_enqueue_scripts', 'wpgt_scripts' );

// Disable Gutenberg
add_filter('use_block_editor_for_post', '__return_false', 10);

/*------------------------------------*\
    載入外部檔案
\*------------------------------------*/
include_once "include/cpt.php";         // 自定義文章
include_once "include/tool.php";        // 新增功能
include_once "include/admin.php";       // 後台相關設定

/*------------------------------------*\
    移除相關參數
\*------------------------------------*/
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link'); 
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('welcome_panel', 'wp_welcome_panel');
remove_filter('the_excerpt', 'wpautop');
add_filter('show_admin_bar','__return_false');
