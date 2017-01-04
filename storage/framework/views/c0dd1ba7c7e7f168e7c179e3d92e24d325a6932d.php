<div class="radio">
    <label style="font-size: 12px;">
        <input type="radio" value="<?php echo e(isset($value) ? $value : ''); ?>" id="answer-<?php echo e(isset($id) ? $id : ''); ?>" name="answer-<?php echo e(isset($id) ? $id : ''); ?>"
               style="display: block; font-size: 12px;">
        <?php echo e(isset($label) ? $label : ''); ?>)
        &nbsp;
        <?php echo App\Providers\AppServiceProvider::pd(($title)) ?>
    </label>
</div>