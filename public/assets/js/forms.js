$(document).ready(function() {
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
//    9) password    : .form-password => for check verify password field rename that to password id + 'Verify'
//    10) datepicker : .form-datepicker => get timestamp with your input id + 'Extra'
//    11) select     : .form-select
///////////////////////////////////////////////

function forms_listener()
{
      // javascript forms....
      $("form.js").each(function(){
            $(this).removeClass('js');
            $(this).ajaxForm({
                  dataType: 'json',
                  beforeSubmit: forms_validate,
                  success: forms_responde,
                  error: forms_error
            });
            $('.form-default').focus();
      });

      $(".form-default").each(function() {
            $(this).removeClass('form-default');
            $(this).focus();
      })

      // automatic direction...
      $(".atr").each(function(){
            $(this).removeClass('atl');
            $(this).on("keyup" , function(){
                  forms_autoDirection(this);
            });
      });

	$(".form-datepicker").each(function () {
		$datepicker_id = $(this).attr('id');
          if(! $('#' + $datepicker_id + 'Extra').length)
          {
                forms_date_picker(this);
          }
	});

      $(".persian").each(function(){
            $(this).removeClass('persian');
            $(this).html(forms_pd($(this).html())) ;
      });




      setTimeout("forms_listener()",5);
}

function forms_validate(formData, jqForm, options) {

      //Variables...
//      var $formId = jqForm[0].id    ;
	var $formId = jqForm.attr('id');
      var $errors = 0               ;
      var $feed   = "#" + $formId + " .form-feed";


      //Form Feed...
      $($feed).removeClass('alert-success').removeClass('alert-danger').slideDown();

      //Checking required fields...
      $("#" + $formId + " .form-required").each(function(){
            if (forms_errorIfEmpty(this))
            {
                  $errors++;
            }
            if($errors==1) $(this).focus();
      });

      //Checking numbers fields...
      $("#" + $formId + " .form-number").each(function(){
            if (forms_errorIfNotNumber(this))
            {
                  $errors++;
            }
            if($errors==1) $(this).focus();
      });

      //Checking persian character fields...
      $("#" + $formId + " .form-persian").each(function(){
            if (forms_errorIfLang(this, 'fa'))
            {
                  $errors++;
            }
            if($errors==1) $(this).focus();
      });

      //Checking english character fields...
      $("#" + $formId + " .form-english").each(function(){
            if(forms_errorIfLang(this, 'en'))
            {
                  $errors++;
            }
            if($errors==1) $(this).focus();
      });

      //Checking email fields...
      $("#" + $formId + " .form-email").each(function(){
            if(forms_errorIfNotEmail(this))
            {
                  $errors++;
            }
            if($errors==1) $(this).focus();
      });

      //Checking national code fields...
      $("#" + $formId + " .form-national").each(function(){
            if (forms_errorIfNotNationalCode(this))
            {
                  $errors++;
            }
            if($errors==1) $(this).focus();
      });

      //Checking mobile numbers fields...
      $("#" + $formId + " .form-mobile").each(function(){
            if(forms_errorIfNotMobile(this))
            {
                  $errors++;
            }
            if($errors==1) $(this).focus();
      });

      //Checking phone numbers fields...
      $("#" + $formId + " .form-phone").each(function(){
            if (forms_errorIfNotPhone(this))
            {
                  $errors++;
            }
            if($errors==1) $(this).focus();
      });

      //Checking password fields...
      $("#" + $formId + " .form-password").each(function(){
            if (forms_errorIfNotVerifyPassWord(this))
            {
                  $errors++;
            }
            if($errors==1) $(this).focus();
      });

      //Checking datepicker fields...
      $("#" + $formId + " .form-datepicker").each(function(){
            if (forms_errorIfNotDatePicker(this))
            {
                  $errors++;
            }
            if($errors==1) $(this).focus();
      });

      //Checking select fields...
      $("#" + $formId + " .form-select").each(function(){
            if (forms_errorIfNotSelect(this))
            {
                  $errors++;
            }
            if($errors==1) $(this).focus();
      });

      if (typeof window[$formId + "_validate"] == 'function') {
            $errors += window[$formId + "_validate"](formData, jqForm, options);
      }

      var $function = 'validate_'+$formId ;
      if (typeof window[$function]() == 'function') {
            $errors = $errors + window[$function]();
      }

      //result...
      var stop = $('#' + $formId).attr('stop');
      if(stop && stop == 1)
      {
            $errors = 0;
      }

      if($errors>0) {
            $($feed).addClass('alert-danger').html($($feed+"-error").html('4444'));
            return false ;
      }
      else {
            return true ;
      }

}

function forms_error(jqXhr, textStatus, errorThrown)
{
      // IMPORTANT NOTE: $formSelector contains nothing! That means forms_errror() cannot identify
      // which form it is and merely shows the errors on all available feeds!

      //Variables...
      var   $formSelector     = "" ;
      var   $feedSelector     = $formSelector+" .form-feed"   ;

//      if( jqXhr.status === 500 ) { //@TODO: Supposed to refresh if _token is wrong. but refreshes in all server errros
//            errorsHtml  = $($feedSelector+'-error').html()      ;
//            setTimeout(function() {window.location.reload()},1000);
//      }
      if( jqXhr.status === 422 ) {
            $errors = jqXhr.responseJSON;

            errorsHtml = '<ul>';
            $.each( $errors, function( key, value ) {
                  errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
            });
            errorsHtml += '</ul>';
      }
      else {
            errorsHtml  = $($feedSelector+'-error').html()      ;
      }

      $($feedSelector).addClass("alert-danger").html(errorsHtml);

}

function forms_responde(data, statusText, xhr, $form)
{
      var formSelector = "#" + $form.attr('id');
      var $feedSelector = formSelector+" .form-feed"   ;

      if(data.ok=='1') {
            var cl    = "alert-success"     ;
            var me    = data.message ;
            if(!me) me= $($feedSelector+'-ok').html();
      }
      else {
            var cl    = "alert-danger"     ;
            var me    = data.message ;
//            formEffect_markError(data.fields);
//            $(data.fields).focus();
      }

      $($feedSelector).addClass(cl).html(me).show();

      //after effects...
      if(data.refresh==1) 	forms_delaiedPageRefresh(1);
      if(data.modalClose==1) 	setTimeout(function(){$(".modal").modal('hide');},1000);
      if(data.redirect)       setTimeout(function(){window.location = data.redirect;},1000);
      if(data.updater)		allForms_updater(data.updater);
      if(data.callback)		setTimeout(data.callback,1000);

      return;

}

function  forms_reset($selector , $defaultInput)
{
      // Form Values...
      $counter = 0 ;
      $($selector + " input , " + $selector + " textarea ").each(function(){
            if($(this).attr('type')!='hidden') {
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
            $($selector + " [name="+$defaultInput+"]").focus();
      },200);

}

function forms_errorIfEmpty(selector) {
      var max = $(selector).attr('maxlength');
      var min = $(selector).attr('minlength');
      if (!$(selector).val() || $(selector).val() == "0") {
            forms_markError(selector, "error");
            return 1;
      }
      else {
            if (max && min)
            {
                  if ($(selector).val().length > max || $(selector).val().length < min)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
            else if (max)
            {
                  if ($(selector).val().length > max)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
            else if (min)
            {
                  if ($(selector).val().length < min)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
      }
}

function forms_errorIfNotEmail(selector) {
      var email = $(selector).val();
      var filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

      if(!filter.test(email))
      {
            forms_markError(selector, "error");
            return 1;
      }
      else
      {
            forms_markError(selector, "success");
            return 0;
      }
}

function forms_errorIfNotNationalCode(selector) {
      if(!forms_national_code(forms_digit_en($(selector).val())))
      {
            forms_markError(selector, "error");
            return 1;
      }
      else
      {
            forms_markError(selector, "success");
            return 0;
      }
}

function forms_errorIfNotNumber(selector) {
      var mixed_var = forms_digit_en($(selector).val());
      var whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
      var max = $(selector).attr('maxlength');
      var min = $(selector).attr('minlength');
      if((typeof mixed_var === 'number' || (typeof mixed_var === 'string' && whitespace.indexOf(mixed_var.slice(-1)) === -
              1)) && mixed_var !== '' && !isNaN(mixed_var))
      {
            if (max && min)
            {
                 if (mixed_var.length > max || mixed_var.length < min)
                 {
                       forms_markError(selector, "error");
                       return 1;
                 }
                 else
                 {
                       forms_markError(selector, "success");
                       return 0;
                 }
            }
            else if (max)
            {
                  if (mixed_var.length > max)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
            else if (min)
            {
                  if (mixed_var.length < min)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
      }
      else
      {
            forms_markError(selector, "error");
            return 1;
      }
}

function forms_errorIfNotMobile(selector) {
      var mixed_var = forms_digit_en($(selector).val());
      var whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
      var max = $(selector).attr('maxlength');
      var min = $(selector).attr('minlength');
      if((typeof mixed_var === 'number' || (typeof mixed_var === 'string' && whitespace.indexOf(mixed_var.slice(-1)) === -
              1)) && mixed_var !== '' && !isNaN(mixed_var) && mixed_var[0] == 0 && mixed_var[1] == 9)
      {
            if (max && min)
            {
                  if (mixed_var.length > max || mixed_var.length < min)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
            else if (max)
            {
                  if (mixed_var.length > max)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
            else if (min)
            {
                  if (mixed_var.length < min)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
      }
      else
      {
            forms_markError(selector, "error");
            return 1;
      }
}

function forms_errorIfNotPhone(selector) {
      var mixed_var = forms_digit_en($(selector).val());
      var whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
      var max = $(selector).attr('maxlength');
      var min = $(selector).attr('minlength');
      if((typeof mixed_var === 'number' || (typeof mixed_var === 'string' && whitespace.indexOf(mixed_var.slice(-1)) === -
              1)) && mixed_var !== '' && !isNaN(mixed_var) && mixed_var[0] == 0 && mixed_var[1] != 9)
      {
            if (max && min)
            {
                  if (mixed_var.length > max || mixed_var.length < min)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
            else if (max)
            {
                  if (mixed_var.length > max)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
            else if (min)
            {
                  if (mixed_var.length < min)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
      }
      else
      {
            forms_markError(selector, "error");
            return 1;
      }
}

function forms_errorIfNotVerifyPassWord(selector) {
      var max = $(selector).attr('maxlength');
      var min = $(selector).attr('minlength');
      var id = $(selector).attr('id');
      var verify = '#' + id + 'Verify';
      if($(selector).val() == $(verify).val())
      {
            if (max && min)
            {
                  if ($(selector).val().length > max || $(selector).val().length < min)
                  {
                        forms_markError(selector, "error");
                        forms_markError(verify, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        forms_markError(verify, "success");
                        return 0;
                  }
            }
            else if (max)
            {
                  if ($(selector).val().length > max)
                  {
                        forms_markError(selector, "error");
                        forms_markError(verify, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        forms_markError(verify, "success");
                        return 0;
                  }
            }
            else if (min)
            {
                  if ($(selector).val().length < min)
                  {
                        forms_markError(selector, "error");
                        forms_markError(verify, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        forms_markError(verify, "success");
                        return 0;
                  }
            }
      }
      else
      {
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
            if (max && min)
            {
                  if ($(selector).val().length > max || $(selector).val().length < min)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
            else if (max)
            {
                  if ($(selector).val().length > max)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
            else if (min)
            {
                  if ($(selector).val().length < min)
                  {
                        forms_markError(selector, "error");
                        return 1;
                  }
                  else
                  {
                        forms_markError(selector, "success");
                        return 0;
                  }
            }
      }
}

function forms_errorIfNotSelect(selector) {
      var multi = $(selector).attr('multiple');
      var value = [];

      if (multi)
      {
            var data = $(selector).val() + '';
            data = data.split(',');
            for(var i = 0; i < data.length; i++)
            {
                  value[i] = data[i];
            }
      }
      else
      {
            if($(selector).val() > 0)
            {
                  value[0] = $(selector).val();
            }
      }



      if (!value.length)
      {
            forms_markError(selector, "error");
            return 1;
      }
      else
      {
            forms_markError(selector, "success");
            return 0;
      }
      
}

function forms_errorIfNotDatePicker(selector)
{
      var $elementID = $(selector).attr('id');
      if ($('#' + $elementID + 'Extra').val() > 0)
      {
            forms_markError(selector, "success");
            return 0;
      }
      else
      {
            forms_markError(selector, "error");
            return 1;
      }
}

//======================================================================================
function forms_isPersian(string) {
      var p = /[^\u0600-\u06FF]/;
      var count = 0;
      for(var i = 0; i < string.length; i++)
      {
            if(string[i].match(p))
            {
                  count++;
            }
      }
      if((count / string.length) > 0.6)
      {
            return false;
      }
      else
      {
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
      return ; //TODO: rectify the lagging problem!
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

function forms_digit_en(perDigit)
{
      var newValue="";
      for (var i=0;i<perDigit.length;i++)
      {
            var ch=perDigit.charCodeAt(i);
            if (ch>=1776 && ch<=1785) // For Persian digits.
            {
                  var newChar=ch-1728;
                  newValue=newValue+String.fromCharCode(newChar);
            }
            else if(ch>=1632 && ch<=1641) // For Arabic & Unix digits.
            {
                  var newChar=ch-1584;
                  newValue=newValue+String.fromCharCode(newChar);
            }
            else
                  newValue=newValue+String.fromCharCode(ch);
      }
      return newValue;
}

function forms_digit_fa(enDigit)
{
      var newValue="";
      for (var i=0;i<enDigit.length;i++)
      {
            var ch=enDigit.charCodeAt(i);
            if (ch>=48 && ch<=57)
            {
                  var newChar=ch+1584;
                  newValue=newValue+String.fromCharCode(newChar);
            }
            else
            {
                  newValue = newValue + String.fromCharCode(ch);
            }
      }
      return newValue;
}

function forms_national_code(code)
{

      if(code.length == 10 && !isNaN(code))
      {
            var code = code.split("");
            var err ;
            for(var i = 0; i < code.length; i++)
            {
                  if(code[0] > code[i] || code[0] < code[i])
                  {
                        err = 1;
                        break;
                  }
                  else
                  {
                        err = 2;
                  }
            }

            if(err == 1)
            {
                  var valid = 0;
                  var jumper = 10;
                  for(var i = 0; i <= 8; i++)
                  {
                        valid += code[i] * jumper;
                        --jumper;
                  }
                  valid = valid % 11;
                  if(valid >= 0 && valid < 2)
                  {
                        if(valid == code['9'])
                        {
                              return true;
                        }
                        else
                        {
                              return false;
                        }
                  }
                  else
                  {
                        valid = 11 - valid;
                        if(valid == code['9'])
                        {
                              return true;
                        }
                        else
                        {
                              return false;
                        }
                  }
            }
            else
            {
                  return false;
            }
      }
      else
      {
            return false;
      }
}

function forms_date_picker(selector)
{
      var $elementID = $(selector).attr('id');
      var $format = $(selector).attr('format');
      var $time = $(selector).attr('time');

      var extra = $('#' + $elementID).parent().html() + '<input type="hidden" id="' + $elementID + 'Extra" name="' + $elementID + 'Extra">';
      $('#' + $elementID).parent().append().html(extra);

      if (!$format)
      {
            $format = "YYYY/MM/DD";
      }

      if (!$time)
      {
            $time = false;
      }

      var dateOptions = {
            format: $format,
            observer: true,
            persianDigit: true,
            // maxDate: maxAge,
            formatter: function (unixDate) {
                  var self = this;
                  var pdate = new persianDate(unixDate);
                  pdate.formatPersian = true;
                  return pdate.format(self.format);
            },
            navigator: {
                  enabled: true,
            },
            dayPicker: {
                  scrollEnabled: false,
            },
            monthPicker: {
                  scrollEnabled: false,
            },
            yearPicker: {
                  scrollEnabled: false,
            },
            altFieldFormatter: function (unixDate) {
                  var self = this;
                  var thisAltFormat = self.altFormat.toLowerCase();
                  var timeUn = 0;
                  if (thisAltFormat === "gregorian" | thisAltFormat === "g") {
                        timeUn = new Date(unixDate);
                  }
                  if (thisAltFormat === "unix" | thisAltFormat === "u") {
                        timeUn = unixDate;
                  } else {
                        timeUn = new persianDate(unixDate).format(self.altFormat);
                  }
                  $('#' + $elementID + 'Extra').val(timeUn);
            },
            timePicker: {
                  enabled: $time,
                  showSeconds: true,
                  showMeridian: true,
                  scrollEnabled: true
            }
      };

      $('#' + $elementID).on('focus', function () {
            if($(this).val() == ''){
                  $(this).pDatepicker(dateOptions).trigger('focus');
            }
      });

}