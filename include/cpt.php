<?php 

	/** Post Type: NEW */
	function cpt_course() {

		$cptName = 'new';
		$cptNameEn = 'course';
		$cptTax = $cptNameEn . '_tax';
		$hasTax = true;

		$labels = array(
			"name" => __( $cptName, "" ),
			"singular_name" => __( $cptName, "" ),
			"menu_name" => __( $cptName, "" ),
			"all_items" => __( "所有", "" ),
			"add_new" => __( "新增", "" ),
			"add_new_item" => __( "新增", "" ),
			"edit_item" => __( "編輯", "" ),
			"new_item" => __( "新項目", "" ),
			"view_item" => __( "檢視", "" ),
			"view_items" => __( "檢視", "" ),
			"search_items" => __( "搜尋", "" ),
			"not_found" => __( "無結果", "" ),
			"not_found_in_trash" => __( "無結果", "" ),
		);

		$args = array(
			"label" => __( $cptName, "" ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"has_archive" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"rewrite" => array( "slug" => $cptNameEn, "with_front" => true ),
			"query_var" => true,
			"menu_icon" => "dashicons-welcome-learn-more", // https://developer.wordpress.org/resource/dashicons/#arrow-left
			"supports" => array( "title" ),
		);

		register_post_type( $cptNameEn, $args );

		$labels = array(
			"name" => __( "課程標籤", "" ),
			"singular_name" => __( "課程標籤", "" ),
			"menu_name" => __( "課程標籤", "" ),
			"all_items" => __( "所有", "" ),
			"edit_item" => __( "編輯", "" ),
			"view_item" => __( "檢視", "" ),
			"update_item" => __( "更新", "" ),
			"add_new_item" => __( "新增", "" ),
			"new_item_name" => __( "新增", "" ),
			"search_items" => __( "搜尋", "" ),
		);

		$args = array(
			"label" => __( "課程標籤", "" ),
			"labels" => $labels,
			"public" => true,
			"hierarchical" => true,
			"label" => "課程標籤",
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => array( 'slug' => 'course-tag', 'with_front' => true, ),
			"show_admin_column" => true,
			"show_in_rest" => false,
			"rest_base" => 'course-tag',
			"show_in_quick_edit" => true,
		);


		if( $hasTax ){
			register_taxonomy( 'course-tag', array( $cptNameEn ), $args );
		}
	}
	add_action( 'init', 'cpt_course' );
