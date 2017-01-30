<footer class="bg-primary" style="padding-bottom: 40px;">
    <div class="container">
        <div class="row">
            @include('site.frame.footer_menu')
            <div class="col-xs-12 col-md-8">
                @include('site.frame.footer_social_network')
                @include('site.frame.footer_contact_info')
            </div>
        </div>
        <div class="row" style="text-align: center; color: #FFFAAA; font-size: 12px; padding-top: 20px;">
            <a href="https://yasnateam.com" target="_blank" style="color: #FFFAAA;">طراحی و اجرا: گروه یسنا</a>
        </div>
    </div>
</footer>
{!! Html::script ('assets/site/js/main.js') !!}
</body>
</html>