<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function scrounger_css() {
	if ( preg_match( "/scrounger/i", $_GET['page'] ) ) {
		wp_register_style( 'scrounger_main_css', SCROUNGER_STYLES );
		wp_enqueue_style( 'scrounger_main_css' );
	}
}
