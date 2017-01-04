<td>
	<input id="gridSelector-<?php echo e($model->id); ?>" data-value="<?php echo e($model->id); ?>" class="gridSelector" type="checkbox" onchange="gridSelector('selector','<?php echo e($model->id); ?>')">
</td>
<td>
	<div>
		<?php echo e($model->fullName()); ?>

		<?php if($model->isVolunteer()): ?>
			<a href="<?php echo e(Auth::user()->can('volunteers.search')? url('manage/volunteers/search?keyword='.$model->code_melli.'&searched=1') : 'javascript:void(0)'); ?>" class="badge badge-success mh10 f7">
				<?php echo e(trans('people.volunteer')); ?>

			</a>
		<?php endif; ?>
	</div>
	<div class="mv5 f10 text-grey">
		<?php echo e(trans('validation.attributes.card_no')); ?>:&nbsp;
		<?php echo e($model->say('card_no')); ?>

	</div>
</td>


<td>
	<?php echo e($model->say('home_city')); ?>

</td>


<td>
	<?php echo e($model->say('from_domain')); ?>

</td>

<td>
	<div class="text-<?php echo e($model->cardStatus('color')); ?>">
		<?php echo e($model->cardStatus()); ?>

	</div>
	<?php if($model->card_print_status): ?>
		<div class="f10 mv5 text-<?php echo e(trans('people.card_print_status_color.'.$model->card_print_status)); ?>">
			<?php echo e(trans('people.cards.manage.pvc_card')); ?>:&nbsp;
			<?php echo e(trans('people.card_print_status.'.$model->card_print_status)); ?>

		</div>
	<?php endif; ?>
	<?php if($model->newsletter): ?>
		<div class="badge badge-info f7">
			<?php echo e(trans('people.cards.manage.newsletter_member')); ?>

		</div>
	<?php endif; ?>
</td>

<td>
	<?php echo $__env->make('manage.frame.widgets.grid-action' , [
		'id' => $model->id ,
		'actions' => [
			['credit-card' , trans('people.commands.view_card') , "modal:manage/cards/-id-/card" , 'cards.*'],
			['eye' , trans('people.commands.view_info') , "modal:manage/cards/-id-/view" , 'cards.view'],

			['key' , trans('people.commands.change_password') , 'modal:manage/cards/-id-/change_password' , 'cards.edit' ,  $model->isActive('card') ],
			['pencil' , trans('manage.permits.edit') , "url:manage/cards/-id-/edit" , $model->isActiveVolunteer()? 'volunteers.edit' : 'cards.edit'],

			['print' , trans('forms.button.card_print') , 'modal:manage/cards/-id-/print' , 'cards.print' , $model->isActive('card') ] ,
//			['envelope-o' , trans('people.commands.send_email') , 'modal:manage/cards/-id-/email' , 'cards.send' , $model->email ] ,
//			['mobile' , trans('people.commands.send_sms') , 'modal:manage/cards/-id-/sms' , 'cards.send' , $model->tel_mobile ] ,

			['user-plus' , trans('people.cards.manage.add_as_volunteer') , 'url:manage/volunteers/-id-/edit' , 'volunteers.create' , !$model->isVolunteer()] ,
			['times' , trans('forms.button.hard_delete') , 'modal:manage/cards/-id-/delete' , 'cards.delete' , !$model->trashed('card')] ,
		],
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</td>