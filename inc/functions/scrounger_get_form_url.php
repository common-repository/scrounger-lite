<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function scrounger_get_form_url() {
	$page_title = get_the_title();
	return 'https://money.yandex.ru/embed/shop.xml?'
		. 'account='. get_option( 'scrounger_account' )
		. ( 'on' == get_option( 'scrounger_payment_type_choice' ) ? '&payment-type-choice=on' : '' )
		. ( 'on' == get_option( 'scrounger_mobile_payment_type_choice' ) ? '&mobile-payment-type-choice=on' : '' )
		. ( 'on' == get_option( 'scrounger_comment' ) ? '&comment=on' : '' )
		. '&targets-hint=' . get_option( 'scrounger_hint' )
		. '&default-sum=' . get_option( 'scrounger_default_sum' )
		. '&button-text=' . get_option( 'scrounger_button_text' )
		. '&hint=' . get_option( 'scrounger_hint' )
		. '&successURL=' . get_option( 'scrounger_success_url' )
		. ( 'on' == get_option( 'scrounger_fio' ) ? '&fio=on' : '' )
		. ( 'on' == get_option( 'scrounger_email' ) ? '&mail=on' : '' )
		. ( 'on' == get_option( 'scrounger_phone' ) ? '&phone=on' : '' )
		. ( 'on' == get_option( 'scrounger_address' ) ? '&address=on' : '' )
		. '&label=' . $_SERVER['HTTP_HOST'] . '-' . get_the_ID()
		. '&targets=Спасибо за «' . $page_title . '»'
		. '&quickpay=shop'
		. '&writer=seller';
}
