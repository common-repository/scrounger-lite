<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function scrounger_show_form( $content ) {
	if ( !is_singular( get_option( 'scrounger_view_type' ) ) ) {
		return $content;
	}
	return $content . scrounger_get_form( true );
}
