jQuery(document).ready(function() {
	var scrounger_update;
	var scrounger_prev_val;
	if (typeof scrounger_errors != 'undefined') {
		scrounger_errors.forEach(function(item, i, arr) {
			var id = '#error-' + item.name;
			jQuery(id).text(item.error);
		});
	}
	if (typeof scrounger_payments != 'undefined') {
		
	}
	jQuery("#scrounger_frame").attr("src", scrounger_get_url());
	jQuery("[rel='update_change']").change(function() {
		jQuery("#scrounger_frame").attr("src", scrounger_get_url());
	});
	jQuery("[rel='update_blur']").focus(function() {
		scrounger_prev_val = jQuery(this).val();
	});
	jQuery("[rel='update_blur']").blur(function() {
		if ( scrounger_prev_val != jQuery(this).val() ) {
			jQuery("#scrounger_frame").attr("src", scrounger_get_url());
		}
	});
	jQuery("#scrounger_title").focus(function() {
		scrounger_update = setInterval(scrounger_update_title, 50);
	});
	jQuery("#scrounger_title").blur(function() {
		clearInterval(scrounger_update);
	});
	jQuery("#scrounger_receiving_notification").change(function() {
		if (jQuery(this).is(":checked")) {
			jQuery("#scrounger_secret").show();
		} else {
			jQuery("#scrounger_secret").hide();
		}
	});
	jQuery("#scrounger_promote").change(function() {
		if (jQuery(this).is(":checked")) {
			jQuery("#scrounger_promote_link").show();
		} else {
			jQuery("#scrounger_promote_link").hide();
		}
	});
});

function scrounger_update_title() {
	jQuery("#scrounger_title").text(jQuery("#scrounger_title_fild").val());
}

function scrounger_get_url() {
	if ( jQuery("#scrounger_comment").length ) {
		return 'https://money.yandex.ru/embed/shop.xml?'
			+ (jQuery("#scrounger_comment").is(":checked") ? "&comment=on" : "")
			+ '&hint=' + jQuery("#scrounger_hint").val()
			+ '&default-sum=' + jQuery("#scrounger_default_sum").val()
			+ (jQuery("#scrounger_mobile_payment_type_choice").is(":checked") ? "&mobile-payment-type-choice=on" : "" )
			+ (jQuery("#scrounger_payment_type_choice").is(":checked") ? "&payment-type-choice=on" : "")
			+ '&button-text=' + jQuery("#scrounger_button_text").val()
			+ '&targets=Спасибо за «тут будет заголовок статьи»&writer=seller&preview=true&quickpay=shop';
	} else if (typeof scrounger_params != 'undefined') {
		return 'https://money.yandex.ru/embed/shop.xml?'
			+ ( 'on' == scrounger_params.comment ? "&comment=on" : "")
			+ '&hint=' + scrounger_params.hint
			+ '&default-sum=' + scrounger_params.default_sum
			+ ( 'on' == scrounger_params.mobile_payment_type_choice ? "&mobile-payment-type-choice=on" : "" )
			+ ( 'on' == scrounger_params.payment_type_choice ? "&payment-type-choice=on" : "")
			+ '&button-text=' + scrounger_params.button_text
			+ '&targets=Спасибо за «тут будет заголовок статьи»&writer=seller&preview=true&quickpay=shop';
	}
}
