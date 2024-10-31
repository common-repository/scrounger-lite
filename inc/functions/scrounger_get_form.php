<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function scrounger_get_form( $show_title=true ) {
	$scrounger_title = '';
	if ( '' != get_option( 'scrounger_title' ) && true == $show_title ) {
		$scrounger_title = '<p style="font-weight: bold;font-size: 25px;text-align: center;">' . esc_html( get_option( 'scrounger_title' ) ) . '</p
>';
	}
	$scrounger_form = '<div style="width:450px;margin: 20px auto 20px auto;"><iframe src="' . esc_url( scrounger_get_form_url() ) . '" width="' . intval( get_option( 'scrounger_width' ) ) . '" height="' . intval( get_option( 'scrounger_height' ) ) . '" frameborder="0" scrolling="no"></iframe>';
	if ( 'on'== get_option( 'scrounger_promote' ) ) {
		$scrounger_form .= '<p align="right"><a target="_blank" rel="nofollow" href="' . esc_url( SCROUNGER_URI ) .'">' . __( 'Плагин «попрошайка»', 'scrounger-lite' ) . '</a></p>';
	}
	$scrounger_form .= '</div>';
	return $scrounger_title . $scrounger_form;
}
