<div class="panel panel-default w100">
	<div class="panel-heading">
		{{ trans('posts.manage.featured_image') }}
	</div>

	<div class="m10 text-center" style="">
		<btn id="btnFeaturedImage" data-input="txtFeaturedImage" data-preview="imgFeaturedImage" class="btn btn-{{ $model->featured_image? 'default' : 'primary' }}">
			{{ trans('forms.button.browse_image') }}
		</btn>
		<input id="txtFeaturedImage" type="hidden" name="featured_image" value="{{ $model->featured_image }}">
		<div class="text-center">
			<img id="imgFeaturedImage" src="{{ $model->featured_image }}" style="margin-top:15px;max-height:100px;" ondblclick="postEditorFeatures('delete_featured_image')">
		</div>
		@if($model->featured_image)
			<btn id="btnDeleteFeaturedImage" class="btn btn-link btn-xs">
				<span class="text-danger clickable" onclick="postEditorFeatures('delete_featured_image')">
					{{ trans('posts.manage.delete_featured_image') }}
				</span>
			</btn>
		@endif
	</div>
</div>

<script>
	$('#btnFeaturedImage').filemanager('image');
</script>