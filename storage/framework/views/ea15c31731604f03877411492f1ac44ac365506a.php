<?php /*<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>

<?php echo $__env->make('forms.group-start' , [
    'label' => isset($domain)? $domain->title : trans('validation.attributes.global_value'),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="row">
		<div class="col-md-3">
			<button id="<?php echo e(isset($domain)? "btn-".$domain->slug : "btn-global"); ?>" data-input="<?php echo e($input_id = isset($domain)? "txt-".$domain->slug : "txt-global"); ?>" data-callback="downstreamPhotoSelected('#<?php echo e($input_id); ?>')" class="btn btn-default btn-sm">
				<?php echo e(trans('forms.button.browse_image')); ?>

			</button>
		</div>
		<div class="col-md-9">
			<input id="<?php echo e($input_id); ?>" type="text" name="<?php echo e(isset($domain)? $domain->slug : 'global_value'); ?>" value="<?php echo e(isset($value) ? $value : ''); ?>" readonly class="form-control ltr clickable text-grey italic" onclick="downstreamPhotoPreview('#<?php echo e($input_id); ?>')">
			<i class="fa fa-times text-grey clickable" style="position: relative;top:-25px;left:-10px" onclick="$('#<?php echo e($input_id); ?>').val('')"></i>
		</div>
	</div>


	<script>
		$('#<?php echo e(isset($domain)? "btn-".$domain->slug : "btn-global"); ?>').filemanager('image');
	</script>

<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
