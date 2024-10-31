<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function scrounger_activate() {
	if ( ! get_option( 'scrounger_clean_options' ) ) {
		add_option( 'scrounger_on', 'no' );
		add_option( 'scrounger_account', '' );
		add_option( 'scrounger_account', '' );
		add_option( 'scrounger_secret', '' );
		add_option( 'scrounger_title', __( 'Статья помогла? Поблагодари автора, он ведь старался', 'scrounger-lite' ) );
		add_option( 'scrounger_payment_type_choice', 'on' );
		add_option( 'scrounger_mobile_payment_type_choice', 'on' );
		add_option( 'scrounger_button_text', '03' );
		add_option( 'scrounger_comment' , 'on' );
		add_option( 'scrounger_hint', __( 'Тут, дорогой мой читатель, ты можешь выразить благодарность словами или задать свой вопрос', 'scrounger-lite' ) );
		add_option( 'scrounger_default_sum', '' );
		add_option( 'scrounger_fio', 'off' );
		add_option( 'scrounger_email', 'off' );
		add_option( 'scrounger_tel', 'off' );
		add_option( 'scrounger_address', 'off' );
		add_option( 'scrounger_success_url', '' );
		add_option( 'scrounger_view', false );
		add_option( 'scrounger_view_type', array( 'post', 'page' ) );
		add_option( 'scrounger_width', '450' );
		add_option( 'scrounger_height', '300' );
		add_option( 'scrounger_promote', 'off' );
		add_option( 'scrounger_shortcode', '[show_scrounger]' );
		add_option( 'scrounger_receiving_notification', 'off' );
		add_option( 'scrounger_payments', array() );
		add_option( 'scrounger_payments_count', 0 );
	}
}
