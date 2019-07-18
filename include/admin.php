<?php 
/*------------------------------------*\
    後臺相關功能
\*------------------------------------*/

function new_login_logo() {                                                             /* 自訂登入畫面LOGO */ 
     echo '<style type="text/css">.login h1 a { background-image:url('.get_template_directory_uri().'/assets/img/logo.svg) !important; background-size: contain!important; width:320px!important; }</style>';
}
add_action('login_head', 'new_login_logo' );


function custom_loginlogo_url($url) { return get_bloginfo('url'); }                     /* 變更自訂登入畫面上LOGO的連結 */ 
add_filter( 'login_headerurl', 'custom_loginlogo_url' );


function put_my_title(){ return ('OSSFORCE'); }                                        /* 變更自訂登入畫面上LOGO的Hover所出現的標題 */
add_filter('login_headertitle', 'put_my_title');


function remove_wp_logo( $wp_admin_bar ) { $wp_admin_bar->remove_node( 'wp-logo' ); }   /* 移除控制台左上角WP-LOGO */ 
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );


function custom_dashboard_footer () {                                                   /* 修改後台底下的wordpress文字宣告 */ 
    echo '官網維護單位 : <a href="http://nongdesign.com/">弄弄設計</a>。後台如有任何問題, 請聯絡<a href="http://nongdesign.com/">弄弄設計</a>'; 
} 
add_filter('admin_footer_text', 'custom_dashboard_footer');


function change_footer_admin () {return '&nbsp;';}                                      /* 隱藏後台右下角wp版本號 */ 
add_filter('admin_footer_text', 'change_footer_admin', 9999);


function change_footer_version() {return ' ';}
add_filter( 'update_footer', 'change_footer_version', 9999);

/* 強制關閉後台登入首頁的小工具 */ 
function wpc_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        // 活動
    //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);        // 現況
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);  // 近期迴響
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);   // 收到新鏈結
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);          // 外掛
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);        // 快貼
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);      // 近期草稿
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);            // WordPress Blog
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);          // Other WordPress News
}
add_action('wp_dashboard_setup', 'wpc_dashboard_widgets');


/* 在後臺加入自訂 JS、CSS */ 
function custom_admin_res() {
    // $url = get_bloginfo('template_directory') . '/js/custom-wp-admin.js';
    echo '<style>html{background-color:#f1f1f1;}.acf-background-transparent .acf-fields{background: none; border: 0;}.acf-background-transparent .acf-fields > .acf-field{padding: 0;} .user-rich-editing-wrap,.user-syntax-highlighting-wrap,.user-admin-color-wrap,.user-comment-shortcuts-wrap,.user-admin-bar-front-wrap,.user-language-wrap,.user-url-wrap,.user-description-wrap,.user-sessions-wrap,.user-profile-picture,.user-googleplus-wrap,.term-description-wrap,.hidden,.post-new-php #studentList,.post-new-php #applyStatus,.post-new-php #applyMeta,.post-new-php #orderStatus,.post-new-php #orderBuyer,.post-new-php #orderApplyList{display:none;}.acf-bl > li{display:table!important;} .acf-repeater.-block>table>tbody>tr>td{border-top-color: #ccc;
    border-top-width: 10px;}#adminmenu li.wp-menu-separator{height:3px;background:#ccc;}</style><script>jQuery("#woocommerce_dashboard_status h2 span").html("訂單狀態");</script>';
}
add_action('admin_footer', 'custom_admin_res');


/* 允許後臺上傳 svg */
function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );



// 後台右上角會員按鈕-改成"登出"字樣
function custom_logout_link() {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu( array(
        'id'    => 'wp-custom-logout',
        'title' => '登出',
        'parent'=> 'top-secondary',
        'href'  => wp_logout_url()
    ) );
    $wp_admin_bar->remove_menu('my-account');
}
add_action( 'wp_before_admin_bar_render', 'custom_logout_link' );



//移除後台上方檢視留言按鈕
//移除後台上方"+新增"按鈕
function my_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu( 'new-content' );
    $wp_admin_bar->remove_node( 'updates' );
    $wp_admin_bar->remove_node( 'view' );
}
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );



//隱藏後台發文"可見度(隱私文章)"選項
add_action('add_meta_boxes', function() {
    add_action('admin_head', function() {
        echo <<<EOS
<style type="text/css">
#visibility {
    display: none;
}
</style>
EOS;
    });
});



//特色圖片名稱修改
function cyb_filter_gettext_with_context( $translated, $original, $context, $domain ) {

    // Use the text string exactly as it is in the translation file
    if ( $translated == "精選圖片" ) {
        $translated = "封面";
  }
  if ( $translated == "移除精選圖片" ) {
        $translated = "移除封面";
  }
  if ( $translated == "設定精選圖片" ) {
        $translated = "設定封面";
    }
    return $translated;
}
add_filter( 'gettext_with_context', 'cyb_filter_gettext_with_context', 10, 4 );

function wps_change_role_name() {
  global $wp_roles;
  if ( ! isset( $wp_roles ) )
    $wp_roles = new WP_Roles();
    $wp_roles->roles['subscriber']['name'] = '會員';
    $wp_roles->role_names['subscriber'] = '會員';
  }
add_action('init', 'wps_change_role_name');

function disable_dashboard() {
    if (current_user_can('subscriber')) {
        wp_redirect(home_url());
        exit;
    }
}
//add_action('admin_init', 'disable_dashboard');

// 修改 mail 格式
function wpse27856_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );


//acf global option setting
// if( function_exists('acf_add_options_page') ) {
    
//     acf_add_options_page(array(
//     'page_title' 	=> '首頁輪播',
//         'menu_title' 	=> '首頁輪播',
//         'menu_slug'     => 'slideshow',
//         'icon_url'      => 'dashicons-images-alt'
//     ));

//     acf_add_options_page(array(
//     'page_title' 	=> '證書母版上傳',
//         'menu_title' 	=> '證書母版上傳',
//         'menu_slug'     => 'cert',
//         'icon_url'      => 'dashicons-warning'
//     ));
    
//     acf_add_options_page(array(
//     'page_title' 	=> '首頁快訊',
//         'menu_title' 	=> '首頁快訊',
//         'menu_slug'     => 'news',
//         'icon_url'      => 'dashicons-star-filled'
//   ));
// }

// Removes from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
// Removes from admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

// Function to change email address
function wpb_sender_email( $original_email_address ) {
    return 'service@domain.com';
}
 
// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return '寄件人名稱';
}
 
// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );