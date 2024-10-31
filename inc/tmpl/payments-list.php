<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="page-title">
	<h1><?php _e( 'Принятые платежи', 'scrounger-lite' ); ?></h1>
</div>


<?php

if ( isset( $_POST['scrounger'] ) && is_array( $_POST['scrounger'] ) ) {
	check_admin_referer( 'save_settings_scrounger', 'scrounger_wp_nonce' );
	$scrounger = $_POST['scrounger'];


	?> <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
		<p>
			<strong>
				<?php _e( 'Настройки сохранены.', 'scrounger-lite' ); ?>
			</strong>
		</p>
		<button type="button" class="notice-dismiss">
			<span class="screen-reader-text">
				<?php _e( 'Скрыть это уведомление.', 'scrounger-lite' ); ?>
			</span>
		</button>
	</div>

<?php } ?>

<script type="text/javascript">
	var scrounger_payments =  <?php echo json_encode( get_option( 'scrounger_payments' ), true ); ?>;
</script>

<table class="">
	<thead>
	<tr>
		<th scope="col" id="title" class="">ФИО</th>
		<th scope="col" id="title" class="">ФИО</th>
	</tr>
	</thead>

	<tbody id="the-list">
	<tr>
		<td scope="col" id="title" class=""></td>
	</tr>
	</tbody>
</table>
