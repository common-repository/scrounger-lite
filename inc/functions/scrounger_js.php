<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function scrounger_js() {
	if ( preg_match( '/scrounger/', $_GET['page'] ) ) {
		wp_register_script( 'scrounger_js', SCROUNGER_JS );
		wp_enqueue_script( 'scrounger_js' );
	}
}
