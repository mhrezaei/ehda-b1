<td>
	<input id="gridSelector-<?php echo e($model->id); ?>" data-value="<?php echo e($model->id); ?>" class="gridSelector" type="checkbox" onchange="gridSelector('selector','<?php echo e($model->id); ?>')">
</td>
<td>
	<?php echo e($model->fullName()); ?>

</td>


<td>
	<?php echo e($model->say('home_city')); ?>

</td>


<td>
	<?php echo e($model->occupation()); ?>

</td>

<td>
	<?php if($model->isCard()): ?>
		<span class="text-success"><?php echo e(trans('forms.logic.has')); ?></span>
	<?php else: ?>
		-
	<?php endif; ?>
</td>


<td>
	<span class="text-<?php echo e($model->volunteerStatus('color')); ?>">
		<?php echo e($model->volunteerStatus()); ?>

	</span>
</td>

<td>
	<?php echo $__env->make('manage.frame.widgets.grid-action' , [
		'id' => $model->id ,
		'actions' => [
			['eye' , trans('manage.permits.view') , "modal:manage/volunteers/-id-/view" , 'volunteers.view'],
			['copy' , trans('people.volunteers.manage.care_review') , 'modal:manage/volunteers/-id-/care_review' , 'volunteers.edit' ,  $model->isActive() and $model->unverified_flag>0 ],
			['key' , trans('people.commands.change_password') , 'modal:manage/volunteers/-id-/change_password' , 'volunteers.edit' ,  $model->isActive() ],
			['pencil' , trans('manage.permits.edit') , "modal:manage/volunteers/-id-/edit" , 'volunteers.edit'],
			['shield' , trans('manage.permits.permits') , 'modal:manage/volunteers/-id-/permits' , 'volunteers.permits' , $model->isActive()],

			['envelope-o' , trans('people.commands.send_email') , 'modal:manage/volunteers/-id-/email' , 'volunteers.send' , $model->email ] ,
			['mobile' , trans('people.commands.send_sms') , 'modal:manage/volunteers/-id-/sms' , 'volunteers.send' , $model->tel_mobile ] ,

			['check' , trans('people.commands.activate') , 'modal:manage/volunteers/-id-/publish' , 'volunteers.publish' , !$model->published_at],
			['ban' , trans('people.commands.block') , 'modal:manage/volunteers/-id-/soft_delete' , 'volunteers.delete' , !$model->trashed()] ,
			['undo' , trans('people.commands.unblock') , 'modal:manage/volunteers/-id-/undelete' , 'volunteers.bin' , $model->trashed()] ,
			['times' , trans('people.commands.hard_delete') , 'modal:manage/volunteers/-id-/hard_delete' , 'volunteers.developer' , $model->trashed()] ,


		],
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</td>