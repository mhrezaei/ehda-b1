function farsiDigits(e){for(var t=0;t<10;t++)e=(e+"").replace(new RegExp(t+"","g"),String.fromCharCode((t+"").charCodeAt(0)+1728));return e}function twoDigits(e){return e=("0"+e).slice(-2)}function countDown(e,t){var i=Date.parse(new Date("10/7/2016")),n=Date.parse(new Date),o=(i-n)/1e3%(60*t),a=Math.floor(o%60),s=Math.floor(o/60%60),r=Math.floor(o/3600%24),c=e.next().find(".circle-progress");parseInt(c.css("stroke-dasharray"));r?e.find(".hours").html(farsiDigits(twoDigits(r))+":"):e.find(".hours").empty(),e.find(".minutes").html(farsiDigits(twoDigits(s))+":"),e.find(".secconds").html(farsiDigits(twoDigits(a))),e.parent().find(".circle").circleProgress({value:1-Math.floor(100*o/(60*t))/100,animation:!1,thickness:13,startAngle:4.7})}function closeMenu(e){var t=e.find("ul").first(),i=t.find(">ul");0!=i.length?i.stop(!0,!1).fadeOut(200,function(){t.slideUp(400,function(){e.removeClass("active")})}):t.slideUp(400,function(){e.removeClass("active")})}function openMenu(e){!e.hasClass("active")&&e.parents("ul").find(".active").length&&closeMenu(e.parents("ul").find(".active"));var t=e.find("ul").first(),i=t.find(">ul");e.hasClass(".active")||t.stop(!0,!1).slideDown(400,function(){0!=i.length?i.fadeIn(200,function(){e.addClass("active")}):e.addClass("active")})}function selectCity(){var e='<option value="0">انتخاب کنید...</option>',t=$("#cbRegisterState"),i=$("#cbRegisterCity");i.html(e);var n=window.city;if(t.val()>0&&t.val()<32){n=n[t.val()];for(var o in n)e+='<option value="'+n[o].id+'">'+n[o].name+"</option>";i.html(e)}}function selectEditCity(e){var t='<option value="0">انتخاب کنید...</option>',i=$("#cbRegisterState"),n=$("#cbRegisterCity");n.html(t);var o=window.city;if(i.val()>0&&i.val()<32){o=o[i.val()];for(var a in o)t+=o[a].id==e?'<option value="'+o[a].id+'" selected="selected">'+o[a].name+"</option>":'<option value="'+o[a].id+'">'+o[a].name+"</option>";n.html(t)}}var timers=new Object;$(".timer").length&&$(".timer").each(function(index){eval("timer"+index+" = "+setInterval(function(){countDown($($(".timer")[index]),parseInt($($(".timer")[index]).attr("data-minutes")))},1e3))}),$(document).ready(function(){var e,t;$(".has-child").hover(function(){t=$(this),clearTimeout(e),e=null,openMenu(t)},function(){e=setTimeout(function(){closeMenu(t),t=null},100)}),$(".has-child").click(function(e){e.preventDefault(),$(this).hasClass("active")?closeMenu($(this)):openMenu($(this))}),$(function(){$(window).scroll(function(){var e=$(window).scrollTop(),t=$(".main-menu").outerHeight();e>=$(".top-bar").outerHeight()?($(".main-menu").height(t),$("body").css("margin-top",t),$("body").addClass("sticky-header")):($("body").removeClass("sticky-header"),$("body").css("margin-top",0),$(".main-menu").css("height","auto"))})}),$("#current-members h3").fitText(2.5,{maxFontSize:"50px"}),$("#home-notes h3").fitText(2.5,{maxFontSize:"30px"}),$("body").css("margin-bottom",$("body>footer").outerHeight()),$(window).resize(function(){$(".timers .timer span").css("line-height",$(".timers .circle").first().height()+"px"),$("body").css("margin-bottom",$("body>footer").outerHeight())}),$("#chRegisterAll").on("change",function(){this.checked?$(this).parent().parent().find('[type="checkbox"]').prop("checked",!0):$(this).parent().parent().find('[type="checkbox"]').prop("checked",!1)}),$('.body-items [type="checkbox"]:not(#chRegisterAll)').on("change",function(){$('.body-items [type="checkbox"]:not(#chRegisterAll)').length==$('.body-items [type="checkbox"]:not(#chRegisterAll):checked').length?$("#chRegisterAll").prop("checked",!0):$("#chRegisterAll").prop("checked",!1)})}),function(e){e.fn.fitText=function(t,i){var n=t||1,o=e.extend({minFontSize:Number.NEGATIVE_INFINITY,maxFontSize:Number.POSITIVE_INFINITY},i);return this.each(function(){var t=e(this),i=function(){t.css("font-size",Math.max(Math.min(t.width()/(10*n),parseFloat(o.maxFontSize)),parseFloat(o.minFontSize)))};i(),e(window).on("resize.fittext orientationchange.fittext",i)})}}(jQuery);