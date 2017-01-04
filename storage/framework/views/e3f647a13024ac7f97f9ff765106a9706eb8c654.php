<?php if($model->branch()->hasFeature('schedule')): ?>
	<div class="panel panel-default w100">
		<div class="panel-heading">
			<?php echo e(trans('posts.manage.show_date')); ?>

		</div>

		<?php if(!$model->published_by): ?>
			<div class="text-center m10">
				<?php echo $__env->make('forms.select_self' , [
					'name' => 'publish_date_mode' ,
					'id' => 'cmbPublishDate' ,
					'blank_value' => 'auto',
					'blank_label' => trans('posts.manage.publish_immediately') ,
					'extra' => 'onChange=postDomainSelector()' ,
					'value' => $model->published_at? 'custom' : 'auto' ,
					'options' => [['id'=>'custom' , 'title'=>trans('posts.manage.publish_custom')]] ,
					'on_change' => "postEditorFeatures()" ,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		<?php else: ?>
			<?php echo $__env->make('forms.hiddens' , ['fields' => [
				['publish_date_mode' , 'custom'],
			]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endif; ?>


		<div class="text-center m10 <?php echo e($model->published_at? '' : 'noDisplay'); ?>">
			<input type="text" name="publish_date" time="1"  id="txtPublishDate" readonly value="<?php echo e(jdate($model->published_at)->format('Y/m/d/H/i/s')); ?>" placeholder="<?php echo e(trans('posts.manage.publish_immediately')); ?>"  class="form-control text-center form-datepicker form-required clickable ">
		</div>

	</div>
<?php else: ?>

<?php endif; ?>

