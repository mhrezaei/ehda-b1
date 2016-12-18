<div class="form-group">
	<label class="col-sm-2 control-label <?php echo e(isset($label_class) ? $label_class : ''); ?>">
		<?php echo e(isset($label) ? $label : ' '); ?>

		<?php if(isset($required) and $required): ?>
			<span class="fa fa-star required-sign " title="<?php echo e(trans('forms.logic.required')); ?>"></span>
		<?php endif; ?>
	</label>

	<div class="col-sm-10">

		<?php if(0): ?>
	</div>
</div>
<?php endif; ?>