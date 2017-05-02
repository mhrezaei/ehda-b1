@extends('site.frame.frame')
<title>{{ trans('global.siteTitle') }} | {{ trans('site.global.home_page') }}</title>

@section('content')
    {!! Form::open([
                'method'=> 'post',
                'name' => 'angels_find',
                'id' => 'angels_find',
            ]) !!}
    {!! Form::close() !!}
    <div class="container-fluid text-center" id="contentData">
        تست دریافت پاسخ از سرور در دیتا سنتر و سرور لوکال هاست

    </div>


    <script>
        $(document).ready(function () {
            var content = $('#contentData');
            var tok = $('input[name=_token]').val();

            content.append('<br>');
            content.append('در حال اتصال به سرور در دیتاسنتر ...');
            content.append('<br>');
            content.append('token: ' + tok);
            content.append('<br>');

            $.ajax({
                type: "POST",
                url: base_url() + "/hadi/ajax/response",
                cache: false,
                dataType: "json",
                data: {
                    pid: '123',
                    _token: tok
                }
            }).done(function(Data){
                content.append('Data Received :-)');
                content.append('<br>');
                content.append('Time: ' + Data.time);
                content.append('<hr>');
                content.append('Now I try connect to local server via http://192.168.1.111/~435');

                $.ajax({
                    type: "POST",
//                    url: "http://192.168.1.111/~435",
                    crossDomain: true,
                    url: "https://eapi.yasnateam.com",
                    cache: false,
                    dataType: "json",
                    data: {
                        _token: tok
                    }
                }).done(function(Data){
                    content.append('Connect to local server success');
                    content.append('<br>');
                    content.append('Time: ' + Data.time);
                    content.append('<hr>');
                    content.append("it's good :-)");

                });

            });

            content.append('<hr>');
        });
    </script>

@endsection