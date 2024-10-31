<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="page-title">
	<h1><?php _e( 'Настройки показа попрошайки', 'scrounger-lite' ); ?></h1>
</div>

<?php

$errors = array();

if ( isset( $_POST['scrounger'] ) && is_array( $_POST['scrounger'] ) ) {
	check_admin_referer( 'save_settings_scrounger', 'scrounger_wp_nonce' );
	$scrounger = $_POST['scrounger'];
	$post_types = array();

	if ( isset( $scrounger['post'] ) ) {
		$post_types[] = 'post';
	}
	if ( isset( $scrounger['page'] ) ) {
		$post_types[] = 'page';
	}
	if ( !$post_types ) {
		$errors[] = array(
			'name' => 'post_types',
			'error' => __( 'Обратите внимание что для показа блока необходимо выбрать хотя бы один пункт иначе блок не будет показываться', 'scrounger' )
		);
	}
	update_option(
		'scrounger_view_type',
		$post_types
	);

	update_option(
		'scrounger_promote',
		( isset( $scrounger['promote'] ) ? "on" : "off" )
	);

	if ( isset( $scrounger['receiving_notification'] ) ) {
		if ( '' != $scrounger['secret'] ) {
			update_option(
				'scrounger_receiving_notification',
				"on"
			);
			update_option(
				'scrounger_secret',
				sanitize_text_field( $scrounger['secret'] )
			);
		} else {
			$errors[] = array(
				'name' => 'secret',
				'error' => __( 'Необходимо указать секретное слово, в противном случае уведомления не будут приниматься системой', 'scrounger' )
			);
		}
	} else {
		update_option(
			'scrounger_receiving_notification',
			"off"
		);
	}
	if ( isset( $scrounger['width'] ) && '' != $scrounger['width'] ) {
		if ( is_numeric( $scrounger['width'] ) ) {
			update_option(
				'scrounger_width',
				intval( $scrounger['width'] )
			);
		} else {
			$errors[] = array(
				'name' => 'width',
				'error' => __( 'Ширина должна указываться исключительно цифрами', 'scrounger' )
			);
		}
	} else {
		$errors[] = array(
			'name' => 'width',
			'error' => __( 'Необходимо указать ширину блока', 'scrounger' )
		);
	}

	if ( isset( $scrounger['height'] ) && '' != $scrounger['height'] ) {
		if ( is_numeric( $scrounger['height'] ) ) {
			update_option(
				'scrounger_height',
				intval( $scrounger['height'] )
			);
		} else {
			$errors[] = array(
				'name' => 'height',
				'error' => __( 'Высота должна указываться исключительно цифрами', 'scrounger' )
			);
		}
	} else {
		$errors[] = array(
			'name' => 'height',
			'error' => __( 'Необходимо указать высоту блока', 'scrounger' )
		);
	}

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

<?php

}

$scrounger_params = array(
	'comment'			=> get_option( 'scrounger_comment' ),
	'hint'				=> get_option( 'scrounger_hint' ),
	'default_sum'			=> get_option( 'scrounger_default_sum' ),
	'mobile_payment_type_choice'	=> get_option( 'scrounger_mobile_payment_type_choice' ),
	'payment_type_choice'		=> get_option( 'scrounger_payment_type_choice' ),
	'button_text'			=> get_option( 'scrounger_button_text' )
);

?>

<script type="text/javascript">
	var scrounger_errors =  <?php echo json_encode( $errors, true ); ?>;
	var scrounger_params =  <?php echo json_encode( $scrounger_params, true ); ?>;
</script>


<div class="scrounger_main">
	<div class="scounger_main__left">
		<form action="" method="post">
			<?php wp_nonce_field( 'save_settings_scrounger', 'scrounger_wp_nonce' ); ?>
			<div>
				<h2><?php _e( 'Где показывать?', 'scrounger-lite' ); ?></h2>
				<p>
					<label>
						<input type="checkbox" <?php echo ( in_array( 'post', get_option( 'scrounger_view_type' ) ) ? "checked" : "" ); ?> name="scrounger[post]" value="on" /> 
						<?php _e( 'В записях в блоге', 'scrounger-lite' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="scrounger[page]" <?php echo ( in_array( 'page', get_option( 'scrounger_view_type' ) ) ? "checked" : "" ); ?> value="on" /> 
						<?php _e( 'На страницах', 'scrounger-lite' ); ?>
					</label>
				</p>
				<p class="scrounger_error" id="error-post_types"></p>
			</div>
			<div>
				<h2><?php _e( 'Размеры блока формы', 'scrounger-lite' ); ?></h2>
				<p>
					<input type="text" name="scrounger[width]" value="<?php echo get_option( 'scrounger_width' ); ?>" placeholder="<?php _e( 'Ширина', 'scrounger-lite' ); ?>" class="scrounger_block_size"/> 
					x 
					<input type="text" name="scrounger[height]" value="<?php echo get_option( 'scrounger_height' ); ?>" placeholder="<?php _e( 'Высота', 'scrounger-lite' ); ?>" class="scrounger_block_size"/> px
				</p>
				<p class="scrounger_error" id="error-width"></p>
				<p class="scrounger_error" id="error-height"></p>
				<span class="scrounger_comment">
					<?php _e( 'Редактировать эти парметры есть смысл если форма не помещается в границы iframe', 'scrounger-lite' ); ?>
				</span>
			</div>
			<!--div>
				<h2><?php _e( 'Получение и обработка уведомлений о платежах', 'scrounger-lite' ); ?></h2>
				<p>
					<label>
						<input type="checkbox" name="scrounger[receiving_notification]" id="scrounger_receiving_notification" <?php echo ( 'on' == get_option( 'scrounger_receiving_notification' ) ? "checked" : "" ); ?> value="on" /> 
						<?php _e( 'Принимать уведомления о платежах', 'scrounger-lite' ); ?>
					</label>
				</p>
				<span class="scrounger_comment">
					<?php printf( __( 'При выборе этой опции сайт будет принимать уведомлениия о платежах и сохранять их в базе данных сайта. Для приема уведомлений о платежах необходимо настроить уведомления на странице в <a href="https://money.yandex.ru/myservices/online.xml" target="_blank">личном кабинете</a>. В качестве адреса для приема уведомлений укажите %s ', 'scrounger' ), get_site_url() ); ?>
				</span>
				<div <?php echo ( 'off' == get_option( 'scrounger_receiving_notification' ) ? 'style="display:none;"' : '' ); ?> id="scrounger_secret">
					<p>
						<input type="text" name="scrounger[secret]" value="<?php echo get_option( 'scrounger_secret' ); ?>" placeholder="<?php _e( 'Секретное слово', 'scrounger-lite' ); ?>"/>
					</p>
					<span class="scrounger_comment">
						<?php _e( 'Секретное слово, которое Вы указали при настройке приема уведомлений', 'scrounger-lite' ); ?>
					</span>
				</div>
				<p class="scrounger_error" id="error-secret"></p>
			</div-->
			<div>
				<h2><?php _e( 'Помощь в продвижении плагина', 'scrounger-lite' ); ?></h2>
				<p>
					<label>
						<input type="checkbox" name="scrounger[promote]" id="scrounger_promote" <?php echo ( 'on' == get_option( 'scrounger_promote' ) ? "checked" : "" ); ?> value="on" /> 
						<?php _e( 'Помочь в продвижении плагина', 'scrounger-lite' ); ?>
					</label>
				</p>
				<span class="scrounger_comment">
					<?php _e( 'Под блоком будет отображаться ссылка на плагин и люди увидев у вас этот плагин смогут установить его себе', 'scrounger-lite' ); ?>
				</span>
			</div>
			<div>
				<p>
					<input type="submit" class="button button-primary" value="<?php _e( 'Сохранить изменения', 'scrounger-lite' ); ?>"/>
				</p>
			</div>
		</form>
	</div>
	<div class="scounger_main__right">
		<h2><?php _e( 'Шорт-код', 'scrounger-lite' ); ?></h2>
		<p>
			<input type="text" disabled value="<?php echo get_option( 'scrounger_shortcode' ); ?>" style="width: calc(100% - 50px);margin: 10px auto;"/>
		</p>
		<span class="scrounger_comment">
			<?php _e( 'Вставьте этот шорткод в текст в любом месте сайта для отображения формы приема платежей.', 'scrounger-lite' ); ?>
		</span>
		<h2><?php _e( 'Виджет', 'scrounger-lite' ); ?></h2>
		<h2 align="center" id="scrounger_title"><?php echo esc_html(  get_option( 'scrounger_title' ) ); ?></h2>
		<iframe id="scrounger_frame" src="" width="450" height="280" frameborder="0" scrolling="no">
		</iframe>
		<p <?php echo ( 'off' == get_option( 'scrounger_promote' ) ? 'style="display: none;"' : '' ); ?> align="right" id="scrounger_promote_link"><a target="_blank" rel="nofollow" href="<?php echo esc_url( SCROUNGER_URI ); ?>"><?php _e( 'Плагин «попрошайка»', 'scrounger' ) ?></a></p>
	</div>
</div>

