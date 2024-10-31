<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function scrounger_deactivation( $plugin ) {
	if ( preg_match( '/^scrounger/i', $plugin ) && 'yes' == get_option( 'scrounger_clean_options' ) ) {
		delete_option( 'scrounger_on' );
		delete_option( 'scrounger_clean_options' );
		delete_option( 'scrounger_account' );
		delete_option( 'scrounger_secret' );
		delete_option( 'scrounger_title' );
		delete_option( 'scrounger_payment_type_choice' );
		delete_option( 'scrounger_mobile_payment_type_choice' );
		delete_option( 'scrounger_button_text' );
		delete_option( 'scrounger_comment' );
		delete_option( 'scrounger_hint' );
		delete_option( 'scrounger_default_sum' );
		delete_option( 'scrounger_fio' );
		delete_option( 'scrounger_email' );
		delete_option( 'scrounger_tel' );
		delete_option( 'scrounger_address' );
		delete_option( 'scrounger_success_url' );
		delete_option( 'scrounger_view' );
		delete_option( 'scrounger_view_type' );
		delete_option( 'scrounger_width' );
		delete_option( 'scrounger_height' );
		delete_option( 'scrounger_promote' );
		delete_option( 'scrounger_shortcode' );
		delete_option( 'scrounger_receiving_notification' );
		delete_option( 'scrounger_payments' );
		delete_option( 'scrounger_payments_count' );
	}
}
