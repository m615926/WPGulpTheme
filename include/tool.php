<?php 
/*------------------------------------*\
    Custom PHP API
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

// 限制字數，第一個參數丟字串，第二個丟字數
function mySubstr($str,$num){
  return mb_substr($str,0,$num,'utf8');
}