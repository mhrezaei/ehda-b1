<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>انجمن اهدای عضو ایرانیان</title>
    {!! Html::style('assets/site/css/style.css') !!}
    {!! Html::script ('assets/libs/jquery-3.1.0.min.js') !!}
    {!! Html::script ('assets/libs/owl.carousel.min.js') !!}
    {!! Html::script ('assets/libs/circle-progress.js') !!}
    {!! Html::script ('assets/site/js/main.js') !!}
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