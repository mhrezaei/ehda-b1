<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
<?php /*    <?php echo Html::style('assets/libs/bootstrap/css/bootstrap.min.css'); ?>*/ ?>
<?php /*    <?php echo Html::style('assets/libs/bootstrap/css/bootstrap-rtl.min.css'); ?>*/ ?>
    <?php echo Html::style('assets/site/css/bootstrap.css'); ?>

    <?php echo Html::style('assets/site/css/fonts.css'); ?>

    <?php echo Html::style('assets/site/css/style.css'); ?>

    <?php echo Html::style('assets/site/css/hadi.css'); ?>



    <?php echo Html::script ('assets/libs/jquery-3.1.0.min.js'); ?>

    <?php echo Html::script ('assets/site/js/bootstrap.min.js'); ?>

<?php /*    <?php echo HTML::script ('assets/libs/bootstrap/js/bootstrap.min.js'); ?>*/ ?>
    <?php echo Html::script ('assets/libs/owl.carousel.min.js'); ?>

    <?php echo Html::script ('assets/libs/circle-progress.js'); ?>

    <?php echo Html::script ('assets/js/forms.js'); ?>

    <?php echo Html::script ('assets/site/js/general.js'); ?>



    <script language="javascript">
        function base_url($ext) {
            if(!$ext) $ext = "" ;
            var $result = '<?php echo e(URL::to('/')); ?>' + $ext ;
            return $result  ;
        }
    </script>
</head>
<body>
<img src="<?php echo e(url('/assets/site/images/64.gif')); ?>" style="display: none;">
<header class="clearfix container-fluid">
    <?php echo $__env->make('site.frame.top_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('site.frame.top_header_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('site.frame.organ_donation_btn', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</header>