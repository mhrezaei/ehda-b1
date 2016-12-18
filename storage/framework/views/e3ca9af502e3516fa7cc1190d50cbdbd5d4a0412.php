<?php if($model->branch()->hasFeature('image')): ?>
	<div class="panel panel-default w100">
		<div class="panel-heading">
			<?php echo e(trans('posts.manage.featured_image')); ?>

		</div>

		<div class="m10 text-center" style="">
			<btn id="btnFeaturedImage" data-input="txtFeaturedImage" data-preview="imgFeaturedImage" data-callback="postEditorFeatures('featured_image_inserted')" class="btn btn-<?php echo e($model->featured_image? 'default' : 'primary'); ?>">
				<?php echo e(trans('forms.button.browse_image')); ?>

			</btn>
			<input id="txtFeaturedImage" type="hidden" name="featured_image" value="<?php echo e($model->featured_image? url($model->featured_image) : ''); ?>">
			<div id="divFeaturedImage" class="<?php echo e($model->featured_image? '' : 'noDisplay'); ?>">
				<div class="text-center">
					<img id="imgFeaturedImage" src="<?php echo e($model->featured_image? url($model->featured_image) : ''); ?>" style="margin-top:15px;max-height:100px;max-width: 100%">
				</div>
				<btn id="btnDeleteFeaturedImage" class="btn btn-link btn-xs">
				<span class="text-danger clickable" onclick="postEditorFeatures('featured_image_deleted')">
					<?php echo e(trans('posts.manage.delete_featured_image')); ?>

				</span>
				</btn>
			</div>
		</div>
	</div>

	<script>
		$('#btnFeaturedImage').filemanager('image');
	</script>
<?php endif; ?>