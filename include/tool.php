<?php 
/*------------------------------------*\
    新加入功能
\*------------------------------------*/
// 加入 body class 名稱
function add_slug_to_body_class($classes) {
    global $post;
    if (is_front_page()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);     // 確保只會有英數當 class
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }
    return $classes;
}
add_filter('body_class', 'add_slug_to_body_class');



// 分頁導覽
function pagination() {
    global $wp_query;
    $cats = $wp_query->get_queried_object();
    if ( $wp_query->max_num_pages <= 1 ) return; 
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'type'  => 'array',
        'prev_text' =>'<span>上一頁</span>',
        'next_text' =>'<span>下一頁</span>',
    ));
    if( is_array( $pages ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<ul class="uk-pagination uk-flex-center uk-padding-large" uk-margin>';
        foreach ( $pages as $page ) {
            echo "<li>$page</li>";
        }
        echo '</ul>';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><script>jQuery(".page-numbers.current").parent().addClass("uk-active")</script>';
    }
}



// 判斷所在位置取得頁面標題
function getTitle(){
    if( is_page('home') ) { echo ""; }
    elseif(is_category()){ single_term_title(); }
    elseif(is_singular()){ echo the_title(); } 
    elseif(is_404()) { echo '頁面錯誤'; } 
    echo ' | '.get_bloginfo('title');
}



// 如果文章有 tag 的話，則拿來做為 meta keyword
function getKeyword(){
    $posttags = get_the_tags(); 
    $i = 0;
    $len = count($posttags);
    if($posttags) {
        echo "<meta name='keywords' content='";
        foreach($posttags as $tag) {
            if ($i == $len - 1) {
                echo $tag->name;
            } else {
                echo $tag->name . ',';
            }
            $i++;
        }
        echo "'>\n";
    }
}



// 判斷所在位置取得頁面描述
function getDesp(){
    if(empty(get_the_excerpt())){
        echo get_bloginfo('description');   
    } else {
        echo get_the_excerpt();
    }
}
// 在文章頁取得作者名
function getAuthor(){
    global $post;
    if(is_single()){
        echo "<meta property='author' content='";
        $author = get_user_option('display_name', $post->post_author ); 
        echo $author;
        echo "'>\n";
    }
}



// 限制字數，第一個參數丟字串，第二個丟字數
function mySubstr($str,$num){
    return mb_substr($str,0,$num,'utf8');
}


// 增加 current menu 的 class 為 active
function special_nav_class($classes, $item){
    if( in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

// 如果沒設摘要，取得內文第一段做為摘要
function get_first_paragraph(){
    global $post;
    if(get_the_excerpt()){
        return get_the_excerpt();
    } else {
        $str = wpautop( get_the_content() );
        $str = strip_tags(str_replace(array("<q>", "</q>"), array("_", "_"), $str));
        return $str;
    }
}


add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments( $fragments ) {
    if( WC()->cart->get_cart_contents_count() !=0 ){
        $fragments['div.header-cart-count'] = '<div class="header-cart-count uk-position-center-right span uk-badge badge-small badge-red" style="top: 60%; right: 10px;">' . WC()->cart->get_cart_contents_count() . '</div>';  
        return $fragments;
    }
}

// 根據頁面標題取得 post ID
function get_post_by_title($page_title, $type = "post", $output = ARRAY_A) {
    global $wpdb;
    $post = $wpdb->get_var ( $wpdb->prepare ( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type='$type' AND post_status='publish'", $page_title ) );
    if ($post)
        return get_post ( $post, $output );
    return null;
}

function date_sort($a, $b) {
    return strtotime($a) - strtotime($b);
}