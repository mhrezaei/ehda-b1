<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
{{--    {!! Html::style('assets/libs/bootstrap/css/bootstrap.min.css') !!}--}}
{{--    {!! Html::style('assets/libs/bootstrap/css/bootstrap-rtl.min.css') !!}--}}
    {!! Html::style('assets/site/css/bootstrap.css') !!}
    {!! Html::style('assets/site/css/fonts.css') !!}
    {!! Html::style('assets/site/css/style.css') !!}


    {!! Html::script ('assets/libs/jquery-3.1.0.min.js') !!}
    {!! Html::script ('assets/site/js/bootstrap.min.js') !!}
{{--    {!! HTML::script ('assets/libs/bootstrap/js/bootstrap.min.js') !!}--}}
    {!! Html::script ('assets/libs/owl.carousel.min.js') !!}
    {!! Html::script ('assets/libs/circle-progress.js') !!}
    {!! Html::script ('assets/js/forms.js') !!}


    <script language="javascript">
        function base_url($ext) {
            if(!$ext) $ext = "" ;
            var $result = '{{ URL::to('/') }}' + $ext ;
            return $result  ;
        }
    </script>
</head>
<body>
<header class="clearfix container-fluid">
    @include('site.frame.top_header')
    @include('site.frame.top_header_menu')
    @include('site.frame.organ_donation_btn')
</header>