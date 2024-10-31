<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function scrounger_show_payments() {
	update_option( 'scrounger_payments_count', 0 );
	require_once SCROUNGER_TMPL_DIR . '/payments-list.php';
}
