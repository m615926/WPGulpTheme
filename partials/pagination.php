<!-- <ul class="uk-pagination uk-flex-center">
  <li><a href="#"><span uk-pagination-previous=""></span></a></li>
  <li class="uk-active"><span>1</span></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li class="uk-disabled"><span>...</span></li>
  <li><a href="#">7</a></li>
  <li><a href="#"><span uk-pagination-next=""></span></a></li>
</ul> -->

<?php 

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
    'prev_text' =>'<span uk-pagination-previous></span>',
    'next_text' =>'<span uk-pagination-next></span>',
));
if( is_array( $pages ) ) {
    $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
    echo '<ul class="uk-pagination uk-flex-center">';
    foreach ( $pages as $page ) {
        echo "<li>$page</li>";
    }
    echo '</ul>';
    echo '<script>jQuery(".page-numbers.current").parent().addClass("uk-active")</script>';
}

?>