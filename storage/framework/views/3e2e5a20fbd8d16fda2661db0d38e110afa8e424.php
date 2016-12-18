<div class="panel panel-default w100">
	<?php /*
	|--------------------------------------------------------------------------
	| Title
	|--------------------------------------------------------------------------
	| 
	*/ ?>

	<div class="panel-heading">
		<?php echo e(trans('posts.post_photos.title')); ?>

		&nbsp;(
		<span id="spnPhotoCount" ><?php echo App\Providers\AppServiceProvider::pd(($model->photos_count)) ?></span>
		)
	</div>

	<?php /*
	|--------------------------------------------------------------------------
	| Already uploaded photos
	|--------------------------------------------------------------------------
	| 
	*/ ?>
	<div id="divPhotos">
		<?php foreach($model->photos as $key => $photo): ?>
			<?php echo $__env->make('manage.posts.editor-album-one' , [
				'key' => $key ,
				'src' => $photo['src'] ,
				'label' => $photo['label'] ,
				'link' => isset($photo['link'])? $photo['link'] : '',
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endforeach; ?>
	</div>
	<div id="divNewPhoto">
		<?php echo $__env->make('manage.posts.editor-album-one' , [
			'key' => 'NEW' ,
			'class' => 'noDisplay'
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<input type="hidden" id="txtLastKey" value="<?php echo e(isset($key) ? $key : 0); ?>">


	<?php /*
	|--------------------------------------------------------------------------
	| New Panel
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div class="m10 text-center" style="">
		<btn id="btnAddPhoto" data-input="txtAddPhoto" data-preview="imgAddPhoto" data-callback="postPhotoAdded()" class="btn btn-default btn-lg">
			<?php echo e(trans('posts.post_photos.add')); ?>

		</btn>
		<input type="hidden" id="txtAddPhoto">
		<img id="imgAddPhoto" class="noDisplay" src="">
	</div>

</div>

<?php /*
|--------------------------------------------------------------------------
| Javascript function
|--------------------------------------------------------------------------
|
*/ ?>

<script>
	$('#btnAddPhoto').filemanager('image');
</script>