<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="page-title">
	<h1><?php _e( 'Настройки попрошайки', 'scrounger-lite' ); ?></h1>
</div>


<?php

$errors = array();

$button_codes = array(
	'01',
	'02',
	'03',
	'04'
);

if ( isset( $_POST['scrounger'] ) && is_array( $_POST['scrounger'] ) ) {
	check_admin_referer( 'save_settings_scrounger', 'scrounger_wp_nonce' );
	$scrounger = $_POST['scrounger'];
	if ( isset( $scrounger['account'] ) && is_numeric( $scrounger['account'] ) ) {
		update_option(
			'scrounger_account',
			preg_replace( '/[^0-9]/', '',  $scrounger['account'] )
		);
	} else {
		$errors[] = array(
			'name' => 'account',
			'error' => __( 'Необходимо указать номер кошелька для приема платежей', 'scrounger' )
		);
	}

	if ( ! $errors ) {
		update_option(
			'scrounger_on',
			( isset( $scrounger['on'] ) ? 'yes' : 'no' )
		);
	} else {
		$errors[] = array(
			'name' => 'on',
			'error' => __( 'Блок до сих пор не включен, устаните ошибки и попробуйте снова', 'scrounger' )
		);
	}

	update_option(
		'scrounger_title',
		( isset( $scrounger['title'] ) ? sanitize_text_field( $scrounger['title'] ) : "" )
	);
	update_option(
		'scrounger_payment_type_choice',
		( isset( $scrounger['payment-type-choice'] ) ? 'on' : "off" )
	);
	update_option(
		'scrounger_mobile_payment_type_choice',
		( isset( $scrounger['mobile-payment-type-choice'] ) ? 'on' : "off" )
	);
	update_option(
		'scrounger_button_text',
		( isset( $scrounger['button-text'] ) && in_array( $scrounger['button-text'], $button_codes ) ? $scrounger['button-text'] : "03" )
	);
	update_option(
		'scrounger_comment' ,
		( isset( $scrounger['comment'] ) ? 'on' : "off" )
	);
	update_option(
		'scrounger_hint',
		( isset( $scrounger['hint'] ) ? sanitize_text_field( $scrounger['hint'] ) : "" )
	);
	update_option(
		'scrounger_default_sum',
		( isset( $scrounger['default-sum'] ) ? preg_replace( '/[^0-9]/', '', $scrounger['default-sum'] ) : "" )
	);
	update_option(
		'scrounger_fio',
		( isset( $scrounger['fio'] ) ? 'on' : "off" )
	);
	update_option(
		'scrounger_email',
		( isset( $scrounger['email'] ) ? 'on' : "off" )
	);
	update_option(
		'scrounger_tel',
		( isset( $scrounger['tel'] ) ? 'on' : "off" )
	);
	update_option(
		'scrounger_address',
		( isset( $scrounger['address'] ) ? 'on' : "off" )
	);
	update_option(
		'scrounger_success_url',
		( isset( $scrounger['successURL'] ) ? esc_url_raw( $scrounger['successURL'] , array( 'http', 'https' ) ) : "" )
	);
	update_option(
		'scrounger_clean_options',
		( isset( $scrounger['clean_options'] ) ? 'yes' : 'no' )
	);
	if ( ! $errors ) {
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
	<?php } else { ?>
	<div id="setting-error-settings_updated" class="error settings-error notice is-dismissible">
		<p>
			<strong>
				<?php _e( 'Не все настройки были сохранены.', 'scrounger-lite' ); ?>
			</strong>
		</p>
		<button type="button" class="notice-dismiss">
			<span class="screen-reader-text">
				<?php _e( 'Скрыть это уведомление.', 'scrounger-lite' ); ?>
			</span>
		</button>
	</div>
	<?php } ?>
<?php } ?>

<script type="text/javascript">
	var scrounger_errors =  <?php echo json_encode( $errors, true ); ?>;
</script>

<div class="scrounger_main">
	<div class="scounger_main__left">
		<form action="" method="post">
			<?php wp_nonce_field( 'save_settings_scrounger', 'scrounger_wp_nonce' ); ?>

			<div>
				<p>
					<label>
						<input type="checkbox" <?php echo ( 'yes' == get_option( 'scrounger_on' ) ? "checked" : "" ); ?> name="scrounger[on]" id="scrounger_on" value="on"/> 
						<?php _e( 'Включить попрошайку', 'scrounger-lite' ); ?>
					</label>
					<p class="scrounger_error" id="error-on"></p>
					<span class="scrounger_comment">
						<?php _e( 'Отметьте этот чекбокс для включения показа блока.', 'scrounger-lite' ); ?>
						<br />
						<?php _e( '<b>Обратите внимание</b>: блок будет включен лишь в том случае, если все поля заполнены корректно.', 'scrounger-lite' ); ?>
					</span>
				</p>
			</div>
			<div>
				<h2><?php _e( 'Заголовок блока', 'scrounger-lite' ); ?></h2>
				<input type="text" name="scrounger[title]" id="scrounger_title_fild" value="<?php echo esc_html( get_option( 'scrounger_title' ) ); ?>" placeholder="<?php _e( 'Ввеите текст заголовка', 'scrounger-lite' ); ?>" style="width: calc(100% - 50px);margin: 10px auto;"/>
			</div>
			<div>
				<h2><?php _e( 'Получатель переводов', 'scrounger-lite' ); ?></h2>
				<p>
					<input type="text" name="scrounger[account]" value="<?php echo preg_replace( '/[^0-9]/', '', get_option( 'scrounger_account' ) ); ?>" placeholder="<?php _e( 'Номер кошелька в сервисе Янденкс.Деньги', 'scrounger-lite' ); ?>" style="width: calc(100% - 50px);margin: 10px auto;"/>
				</p>
				<p class="scrounger_error" id="error-account"></p>
				<span class="scrounger_comment">
					<?php _e( 'Необходимо указать номер Вашего кошелька в сервисе Яндекс Деньги на который планируется получать платежи с сайта.', 'scrounger-lite' ); ?>
					<br />
					<?php _e( '<b>Обратите внимание</b>: если у вас анонимный кошелек, подойдет только кнопка с банковской картой. Как только баланс кошелька достигнет 15 000 рублей, вы не сможете принимать новые переводы. <a target="_blank" href="https://money.yandex.ru/security/identification">Проверить статус</a>', 'scrounger-lite' ); ?>
				</span>
			</div>
			<div>
				<h2><?php _e( 'Принимаемые типы платежей', 'scrounger-lite' ); ?></h2>
				<p>
					<label>
						<input type="checkbox" <?php echo ( 'on' == get_option( 'scrounger_payment_type_choice' ) ? "checked" : "" ); ?> rel='update_change' name="scrounger[payment-type-choice]" id="scrounger_payment_type_choice" value="on"/> 
						<?php _e( 'Платежи с карт Visa и MasterCard', 'scrounger-lite' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" <?php echo ( 'on' == get_option( 'scrounger_mobile_payment_type_choice' ) ? "checked" : "" ); ?> rel='update_change' name="scrounger[mobile-payment-type-choice]" id="scrounger_mobile_payment_type_choice" value="on"/> 
						<?php _e( 'Платежи со счета мобильного телефона', 'scrounger-lite' ); ?>
					</label>
				</p>
			</div>
			<div>
				<h2><?php _e( 'Сумма по умолчанию', 'scrounger-lite' ); ?></h2>
				<p>
					<input type="text" rel="update_blur" name="scrounger[default-sum]" style="width: 100px;" id="scrounger_default_sum" value="<?php echo preg_replace( '/[^0-9]/', '',  get_option( 'scrounger_default_sum' ) ); ?>"/>  руб.
				</p>
				<span class="scrounger_comment">
					<?php _e( 'Не советую указывать сумму, если конечно речь идет о пожертвованиях', 'scrounger-lite' ); ?>
				</span>
			</div>
			<div>
				<h2><?php _e( 'Текст на кнопке', 'scrounger-lite' ); ?></h2>
				<select name="scrounger[button-text]" id="scrounger_button_text" rel='update_change'>
					<option <?php echo ( "03" == get_option( 'scrounger_button_text' ) ? "selected" : "" ); ?> value="03"> Перевести </option>
					<option <?php echo ( "02" == get_option( 'scrounger_button_text' ) ? "selected" : "" ); ?> value="02"> Купить </option>
					<option <?php echo ( "01" == get_option( 'scrounger_button_text' ) ? "selected" : "" ); ?> value="01"> Оплатить </option>
					<option <?php echo ( "04" == get_option( 'scrounger_button_text' ) ? "selected" : "" ); ?> value="04"> Подарить </option>
				</select>
			</div>
			<div>
				<h2><?php _e( 'Комментарий плательщика', 'scrounger-lite' ); ?></h2>
				<label>
					<input type="checkbox" <?php echo ( 'on' == get_option( 'scrounger_comment' ) ? "checked" : "" ); ?> rel='update_change' name="scrounger[comment]" id="scrounger_comment" value="on"/> 
					<?php _e( 'Очень нужен', 'scrounger-lite' ); ?>
				</label>
				<p>
					<textarea rel='update_blur' style="width: 300px;height: 100px;margin: 10px auto;" name="scrounger[hint]" placeholder="<?php _e( 'Подсказка к полю', 'scrounger-lite' ); ?>" id="scrounger_hint"><?php echo esc_html(  get_option( 'scrounger_hint' ) ); ?></textarea>
				</p>
				<span class="scrounger_comment">
					<?php _e( 'Этот текст будет отображен в качестве подсказки к полю для ввода комментария, где пользователь может добавить текст любого содержания', 'scrounger-lite' ); ?>
				</span>
			</div>
			<div>
				<h2><?php _e( 'Какие данные запрашивать', 'scrounger-lite' ); ?></h2>
				<p>
					<label>
						<input type="checkbox" <?php echo ( 'on' == get_option( 'scrounger_fio' ) ? "checked" : "" ); ?> name="scrounger[fio]" value="on"/> 
						<?php _e( 'Фамилия имя отчество', 'scrounger-lite' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" <?php echo ( 'on' == get_option( 'scrounger_email' ) ? "checked" : "" ); ?> name="scrounger[email]" value="on"/> 
						<?php _e( 'Адресс электронной почты', 'scrounger-lite' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" <?php echo ( 'on' == get_option( 'scrounger_tel' ) ? "checked" : "" ); ?> name="scrounger[tel]" value="on"/> 
						<?php _e( 'Номер мобильного телефона' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" <?php echo ( 'on' == get_option( 'scrounger_address' ) ? "checked" : "" ); ?> name="scrounger[address]" value="on"/> 
						<?php _e( 'Адрес доставки', 'scrounger-lite' ); ?>
					</label>
				</p>
				<span class="scrounger_comment">
					<?php printf( __( 'Данная информация будет запрошена после того, как пользователь нажмет кнопку и перейдет к оплате на страницу Яндекса. %s', 'scrounger' ), ( is_ssl() ? __( 'Эта информация будет передана вместе с уведомлением о платеже на сайт, а так же будет отображатся на странице «<a href="https://money.yandex.ru/actions" target="_blank">Мои операции</a>» Вашего кошелька в системе Яндекс.Деньги.' , 'scrounger') : __( 'Поскольку на Вашем сайте отсутствует HTTPS, то данная информация, являющаяся персональной, не будет передаваться Яндексом в уведомлении о платеже, в уведомлении будет передаваться техническая информация.', 'scrounger' ) ) ); ?>
				</span>
			</div>
			<div>
				<h2><?php _e( 'Адрес для редиректа', 'scrounger-lite' ); ?></h2>
				<p>
					<input type="text" name="scrounger[successURL]" value="<?php echo esc_url( get_option( 'scrounger_success_url' ) ); ?>"/>
				</p>
				<span class="scrounger_comment">
					<?php _e( 'Пользователь попадет на указанную страницу по завершению оплаты', 'scrounger-lite' ); ?>
				</span>
			</div>
			<div>
				<h2><?php _e( 'Хранение настроек плагинай', 'scrounger-lite' ); ?></h2>
				<p>
					<label>
						<input type="checkbox" <?php echo ( 'yes' == get_option( 'scrounger_clean_options' ) ? "checked" : "" ); ?> name="scrounger[clean_options]" id="scrounger_clean_options" value="on"/> 
						<?php _e( 'Удалять настройки плагина при деактивации', 'scrounger-lite' ); ?>
					</label>
				</p>
			</div>
			<div>
				<p>
					<input type="submit" class="button button-primary" value="<?php _e( 'Сохранить изменения', 'scrounger-lite' ); ?>"/>
				</p>
			</div>
		</form>
	</div>
	<div class="scounger_main__right">
		<h2><?php _e( 'Виджет', 'scrounger-lite' ); ?></h2>
		<h2 align="center" id="scrounger_title"><?php echo esc_html( get_option( 'scrounger_title' ) ); ?></h2>
		<iframe id="scrounger_frame" src="" width="450" height="280" frameborder="0" scrolling="no">
		</iframe>
		<?php
		if ( 'on' == get_option( 'scrounger_promote' ) ) {
			echo '<p align="right"><a target="_blank" rel="nofollow" href="' . esc_url( SCROUNGER_URI ) .'">' . __( 'Плагин «попрошайка»', 'scrounger' ) . '</a></p>';
		}
		?>
	</div>

</div>

