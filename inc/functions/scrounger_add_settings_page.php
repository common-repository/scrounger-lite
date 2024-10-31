<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function scrounger_add_settings_page() {
	add_menu_page( __( 'Настройки попрошайки', 'scrounger-lite' ), __( 'Попрошайка', 'scrounger-lite' ), 'manage_options', 'scrounger', 'scrounger_show_settings_form', 'dashicons-sos' );
	add_submenu_page( 'scrounger', __( 'Настройки показа', 'scrounger-lite' ), __( 'Настройки показа', 'scrounger-lite' ), 'manage_options', 'scrounger-view', 'scrounger_show_settings_views' );
	if ( 'on' == get_option( 'scrounger_receiving_notification' ) ) {
		add_submenu_page( 'scrounger', __( 'Платежи', 'scrounger-lite' ), __( 'Принятые платежи', 'scrounger-lite' ), 'manage_options', 'scrounger-payments', 'scrounger_show_payments' );
	}
}
