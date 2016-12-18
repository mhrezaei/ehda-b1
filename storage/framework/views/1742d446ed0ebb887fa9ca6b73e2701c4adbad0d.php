<?php echo Html::script ('assets/libs/jquery.form.min.js'); ?>

<?php echo Html::script ('assets/js/forms.js'); ?>


<style>
    .btn{
        width: 170px !important;
    }
</style>

<div class="row article">
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-center col-xs-12 col-md-12">
                        <img src="<?php echo e(url('/card/show_card/mini/' . encrypt(Auth::user()->code_melli))); ?>" alt="<?php echo e(trans('site.know_menu.organ_donation_card')); ?>" class="ehda-card-image">
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        <?php echo $card_detail->text; ?>

                        <div style="width: 100%; margin-top: 15px; text-align: center;">
                            <?php echo $__env->make('forms.button', [
                                'shape' => 'info',
                                'link' => url('/card/show_card/full/' . encrypt(Auth::user()->code_melli) . '/download'),
                                'label' => trans('forms.button.card_save'),
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <a class="btn btn-info" href="<?php echo e(url('/members/my_card/print')); ?>" target="_blank"><?php echo e(trans('forms.button.card_print')); ?></a>
                            <div style="clear: both; margin-top: 10px;"></div>
                            <?php echo $__env->make('forms.button', [
                                'shape' => 'primary',
                                'link' => url('/members/my_card/edit'),
                                'label' => trans('site.global.users_edit_data'),
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                            <?php echo $__env->make('forms.button', [
                                'shape' => 'success',
                                'link' => url('/volunteers'),
                                'label' => trans('manage.modules.volunteers'),
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>