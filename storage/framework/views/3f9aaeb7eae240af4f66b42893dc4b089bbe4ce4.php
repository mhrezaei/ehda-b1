<!DOCTYPE html>
<html>
    <head>
        <title><?php echo e(trans('global.siteTitle')); ?></title>
        <meta charset="utf-8"/>
        <?php echo Html::style('assets/css/fontiran.css'); ?>


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
                font-family: 'IRANSans';
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
                <div class="title"><?php echo e(trans('validation.http.Eror404')); ?></div>
            </div>
        </div>
    </body>
</html>
