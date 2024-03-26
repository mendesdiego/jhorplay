<?php
if( function_exists('acf_add_options_page') ) {

	$menuBanner = acf_add_options_page(array(
		'page_title' 	=> 'Sobre (Home)',
		'menu_title' 	=> 'Sobre (Home)',
		'menu_slug' 	=> 'sobre',
		'position'     => 2,
		'redirect' 		=> false
	));

	// // add sub page
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Banner institucional',
	// 	'menu_title' 	=> 'Banner Institucional',
	// 	'menu_slug' 	=> 'banner-institucional',
	// 	'parent_slug' 	=> $menuBanner['menu_slug'],
	// ));

	// $menuBanner = acf_add_options_page(array(
	// 	'page_title' 	=> 'Lojas',
	// 	'menu_title' 	=> 'Lojas',
	// 	'menu_slug' 	=> 'lojas',
	// 	'position'     => 2,
	// 	'redirect' 		=> false
	// ));

}
