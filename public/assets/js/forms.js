$(document).ready(function() {
      forms_listener();
});

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
      });

      // automatic direction...
      $(".atr").each(function(){
            $(this).removeClass('atl');
            $(this).on("keyup" , function(){
                  forms_autoDirection(this);
            });
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
            $errors += forms_errorIfEmpty(this);
            if($errors==1) $(this).focus();
      });

      if (typeof window[$formId + "_validate"] == 'function') {
            $errors += window[$formId + "_validate"](formData, jqForm, options);
      }

      //result...
      // $errors = 0 ; //@TODO: REMOVE IT
      if($errors>0) {
            $($feed).addClass('alert-danger').html($($feed+"-error").html());
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

      if( jqXhr.status === 500 ) { //@TODO: Supposed to refresh if _token is wrong. but refreshes in all server errros
            errorsHtml  = $($feedSelector+'-error').html()      ;
            setTimeout(function() {window.location.reload()},1000);
      }
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
//      if(data.login==1) 	setTimeout(function(){window.location = base_url()+"login";},1000);
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
      if (!$(selector).val() || $(selector).val() == "0") {
            forms_markError(selector, "error");
            return 1;
      }
      else {
            forms_markError(selector, "success");
            return 0;
      }
}

function  forms_errorIfLang(selector, lang) {
      var isPersian = forms_isPersian($(selector).val());
      alert(isPersian);

      if (isPersian && lang != "fa") {
            forms_markError(selector, "error");
            return 1;
      }
      if (!isPersian && lang == "fa") {
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
      if (string[0].match(p))
            return false;
      else
            return true;
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