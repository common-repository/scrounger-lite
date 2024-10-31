<?php

/*----------------------------------------------------------------------------------------------------------------------

Plugin Name: Scrounger Lite
Description: Добавляет форму для сбора денежных средств на сайте с помощью перевода на Яндекс.Деньги
Version: 0.9.3
Author: Денис Бидюков 
Author URI: http://www.dampi.ru/
Plugin URI: https://www.dampi.ru/sobiraem-pozhertvovaniya-s-plaginom-poproshayka-dlya-wordpress

    Copyright 2017  Бидюков Денис  (email: ya@dampi.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

----------------------------------------------------------------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SCROUNGER_DIR', dirname( __FILE__ ) );
define( 'SCROUNGER_INC_DIR', SCROUNGER_DIR . '/inc' );
define( 'SCROUNGER_TMPL_DIR', SCROUNGER_INC_DIR . '/tmpl' );
define( 'SCROUNGER_FUNC_DIR', SCROUNGER_INC_DIR . '/functions' );
define( 'SCROUNGER_LANG_DIR', SCROUNGER_INC_DIR . '/langs' );

define( 'SCROUNGER_URI', 'https://www.dampi.ru/sobiraem-pozhertvovaniya-s-plaginom-poproshayka-dlya-wordpress' );

define( 'SCROUNGER_JS', plugins_url( '/scrounger.js' , __FILE__ ) );
define( 'SCROUNGER_STYLES', plugins_url( '/scrounger.css' , __FILE__ ) );

$files  = scandir( SCROUNGER_FUNC_DIR );

foreach( $files as $file ) {
	if ( ! preg_match( "/\.php$/i", $file ) ) {
		continue;
	}
	require_once SCROUNGER_FUNC_DIR. '/' . $file;
}

/*

Прием и обработка уведомлений

*Заработает в следующих версиях.

if ( isset( $_POST['operation_id'] ) && 'on' == get_option( 'scrounger_receiving_notification' ) ) {
	$sha1_hash = hash(
		"sha1",
		$_POST['notification_type']."&".
		$_POST['operation_id']."&".
		$_POST['amount']."&".
		$_POST['currency']."&".
		$_POST['datetime']."&".
		$_POST['sender']."&".
		$_POST['codepro']."&".
		get_option( 'scrounger_secret' )."&".
		$_POST['label']
	);
	if ( $sha1_hash == $_POST['sha1_hash'] && eregi( $_SERVER['HTTP_HOST'], $_POST['label'] ) ) {
		list( $label, $post_id ) = explode( "-", $_POST['label'] );
		$post = get_post( $post_id, ARRAY_A );
		$payments = get_option( 'scrounger_payments' );
		$current_payment = array(
			'withdraw_amount'	=> $_POST['withdraw_amount'],
			'amount'		=> $_POST['amount'],
			'datetime'		=> $_POST['datetime'],
			'page_id'		=> $post['ID'],
			'page_title'		=> $post['post_title'],
			'page_url'		=> get_permalink($post['ID'])
		);
		if ( is_ssl() ) {
			if ( 'on' == get_option( 'scrounger_fio' ) ) {
				$current_payment['firstname']	= $_POST['firstname'];
				$current_payment['lastname']	= $_POST['lastname'];
				$current_payment['fathersname']	= $_POST['fathersname'];
			}
			if ( 'on' == get_option( 'scrounger_email' ) ) {
				$current_payment['email']	= $_POST['email'];
			}
			if ( 'on' == get_option( 'scrounger_tel' ) ) {
				$current_payment['phone']	= $_POST['phone'];
			}
			if ( 'on' == get_option( 'scrounger_address' ) ) {
				$current_payment['city']	= $_POST['city'];
				$current_payment['street']	= $_POST['street'];
				$current_payment['building']	= $_POST['building'];
				$current_payment['suite']	= $_POST['suite'];
				$current_payment['flat']	= $_POST['flat'];
				$current_payment['zip']		= $_POST['zip'];
			}
		}
		$payments[] = $current_payment;
		update_option( 'scrounger_payments', $payments );
		update_option( 'scrounger_payments_count', ( get_option( 'scrounger_payments_count' ) + 1 ) );
	} else if ( isset( $_POST['test_notification'] ) ) {
		$payments = get_option( 'scrounger_payments' );
		$current_payment = array(
			'withdraw_amount'	=> ceil( $_POST['amount'] ),
			'amount'		=> $_POST['amount'],
			'datetime'		=> $_POST['datetime'],
			'page_id'		=> 123,
			'page_title'		=> 'Заголовок статьи',
			'page_url'		=> get_site_url() . '/zagolovok-stati'
		);
		$payments[] = $current_payment;
		update_option( 'scrounger_payments', $payments );
		update_option( 'scrounger_payments_count', ( get_option( 'scrounger_payments_count' ) + 1 ) );
	} else {
		header("HTTP/1.0 404 Not Found"); 
		header("HTTP/1.1 404 Not Found"); 
		header("Status: 404 Not Found");
		exit;
	}
}

*/

if ( 'on' == get_option( 'scrounger_receiving_notification' ) ) {
	add_filter('add_menu_classes', 'scrounger_pending_payments_indicator');
}

add_action( 'admin_menu', 'scrounger_add_settings_page' );
add_action( 'admin_print_scripts', 'scrounger_js' );

add_action( 'plugins_loaded', 'scrounger_load_textdomain' );

if ( 'yes' == get_option( 'scrounger_on' ) ) {
	add_filter( 'the_content', 'scrounger_show_form' );
	add_shortcode( 'show_scrounger', 'scrounger_shortcode' );
}
add_action( 'admin_print_styles', 'scrounger_css' );
register_activation_hook( __FILE__, 'scrounger_activate' );
add_action( 'deactivated_plugin', 'scrounger_deactivation', 10, 2 );
