<?php if(!isset($modal_id)): ?>
	<?php $modal_id = "modal".rand(1,10000); ?>
<?php endif; ?>
<?php if(!isset($partial) or !$partial): ?>
<div id="<?php echo e($modal_id); ?>" class="modal fade <?php echo e(isset($modal_class) ? $modal_class : ''); ?>">
	<div class="modal-dialog modal-<?php echo e(isset($modal_size) ? $modal_size : 'lg'); ?>" >
		<div class="modal-content">
			<?php endif; ?>

			<?php if(isset($modal_title)): ?>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 id="<?php echo e($modal_id); ?>-title" class="modal-title">
						<?php echo e($modal_title); ?>

					</h4>
				</div>
			<?php endif; ?>

			<?php echo $__env->make('forms.opener',[
				'id' => $modal_id.'-form' ,
				'url' => isset($form_url)? url($form_url) : '#' ,
				'method' => isset($form_method)? $form_method : 'post' ,
				'files' => isset($form_files)? $form_files : 'false' ,
				'class' => isset($form_class)? "js $form_class" : 'js ' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.hidden' , [
				'name' => '_modal_id' ,
				'value' => $modal_id ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php if(isset($hidden_vars)): ?>
				<?php foreach($hidden_vars as $idx => $hidden_var): ?>
						<label class="hidden _<?php echo e($idx); ?>"><?php echo e($hidden_var); ?></label>
					<?php endforeach; ?>
			<?php endif; ?>

			<?php /* divs classed `modal-body` and `moda-footer` should be included in the page. Sorry but either this or no blade at all. */ ?>

			<?php if(0): ?>
		</div>
	</div>
</div>
<?php endif; ?>