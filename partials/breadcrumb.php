<?php
/**
 * Index
 *
 * Theme index.
 *
 * @since   1.0.0
 * @package WP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

</div>
<div class="uk-visible@m"
  style="background-color: #F9F9F9; border-bottom: 1px solid #EBEBEB;">
  <div class="uk-container" style="padding-top: 3px; padding-bottom: 3px;">
    <?php if( is_post_type_archive('teacher') ): ?>
    <ul class="uk-breadcrumb ">
      <li><a class="text-primary text-small text-13-m" href="#"> <img class="icon-position-fixed uk-margin-small-right" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/icon-home.svg" uk-svg>首頁</a></li>
      <li> <span class="text-small text-13-m">講師陣容</span></li>
    </ul>
    <?php elseif( is_post_type_archive() ): ?>
    <ul class="uk-breadcrumb ">
      <li><a class="text-primary text-small text-13-m" href="#"> <img class="icon-position-fixed uk-margin-small-right" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/icon-home.svg" uk-svg>首頁</a></li>
      <li> <span class="text-small text-13-m"><?php post_type_archive_title(); ?></span></li>
    </ul>
    <?php elseif( is_page() ): ?>
    <ul class="uk-breadcrumb ">
      <li><a class="text-primary text-small text-13-m" href="#"> <img class="icon-position-fixed uk-margin-small-right" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/icon-home.svg" uk-svg>首頁</a></li>
      <li> <span class="text-small text-13-m"><?php the_title(); ?></span></li>
    </ul>
    <?php elseif( is_singular() ): ?>
    <ul class="uk-breadcrumb ">
      <li><a class="text-primary text-small text-13-m" href="#"> <img class="icon-position-fixed uk-margin-small-right" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/icon-home.svg" uk-svg>首頁</a></li>
      <li><a class="text-primary text-small text-13-m" href="<?php echo home_url().'/'.get_post_type(); ?>"><?php echo get_post_type_object(get_post_type())->label; ?></a></li>
      <li> <span class="text-small text-13-m"><?php the_title(); ?></span></li>
    </ul>
    <?php elseif( is_search() ): ?>
    <ul class="uk-breadcrumb ">
      <li><a class="text-primary text-small text-13-m" href="#"> <img class="icon-position-fixed uk-margin-small-right" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/icon-home.svg" uk-svg>首頁</a></li>
      <li> <span class="text-small text-13-m">搜尋結果</span></li>
    </ul>
    <?php endif; ?>
  </div>
</div>



<!-- <?php if( is_home() ) { ?>
<p class="uk-margin-top uk-visible@m">&nbsp;</p>
<div class="uk-margin-large-top uk-position-relative">
  <h1 class="uk-text-bold text-space-small uk-text-center uk-text-left@m" style="font-size: 24px;">最新消息</h1>
  <ul class="uk-margin-remove uk-breadcrumb uk-position-top-right uk-position-small text-xsmall uk-visible@m">
    <li><a href="<?php echo home_url(); ?>">首頁</a></li>
    <li><span>最新消息</span></li>
  </ul>
</div>
<?php } ?>