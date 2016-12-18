<div class="row w100">
	<?php foreach($organs as $organ): ?>
		<?php echo $__env->make('forms.check' , [
			'div_class' => 'col-md-1' ,
			'name' => "_$organ",
			'label' => trans("people.organs.$organ"),
			'value' => str_contains($model->organs , trans("people.organs.$organ"))? 1 : 0 ,
			'class' => '-organSelector',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endforeach; ?>

		<div class="col-md-2">
			<a href="javascript:void(0)" class="btn btn-link f10" onclick="$('.-organSelector').prop('checked', true)">
				<?php echo e(trans('forms.general.all')); ?>

			</a>
		</div>
		<div class="col-md-2">
			<a href="javascript:void(0)" class="btn btn-link f10" onclick="$('.-organSelector').prop('checked', false)">
				<?php echo e(trans('forms.general.none')); ?>

			</a>
		</div>
</div>
