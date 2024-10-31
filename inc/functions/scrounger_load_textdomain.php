<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function scrounger_load_textdomain() {
	 load_plugin_textdomain( 'scrounger-lite', false, '/' . plugin_basename( SCROUNGER_LANG_DIR ) . '/' );
}
