<?php
/**
 * @package Easy_Child_Theme
 * @version 1.0
 */
/*
 Plugin Name: Easy Child Theme
 Plugin URI: http://ashokg.in/easy-child-theme
 Description: Hassle Free Child Theme Creator.
 Author: Ashok G
 Version: 1.0
 Author URI: http://ashokg.in/
 */
 
add_action('admin_menu', 'easy_ctc_menu');

function easy_ctc_menu(){
	add_menu_page( 'Easy Child Theme Creator', 'Easy Child Theme Creator', 'manage_options', 'easy-ctc', 'easy_ctc_menu_init' );
}

function easy_ctc_menu_init(){
	include __DIR__."/options.php";
	
}