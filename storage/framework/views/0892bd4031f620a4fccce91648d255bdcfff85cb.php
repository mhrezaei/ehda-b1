<title><?php echo e(trans('global.siteTitle')); ?> | <?php echo e(trans('site.global.angels')); ?></title>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="page-green-title center-title text-center col-xs-12">
                <h3 class="container"><?php echo e(trans('site.global.angels')); ?></h3>
            </div>
        </div>
        <div class="row stars-bg text-center">
            <div class="stars">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="873.3px" height="379.5px" viewBox="0 0 873.3 379.5" style="enable-background:new 0 0 873.3 379.5" xml:space="preserve">
          <circle fill="#fff" cx="553.5" cy="90.5" r="9"/>
                    <circle fill="#fff" cx="627.5" cy="44" r="6.4"/>
                    <circle fill="#fff" cx="784.1" cy="44" r="4.6"/>
                    <circle fill="#fff" cx="839.2" cy="106.6" r="4.6"/>
                    <circle fill="#fff" cx="856.8" cy="217.1" r="4.6"/>
                    <circle fill="#fff" cx="559.1" cy="302.4" r="4.6"/>
                    <circle fill="#fff" cx="455.4" cy="228.8" r="6.4"/>
                    <circle fill="#fff" cx="316.6" cy="292.4" r="9.6"/>
                    <circle fill="#fff" cx="249.1" cy="332.4" r="6.9"/>
                    <circle fill="#fff" cx="137.6" cy="348.1" r="6.9"/>
                    <circle fill="#fff" cx="17.3" cy="248.8" r="5.3"/>
                    <circle fill="#fff" cx="67.6" cy="71.1" r="5.3"/>
                    <circle fill="#fff" cx="143.3" cy="40.3" r="8.8"/>
                    <circle fill="#fff" cx="277.3" cy="58" r="5.9"/>
                    <circle fill="#fff" cx="413.8" cy="147.5" r="5.9"/>
                    <circle fill="#fff" cx="417.8" cy="113.5" r="3.7"/>
                    <circle fill="#fff" cx="440.6" cy="21.1" r="7.1"/>
                    <circle fill="#fff" cx="442.7" cy="359.1" r="6.4"/>
                    <circle fill="#fff" cx="758.7" cy="333.6" r="8.1"/>
        </svg>
            </div>
            <form action="" class="search-angel form-horizontal col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <button type="submit"><i class="icon icon-search"></i></button>
                <input type="search" name="" value="" placeholder="جستجوی فرشته">
            </form>
        </div>
    </div>
    <script>
        var angels = [
            {
                'name':'نوید زمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/17.jpg'
            },
            {
                'name':'نوید همانی',
                'picture_url':'https://randomuser.me/api/portraits/men/23.jpg'
            },
            {
                'name':'حمید زمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/12.jpg'
            },
            {
                'name':'نوید کرمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/24.jpg'
            },
            {
                'name':'نوید زمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/17.jpg'
            },
            {
                'name':'نوید همانی',
                'picture_url':'https://randomuser.me/api/portraits/men/23.jpg'
            },
            {
                'name':'حمید زمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/12.jpg'
            },
            {
                'name':'نوید کرمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/24.jpg'
            },
            {
                'name':'نوید زمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/17.jpg'
            },
            {
                'name':'نوید همانی',
                'picture_url':'https://randomuser.me/api/portraits/men/23.jpg'
            },
            {
                'name':'حمید زمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/12.jpg'
            },
            {
                'name':'نوید کرمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/24.jpg'
            },
            {
                'name':'نوید زمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/17.jpg'
            },
            {
                'name':'نوید همانی',
                'picture_url':'https://randomuser.me/api/portraits/men/23.jpg'
            },
            {
                'name':'حمید زمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/12.jpg'
            },
            {
                'name':'نوید کرمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/24.jpg'
            },
            {
                'name':'نوید زمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/17.jpg'
            },
            {
                'name':'نوید همانی',
                'picture_url':'https://randomuser.me/api/portraits/men/23.jpg'
            },
            {
                'name':'حمید زمانی',
                'picture_url':'https://randomuser.me/api/portraits/men/12.jpg'
            }
        ]
        $('.stars circle').click(function(){
            hideActiveStar();
            $(this).addClass('active');
            var circleIndex = $(this).parent().find('circle').index(this);
            var angel = angels[circleIndex];
            showStar(circleIndex, angel.name, angel.picture_url)
        });
        $(document).on('click', function (event) {
            if($('.user-card').length && !$(event.target).is('circle') && !$(event.target).parents('.user-card').length && !$(event.target).is('.user-card')) hideActiveStar();
        });
        var notFoundAlert = $('\
      <p class="alert alert-warning" style="display:none;">\
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
          فرشته‌ای با این نام یافت نشد! <a href="">نام این فرشته را ثبت کنید</a>\
        </p>\
    ');
        $('.search-angel').on('submit', function(event){
            event.preventDefault();
            $(this).addClass('loading');
            //Do your ajax
            //success: {
            //                 showStar(circleIndex, name, imageSrc);
            //               `$("html, body").animate({ scrollTop: $('.user-card').offset().top -  $('.user-card').outerHeight() - $('.main-menu').outerHeight()});
            //               }
            //fail: $('.search-angel').prepend(notFoundAlert).find('.alert').slideDown();
            //always: $('.search-angel').removeClass('loading');
        });
        function hideActiveStar(){
            $('.user-card').fadeOut(400, function(){
                $(this).remove();
                $('.stars circle.active').removeClass('active');
            });
        }
        function showStar(circleIndex, name, imgSrc){
            hideActiveStar();
            var userCard = $('\
        <div class="user-card" style="display:none;">\
            <img width="100" height="100" class="img-circle angel-img" onload="$(this).fadeIn()">\
            <h4 class="angel-name"></h4>\
          </div>\
      ');
            var card = $('.user-card');
            var circle = $($('.stars circle')[circleIndex]);
            var circleParent = circle.parent();
            userCard.find('.angel-img').attr('src', imgSrc);
            userCard.find('.angel-name').text(name);
            $('.stars').prepend(userCard);
            $('.user-card').fadeIn();
            var cardWidth = 140;
            var cardHeight = 160;
            userCard.css({
                left: ((circleParent.offset().left+parseInt(circle.attr('cx'))) * circleParent.outerWidth() / 873.296875) - (cardWidth/2),
                top: circleParent.offset().top+parseInt(circle.attr('cy')) - (cardHeight/2)
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.frame.frame', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>