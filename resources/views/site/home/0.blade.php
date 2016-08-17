@extends('site.frame.frame')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="owl-carousel home-slider" dir="ltr">
                <div class="item" dir="rtl">
                    <img src="images/slide-1-1.jpg">
                    <div class="slide-text">
                        <h3>«این لحظه خوش را از تو دارم»</h3>
                        <span>بهرام فرهادی ۳۸ ساله - گیرنده ریه</span>
                    </div>
                </div>
                <div class="item" dir="rtl"><img src="images/slide-1-2.jpg"></div>
            </div>
        </div>
        <div class="row">
            <div id="current-members" class="text-center">
                <h3>در حال حاضر ۲۷۰۸۱ نفر در انتظار پیوند هستند.</h3>
            </div>
        </div>
        <div class="row">
            <div class="owl-carousel home-slider events-slider" dir="ltr">
                <div class="item">
                    <img src="images/slide-2-1.jpg">
                    <div class="event-box">
                        <div class="text">
                            <h2>فراخوان اولین جشنواره تجسمی نفس</h2>
                            <p>آثار نقاشی، تصویرسازی، عکاسی، گرافیک،<br>کاریکاتور، مجسمه&zwnj;سازی ... (ادامه)</p>
                        </div>
                    </div>
                </div>
                <div class="item"><img src="images/slide-2-2.jpg"></div>
            </div>
        </div>
        <script>
            $(document).ready(function() {

                $(".home-slider").owlCarousel({
                    autoPlay : 3000,
                    stopOnHover : true,
                    navigation:true,
                    paginationSpeed : 1000,
                    goToFirstSpeed : 2000,
                    singleItem : true,
                    transitionStyle:"fade",
                    afterInit: function(){
                        this.$owlItems.each(function(){
                            var imgLink = $(this).find('img').first().attr('src');
                            var item = $(this).find('.item').first();
                            item.css('background-image', 'url('+imgLink+')');
                        });
                    }
                });
            });
        </script>
        <div class="row" id="home-notes">
            <h3 class="text-center">برای نجات <span class="text-success">زندگی</span> لحظه&zwnj;ها مهم است!</h3>
            <div class="animated-people text-center">
                <span><span class="person-icon dead animate-return"></span><span class="person-icon animate-die"></span></span>
                <span class="equal-sign">=</span>
                <span><span class="person-icon animate-return"></span><span class="person-icon dead animate-die"></span></span>
                <span><span class="person-icon animate-return"></span><span class="person-icon dead animate-die"></span></span>
                <span><span class="person-icon animate-return"></span><span class="person-icon dead animate-die"></span></span>
                <span><span class="person-icon animate-return"></span><span class="person-icon dead animate-die"></span></span>
                <span><span class="person-icon animate-return"></span><span class="person-icon dead animate-die"></span></span>
                <span><span class="person-icon animate-return"></span><span class="person-icon dead animate-die"></span></span>
                <span><span class="person-icon animate-return"></span><span class="person-icon dead animate-die"></span></span>
                <span><span class="person-icon animate-return"></span><span class="person-icon dead animate-die"></span></span>
            </div>
            <h3 class="text-center">هر فرد مرگ مغزی می&zwnj;تواند جان ۸ نفر را نجات دهد.</h3>
            <div class="timers container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-lg-3">
                        <div class="row">
                            <div class="clearfix text-left col-xs-6 col-lg-12 count-down">
                                <div dir="ltr" class="timer pull-right" data-minutes="10">
                                    <span class="hours"></span><span class="minutes"></span><span class="secconds"></span>
                                </div>
                                <div class="circle" data-fill="{&quot;color&quot;: &quot;#1c3482&quot;}" data-empty-fill="#3ab637"></div>
                            </div>
                            <div class="timer-message col-xs-6 col-lg-12">
                                <strong>در هر ۱۰ دقیقه</strong>
                                <span>یک نفر به لیست انتظار اضافه می&zwnj;گردد.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-3">
                        <div class="row">
                            <div class="clearfix text-left col-xs-6 col-lg-12 count-down">
                                <div dir="ltr" class="timer pull-right" data-minutes="70">
                                    <span class="hours"></span><span class="minutes"></span><span class="secconds"></span>
                                </div>
                                <div class="circle" data-fill="{&quot;color&quot;: &quot;#1c3482&quot;}" data-empty-fill="#3ab637"></div>
                            </div>
                            <div class="timer-message col-xs-6 col-lg-12">
                                <strong>در هر ۷۰ دقیقه</strong>
                                <span>یک نفر در ایران با مرگ مغزی جان خود را از دست می&zwnj;دهد.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-3">
                        <div class="row">
                            <div class="clearfix text-left col-xs-6 col-lg-12 count-down">
                                <div dir="ltr" class="timer pull-right" data-minutes="120">
                                    <span class="hours"></span><span class="minutes"></span><span class="secconds"></span>
                                </div>
                                <div class="circle" data-fill="{&quot;color&quot;: &quot;#1c3482&quot;}" data-empty-fill="#3ab637"></div>
                            </div>
                            <div class="timer-message col-xs-6 col-lg-12">
                                <strong>در هر ۲ ساعت</strong>
                                <span>یک بیمار نیازمند به پیوند، جان خود را از دست می&zwnj;دهد.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-3">
                        <div class="row">
                            <div class="clearfix text-left col-xs-6 col-lg-12 count-down">
                                <div dir="ltr" class="timer pull-right" data-minutes="720">
                                    <span class="hours"></span><span class="minutes"></span><span class="secconds"></span>
                                </div>
                                <div class="circle" data-fill="{&quot;color&quot;: &quot;#3ab637&quot;}" data-empty-fill="#ccc"></div>
                            </div>
                            <div class="timer-message col-xs-6 col-lg-12">
                                <strong>در هر ۱۲ ساعت</strong>
                                <span>یک بیمار موفق به دریافت عضو حیاتی می&zwnj;شود و به زندگی بازمی&zwnj;گردد.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row fixed-background" style="background-image:url(images/image-1.jpg)">
            <h3 class="text-white text-center" style="line-height:3em;font-size:450%;height:3em">۶۱=۵۳+۸=۱</h3>
        </div>
        <div class="row">
            <div class="container">
                <div class="row" style="margin:80px 0">
                    <div class="col-xs-12 col-sm-6">
                        <h3>رویدادهای پیش رو</h3>
                        <ul class="events list-unstyled">
                            <li><a href="/">فراخوان اولین جشنواره تجمسی نفس</a></li>
                            <li><a href="/">رونمایی از طرح جدید کارت اهدای عضو</a></li>
                            <li><a href="/">فراخوان اولین جشنواره تجمسی نفس</a></li>
                            <li><a href="/">رونمایی از طرح جدید کارت اهدای عضو</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <h3>اخبار</h3>
                        <ul class="news list-unstyled">
                            <li><a href="/">آمار بالای نارسایی کلیه در کشور/ دستگاه‌های دیالیز فرسوده‌اند</a><span class="date">۲۵ اسفند ۹۴</span></li>
                            <li><a href="/">رفتگر فداکار زندگی بخشید</a><span class="date">۲۳ آبان ۹۴</span></li>
                            <li><a href="/">آمار بالای نارسایی کلیه در کشور/ دستگاه‌های دیالیز فرسوده‌اند</a><span class="date">۲۰ مهر ۹۴</span></li>
                            <li><a href="/">رفتگر فداکار زندگی بخشید</a><span class="date">۲۰ تیر ۹۴</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection