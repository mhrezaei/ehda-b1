$(document).ready(function () {
	forms_listener();
});

///////////////////////////////////////////////
// form vlidate for:
//    1) required    : .form-required
//    2) number      : .form-number
//    3) persian     : .form-persian
//    4) english     : .form-english
//    5) email       : .form-email
//    6) national    : .form-national
//    7) mobile      : .form-mobile
//    8) phone       : .form-phone
//    9) password    : .form-password => for check verify password field rename that to password id + '2'
//    10) datepicker : .form-datepicker => get timestamp with your input id + 'Extra'
//    11) select     : .form-select
//
// Option => add this attr to form element
//    1) no-validation="1"    :     submit form without javascript validation
//    1) no-ajax="1"          :     submit form with javascript validation without ajax method
///////////////////////////////////////////////

function forms_listener() {
	// Javascript casual commands...
	$("input.js").each(function() {
		$(this).removeClass('js');
//		window[$(this).val()]
		setTimeout($(this).val(), parseInt($(this).attr('data-delay')));
	})

	// javascript forms....
	$("form.js").each(function () {
		var $noAjax = $(this).attr('no-ajax');
		if ($noAjax && $noAjax == 1) {
			$(this).submit();
		}
		else {
			$(this).removeClass('js');
			$(this).ajaxForm({
				dataType    : 'json',
				beforeSubmit: forms_validate,
				success     : forms_responde,
				error       : forms_error
			});
			$('.form-default').focus();
		}
	});

	$(".form-default").each(function () {
		$(this).removeClass('form-default');
		$(this).focus();
	})

	// automatic direction...
	$(".atr").each(function () {
		$(this).removeClass('atl');
		$(this).on("keyup", function () {
			forms_autoDirection(this);
		});
	});

	$(".form-datepicker").each(function () {
		$datepicker_id = $(this).attr('id');
		if (!$('#' + $datepicker_id + 'Extra').length) {
			forms_date_picker(this);
		}
	});

	$(".persian").each(function () {
		$(this).removeClass('persian');
		$(this).html(forms_pd($(this).html()));
	});

	setTimeout("forms_listener()", 5);
}

function forms_validate(formData, jqForm, options) {

	//Variables...
	var $formId = jqForm.attr('id');
	var $errors = 0;
	var $errors_msg = new Array;
	var $feed = "#" + $formId + " .form-feed";
	$('#' + $formId + ' button').prop('disabled', true);
	//@TODO: hadi add optional validate


	//Form Feed...
	$($feed).removeClass('alert-success').removeClass('alert-danger').html($($feed + "-wait").html()).slideDown();

	//Checking required fields...
	$("#" + $formId + " .form-required").each(function () {
		if (forms_errorIfEmpty(this)) {
			var $err = $(this).attr('error-value');
			if ($err.length) {
				$errors_msg.push($err);
			}
			if ($errors <= 1) $(this).focus();
			$errors++;
		}
	});

	//Checking numbers fields...
	$("#" + $formId + " .form-number").each(function () {
		if (forms_errorIfNotNumber(this)) {
			var $err = $(this).attr('error-value');
			if ($err.length) {
				$errors_msg.push($err);
			}
			if ($errors <= 1) $(this).focus();
			$errors++;
		}
	});

	//Checking persian character fields...
	$("#" + $formId + " .form-persian").each(function () {
		if (forms_errorIfLang(this, 'fa')) {
			var $err = $(this).attr('error-value');
			if ($err.length) {
				$errors_msg.push($err);
			}
			if ($errors <= 1) $(this).focus();
			$errors++;
		}
	});

	//Checking english character fields...
	$("#" + $formId + " .form-english").each(function () {
		if (forms_errorIfLang(this, 'en')) {
			var $err = $(this).attr('error-value');
			if ($err.length) {
				$errors_msg.push($err);
			}
			if ($errors <= 1) $(this).focus();
			$errors++;
		}
	});

	//Checking email fields...
	$("#" + $formId + " .form-email").each(function () {
		if (forms_errorIfNotEmail(this)) {
			var $err = $(this).attr('error-value');
			if ($err.length) {
				$errors_msg.push($err);
			}
			if ($errors <= 1) $(this).focus();
			$errors++;
		}
	});

	//Checking national code fields...
	$("#" + $formId + " .form-national").each(function () {
		if (forms_errorIfNotNationalCode(this)) {
			var $err = $(this).attr('error-value');
			if ($err.length) {
				$errors_msg.push($err);
			}
			if ($errors <= 1) $(this).focus();
			$errors++;
		}
	});

	//Checking mobile numbers fields...
	$("#" + $formId + " .form-mobile").each(function () {
		if (forms_errorIfNotMobile(this)) {
			var $err = $(this).attr('error-value');
			if ($err.length) {
				$errors_msg.push($err);
			}
			if ($errors <= 1) $(this).focus();
			$errors++;
		}
	});

	//Checking phone numbers fields...
	$("#" + $formId + " .form-phone").each(function () {
		if (forms_errorIfNotPhone(this)) {
			var $err = $(this).attr('error-value');
			if ($err.length) {
				$errors_msg.push($err);
			}
			if ($errors <= 1) $(this).focus();
			$errors++;
		}
	});

	//Checking password fields...
	$("#" + $formId + " .form-password").each(function () {
		if (forms_errorIfNotVerifyPassWord(this)) {
			var $err = $(this).attr('error-value');
			if ($err.length) {
				$errors_msg.push($err);
			}
			if ($errors <= 1) $(this).focus();
			$errors++;
		}
	});

	//Checking datepicker fields...
	$("#" + $formId + " .form-datepicker").each(function () {
		if (forms_errorIfNotDatePicker(this)) {
			var $err = $(this).attr('error-value');
			if ($err.length) {
				$errors_msg.push($err);
			}
			if ($errors <= 1) $(this).focus();
			$errors++;
		}
	});

	//Checking select fields...
	$("#" + $formId + " .form-select").each(function () {
		if (forms_errorIfNotSelect(this)) {
			var $err = $(this).attr('error-value');
			if ($err.length) {
				$errors_msg.push($err);
			}
			if ($errors <= 1) $(this).focus();
			$errors++;
		}
	});

	//Checking select city fields...
	$("#" + $formId + " .selectpicker").each(function () {
		var city = $(this).val();
		if (city < 1) {
			forms_markError($(this), "error");
			var $err = $(this).attr('error-value');
			if ($err.length) {
				$errors_msg.push($err);
			}
			if ($errors <= 1) $(this).focus();
			$errors++;
		}
		else {
			forms_markError($(this), "success");
		}
	});

	if (typeof window[$formId + "_validate"] == 'function') {
		var validate = window[$formId + "_validate"](formData, jqForm, options);
		if (validate != 0) {
			$errors_msg.push(validate);
			$errors++;
		}
	}

	//result...
	var stop = $('#' + $formId).attr('no-validation');
	if (stop && stop == 1) {
		$errors = 0;
	}

	if ($errors > 0) {
		$('#' + $formId + ' button').prop('disabled', false);
		if ($errors_msg.length) {
			var $m = '<ul>';
			for (var i = 0; i < $errors_msg.length; i++) {
				$m += '<li>' + $errors_msg[i] + '</li>';
			}
			$m += '<ul>';
			$($feed).addClass('alert-danger').html($m);
		}
		else {
			$($feed).addClass('alert-danger').html($($feed + "-error").html());
		}
		return false;
	}
	else {
		return true;
	}

}

function forms_error(jqXhr, textStatus, errorThrown, $form) {
	// IMPORTANT NOTE: $formSelector contains nothing! That means forms_errror() cannot identify
	// which form it is and merely shows the errors on all available feeds!

	//Variables...
	var $formId = $form.attr('id');
	var $formSelector = "";
	var $feedSelector = $formSelector + " .form-feed";
	$('#' + $formId + ' button').prop('disabled', false);

//      if( jqXhr.status === 500 ) { //@TODO: Supposed to refresh if _token is wrong. but refreshes in all server errros
//            errorsHtml  = $($feedSelector+'-error').html()      ;
//            setTimeout(function() {window.location.reload()},1000);
//      }
	if (jqXhr.status === 422) {
		$errors = jqXhr.responseJSON;

		errorsHtml = '<ul>';
		$.each($errors, function (key, value) {
			errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
		});
		errorsHtml += '</ul>';
	}
	else {
		errorsHtml = $($feedSelector + '-error').html();
	}

	$($feedSelector).addClass("alert-danger").html(errorsHtml);

}

function forms_responde(data, statusText, xhr, $form) {
	var formSelector = "#" + $form.attr('id');
	var $feedSelector = formSelector + " .form-feed";
	$(formSelector + ' button').prop('disabled', false);

	if (data.ok == '1') {
		var cl = "alert-success";
		var me = data.message;
		if (!me) me = $($feedSelector + '-ok').html();
	}
	else {
		var cl = "alert-danger";
		var me = data.message;
//            formEffect_markError(data.fields);
//            $(data.fields).focus();
	}

	$($feedSelector).addClass(cl).html(me).show();

	//after effects...
	if (data.refresh == 1)      forms_delaiedPageRefresh(1);
	if (data.modalClose == 1)      setTimeout(function () {
		$(".modal").modal('hide');
	}, 1000);
	if (data.redirect)       setTimeout(function () {
		window.location = data.redirect;
	}, data.redirectTime);
	if (data.updater)            allForms_updater(data.updater);
	if (data.callback)            setTimeout(data.callback, 1000);

	return;

}

function forms_reset($selector, $defaultInput) {
	// Form Values...
	$counter = 0;
	$($selector + " input , " + $selector + " textarea ").each(function () {
		if ($(this).attr('type') != 'hidden') {
			$counter++;
			$(this).val('');
			forms_markError(this, 'reset');

			if ($counter == 1 && !$defaultInput) $defaultInput = $(this).attr('name');
		}
	});

	//Feed Area...
	$($selector + " .form-feed").hide();

	//Set Focus...
	setTimeout(function () {
		$($selector + " [name=" + $defaultInput + "]").focus();
	}, 200);

}

function forms_errorIfEmpty(selector) {
	var max = $(selector).attr('maxlength');
	var min = $(selector).attr('minlength');
	if (!$(selector).val() || $(selector).val() == "0") {
		forms_markError(selector, "error");
		return 1;
	}
	else {
		if (max && min) {
			if ($(selector).val().length > max || $(selector).val().length < min) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
		else if (max) {
			if ($(selector).val().length > max) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
		else if (min) {
			if ($(selector).val().length < min) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
	}
}

function forms_errorIfNotEmail(selector) {
	var email = $(selector).val();
	var filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	if (!filter.test(email)) {
		forms_markError(selector, "error");
		return 1;
	}
	else {
		forms_markError(selector, "success");
		return 0;
	}
}

function forms_errorIfNotNationalCode(selector) {
	if (!forms_national_code(forms_digit_en($(selector).val()))) {
		forms_markError(selector, "error");
		return 1;
	}
	else {
		forms_markError(selector, "success");
		return 0;
	}
}

function forms_errorIfNotNumber(selector) {
	var mixed_var = forms_digit_en($(selector).val());
	var whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
	var max = $(selector).attr('maxlength');
	var min = $(selector).attr('minlength');
	if ((typeof mixed_var === 'number' || (typeof mixed_var === 'string' && whitespace.indexOf(mixed_var.slice(-1)) === -
			1)) && mixed_var !== '' && !isNaN(mixed_var)) {
		if (max && min) {
			if (mixed_var.length > max || mixed_var.length < min) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
		else if (max) {
			if (mixed_var.length > max) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
		else if (min) {
			if (mixed_var.length < min) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
	}
	else {
		forms_markError(selector, "error");
		return 1;
	}
}

function forms_errorIfNotMobile(selector) {
	var mixed_var = forms_digit_en($(selector).val());
	var whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
	var max = $(selector).attr('maxlength');
	var min = $(selector).attr('minlength');
	if ((typeof mixed_var === 'number' || (typeof mixed_var === 'string' && whitespace.indexOf(mixed_var.slice(-1)) === -
			1)) && mixed_var !== '' && !isNaN(mixed_var) && mixed_var[0] == 0 && mixed_var[1] == 9) {
		if (max && min) {
			if (mixed_var.length > max || mixed_var.length < min) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
		else if (max) {
			if (mixed_var.length > max) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
		else if (min) {
			if (mixed_var.length < min) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
	}
	else {
		forms_markError(selector, "error");
		return 1;
	}
}

function forms_errorIfNotPhone(selector) {
	var mixed_var = forms_digit_en($(selector).val());
	var whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
	var max = $(selector).attr('maxlength');
	var min = $(selector).attr('minlength');
	if ((typeof mixed_var === 'number' || (typeof mixed_var === 'string' && whitespace.indexOf(mixed_var.slice(-1)) === -
			1)) && mixed_var !== '' && !isNaN(mixed_var) && mixed_var[0] == 0 && mixed_var[1] != 9) {
		if (max && min) {
			if (mixed_var.length > max || mixed_var.length < min) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
		else if (max) {
			if (mixed_var.length > max) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
		else if (min) {
			if (mixed_var.length < min) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
	}
	else {
		forms_markError(selector, "error");
		return 1;
	}
}

function forms_errorIfNotVerifyPassWord(selector) {
	var max = $(selector).attr('maxlength');
	var min = $(selector).attr('minlength');
	var id = $(selector).attr('id');
	var verify = '#' + id + '2';
	if ($(selector).val() == $(verify).val()) {
		if (max && min) {
			if ($(selector).val().length > max || $(selector).val().length < min) {
				forms_markError(selector, "error");
				forms_markError(verify, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				forms_markError(verify, "success");
				return 0;
			}
		}
		else if (max) {
			if ($(selector).val().length > max) {
				forms_markError(selector, "error");
				forms_markError(verify, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				forms_markError(verify, "success");
				return 0;
			}
		}
		else if (min) {
			if ($(selector).val().length < min) {
				forms_markError(selector, "error");
				forms_markError(verify, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				forms_markError(verify, "success");
				return 0;
			}
		}
	}
	else {
		forms_markError(selector, "error");
		forms_markError(verify, "error");
		return 1;
	}
}

function forms_errorIfLang(selector, lang) {
	var isPersian = forms_isPersian($(selector).val());
	var max = $(selector).attr('maxlength');
	var min = $(selector).attr('minlength');

	if (isPersian && lang != "fa") {
		forms_markError(selector, "error");
		return 1;
	}
	if (!isPersian && lang == "fa") {
		forms_markError(selector, "error");
		return 1;
	}
	else {
		if (max && min) {
			if ($(selector).val().length > max || $(selector).val().length < min) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
		else if (max) {
			if ($(selector).val().length > max) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
		else if (min) {
			if ($(selector).val().length < min) {
				forms_markError(selector, "error");
				return 1;
			}
			else {
				forms_markError(selector, "success");
				return 0;
			}
		}
	}
}

function forms_errorIfNotSelect(selector) {
	var multi = $(selector).attr('multiple');
	var value = [];

	if (multi) {
		var data = $(selector).val() + '';
		data = data.split(',');
		for (var i = 0; i < data.length; i++) {
			value[i] = data[i];
		}
	}
	else {
		if ($(selector).val() > 0) {
			value[0] = $(selector).val();
		}
	}


	if (!value.length) {
		forms_markError(selector, "error");
		return 1;
	}
	else {
		forms_markError(selector, "success");
		return 0;
	}

}

function forms_errorIfNotDatePicker(selector) {
	var $elementID = $(selector).attr('id');
	if ($('#' + $elementID + 'Extra').val().length < 6 || $(selector).val().length < 6) {
		forms_markError(selector, "error");
		return 1;
	}
	else {
		forms_markError(selector, "success");
		return 0;
	}
}

//======================================================================================
function forms_isPersian(string) {
	var p = /[^\u0600-\u06FF]/;
	var count = 0;
	for (var i = 0; i < string.length; i++) {
		if (string[i].match(p)) {
			count++;
		}
	}
	if ((count / string.length) > 0.6) {
		return false;
	}
	else {
		return true;
	}
}

function forms_markError(selector, handle) {
	if (handle == "success")
		$(selector).parent().parent().addClass("has-success").removeClass('has-error');
	else if (handle == "null" || handle == "reset")
		$(selector).parent().parent().removeClass('has-error').removeClass('has-success');
	else //including "error"
		$(selector).parent().parent().addClass("has-error").removeClass('has-success');//.effect	("shake"	,{times:2},100);

}

function forms_autoDirection(selector) {
	return; //TODO: rectify the lagging problem!
	var $object = $(selector);
	var $persChars = ['ا', 'آ', 'ب', 'پ', 'ت', 'س', 'ج', 'چ', 'ح', 'خ', 'د', 'ذ', 'ر', 'ز', 'ژ', 'س', 'ش', 'ص', 'ض', 'ط', 'ظ', 'ع', 'غ', 'ف', 'ق', 'ک', 'گ', 'ل', 'م', 'ن', 'و', 'ه', 'ی', 'ء', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', ' '];
	var $isPersian = false;


	$object.on("keyup", function () {
		var $string = $object.val();
		var $firstChar = $string.substr(0, 1);
		var $isPersian = false;
		var $i = 0;

		if (!$string) {
			$object.attr("dir", "rtl");
			return;
		}


		for ($i = 0; $i < 45; $i++) {
			if ($persChars[$i] == $firstChar) {
				$isPersian = true;
				break;
			}
		}

		if ($isPersian) {
			$object.attr("dir", "rtl");
		}
		else
			$object.attr("dir", "ltr");

	});


}

function forms_delaiedPageRefresh(time) {
	if (time < 1000) time = time * 1000;

	setTimeout(function () {
		location.reload();
	}, time);
}

function forms_pd($string) {
	if (!$string) return;//safety!

	$string = $string.replace(/1/g, "۱");
	$string = $string.replace(/2/g, "۲");
	$string = $string.replace(/3/g, "۳");
	$string = $string.replace(/4/g, "۴");
	$string = $string.replace(/5/g, "۵");
	$string = $string.replace(/6/g, "۶");
	$string = $string.replace(/7/g, "۷");
	$string = $string.replace(/8/g, "۸");
	$string = $string.replace(/9/g, "۹");
	$string = $string.replace(/0/g, "۰");

	return $string;
}

function forms_digit_en(perDigit) {
	var newValue = "";
	for (var i = 0; i < perDigit.length; i++) {
		var ch = perDigit.charCodeAt(i);
		if (ch >= 1776 && ch <= 1785) // For Persian digits.
		{
			var newChar = ch - 1728;
			newValue = newValue + String.fromCharCode(newChar);
		}
		else if (ch >= 1632 && ch <= 1641) // For Arabic & Unix digits.
		{
			var newChar = ch - 1584;
			newValue = newValue + String.fromCharCode(newChar);
		}
		else
			newValue = newValue + String.fromCharCode(ch);
	}
	return newValue;
}

function forms_digit_fa(enDigit) {
	var newValue = "";
	for (var i = 0; i < enDigit.length; i++) {
		var ch = enDigit.charCodeAt(i);
		if (ch >= 48 && ch <= 57) {
			var newChar = ch + 1584;
			newValue = newValue + String.fromCharCode(newChar);
		}
		else {
			newValue = newValue + String.fromCharCode(ch);
		}
	}
	return newValue;
}

function forms_national_code(code) {

	if (code.length == 10 && !isNaN(code)) {
		var code = code.split("");
		var err;
		for (var i = 0; i < code.length; i++) {
			if (code[0] > code[i] || code[0] < code[i]) {
				err = 1;
				break;
			}
			else {
				err = 2;
			}
		}

		if (err == 1) {
			var valid = 0;
			var jumper = 10;
			for (var i = 0; i <= 8; i++) {
				valid += code[i] * jumper;
				--jumper;
			}
			valid = valid % 11;
			if (valid >= 0 && valid < 2) {
				if (valid == code['9']) {
					return true;
				}
				else {
					return false;
				}
			}
			else {
				valid = 11 - valid;
				if (valid == code['9']) {
					return true;
				}
				else {
					return false;
				}
			}
		}
		else {
			return false;
		}
	}
	else {
		return false;
	}
}

function forms_date_picker(selector) {
	var $elementID = $(selector).attr('id');
	var $elementSelector = '#' + $elementID;
	var $elementName = $($elementSelector).attr('name') ;
	var $format = $(selector).attr('format');
	var $time = $(selector).attr('time');
	var $val = $(selector).attr('value');

	var extra = $($elementSelector).parent().html() + '<input type="hidden" id="' + $elementID + 'Extra" name="' + $elementName + '">';
	$($elementSelector).parent().append().html(extra);


	if (!$time) {
		$format = "YYYY/MM/DD";
		$time = false;
	}
	else {
		$format = "YYYY/MM/DD ـ H:mm:ss";
		$time = true;
	}

		$('#' + $elementID).pDatepicker({
			persianDigit: true,
			viewMode: false,
			position: "auto",
			autoClose: true,
			format: $format,
			observer: true,
			altField: '#' + $elementID + 'Extra',
			inputDelay: 800,
			formatter: function (unixDate) {
				var self = this;
				var pdate = new persianDate(unixDate);
				pdate.formatPersian = false;
				return pdate.format(self.format);
			},
			altFormat: 'unix',
			altFieldFormatter: function (unixDate) {
				var self = this;
				var thisAltFormat = self.altFormat.toLowerCase();
				if (thisAltFormat === "gregorian" | thisAltFormat === "g") {
					return new Date(unixDate);
				}
				if (thisAltFormat === "unix" | thisAltFormat === "u") {
					return unixDate;
				} else {
					return new persianDate(unixDate).format(self.altFormat);
				}
			},
			onShow: function (self) {},
			onHide: function (self) {},
			onSelect: function (unixDate) {
				return this;
			},
			navigator: {
				enabled: true,
				text: {
					btnNextText: ">",
					btnPrevText: "<"
				},
				onNext: function (navigator) {
					//log("navigator next ");
				},
				onPrev: function (navigator) {
					//log("navigator prev ");
				},
				onSwitch: function (state) {
					// console.log("navigator switch ");
				}
			},
			toolbox: {
				enabled: true,

				text: {
					btnToday: "امروز"
				},
				onToday: function (toolbox) {
					//log("toolbox today btn");
				}
			},
			timePicker: {
				enabled: $time,
				showSeconds: true,
				showMeridian: true,
				scrollEnabled: true
			},
			dayPicker: {
				enabled: true,
				scrollEnabled: true,
				titleFormat: 'YYYY MMMM',
				titleFormatter: function (year, month) {
					if (this.datepicker.persianDigit == false) {
						window.formatPersian = false;
					}
					var titleStr = new persianDate([year, month]).format(this.titleFormat);
					window.formatPersian = true;
					return titleStr
				},
				onSelect: function (selectedDayUnix) {
					//log("daypicker month day :" + selectedDayUnix);
				}

			},
			monthPicker: {
				enabled: true,
				scrollEnabled: true,
				titleFormat: 'YYYY',
				titleFormatter: function (unix) {
					if (this.datepicker.persianDigit == false) {
						window.formatPersian = false;
					}
					var titleStr = new persianDate(unix).format(this.titleFormat);
					window.formatPersian = true;
					return titleStr

				},
				onSelect: function (monthIndex) {
					//log("daypicker select day :" + monthIndex);
				}
			},
			yearPicker: {
				enabled: true,
				scrollEnabled: true,
				titleFormat: 'YYYY',
				titleFormatter: function (year) {
					var remaining = parseInt(year / 12) * 12;
					return remaining + "-" + (remaining + 11);
				},
				onSelect: function (monthIndex) {
					//log("daypicker select Year :" + monthIndex);
				}
			},
			onlyTimePicker: false,
			justSelectOnDate: true,
			minDate: false,
			maxDate: false
		});

	if ($val.length > 6)
	{
		$val = $val.split('/');
		$( '#' + $elementID ).pDatepicker("setDate",[$val[0],$val[1],parseInt($val[2]),$val[3],$val[4], $val[5]] );
	}
	if($val.length < 1 )
	{
		$($elementSelector).val('') ;
	}

}