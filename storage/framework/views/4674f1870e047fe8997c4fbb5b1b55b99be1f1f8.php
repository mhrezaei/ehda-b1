<div id="divPhoto-<?php echo e($key); ?>" class="row w100 m10 p10 <?php echo e(isset($class) ? $class : ''); ?>" -style="height: 100px">
	<div class="col-md-3 text-center">
		<img src="<?php echo e(isset($src)? url($src) : ''); ?>" style="margin-top:15px;max-height:100px;max-width: 100px">
	</div>
	<div class="col-md-8 text-center">
		<input name="_photo_label_<?php echo e($key); ?>" value="<?php echo e(isset($label) ? $label : ''); ?>" class="-label form-control text-center" placeholder="<?php echo e(trans('posts.post_photos.label_placeholder')); ?>" style="margin-top: 15px">
		<input name="_photo_link_<?php echo e($key); ?>" value="<?php echo e(isset($link) ? $link : ''); ?>" class="-label form-control text-center ltr" placeholder="<?php echo e(trans('posts.post_photos.link_placeholder')); ?>" style="margin-top:5px">
		<input type="hidden" name="_photo_src_<?php echo e($key); ?>" value="<?php echo e(isset($src)? url($src) : ''); ?>" class="-src form-control">
		<button type="button" class="btn btn-link" onclick="postPhotoRemoved($(this))">
			<span class="text-danger">
				<i class="fa fa-remove"></i>
				<?php echo e(trans('posts.post_photos.remove')); ?>

			</span>
		</button>
	</div>
	<div class="col-md-1 text-center">
	</div>
</div>