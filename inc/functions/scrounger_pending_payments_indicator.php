<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function scrounger_pending_payments_indicator( $menu ) {
//<span class="screen-reader-text">0 уведомлений</span>
//
	if ( get_option( 'scrounger_payments_count' ) > 0 ) {
 		$links = array( 'scrounger', 'scrounger-view' );
		foreach ($menu as $menu_key => $menu_data) {
			if ( in_array( $menu_data[2], $links ) ) {
				$menu[$menu_key][0] .= ' <span class="update-plugins count-' . get_option( 'scrounger_payments_count' ) . '"><span class="plugin-count" aria-hidden="true">' . get_option( 'scrounger_payments_count' ) . '</span></span>';
			}
		}
	}
	return $menu;
}
