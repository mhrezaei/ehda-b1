<!DOCTYPE html>
<html>
    <head>
        <title>{{ trans('global.siteTitle') }}</title>

        {{--<link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">--}}
        {!! HTML::style('assets/css/fonts-fa.css') !!}
        {!! HTML::style('assets/css/home.css') !!}

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'tahaTitr';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 42px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">
                    با ما به از این باش که با خلق جهانی
                </div>
            </div>
        </div>
    </body>
</html>
