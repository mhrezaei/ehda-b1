<div class="m10 text-center" style="">
	<btn id="btnFeaturedImage" data-input="txtFeaturedImage" data-preview="imgFeaturedImage" data-callback="postEditorFeatures('featured_image_inserted')" class="btn btn-{{ $model->image? 'default' : 'primary' }}">
		{{ trans('forms.button.browse_image') }}
	</btn>
	<input id="txtFeaturedImage" type="hidden" name="featured_image" value="{{ $model->image? url($model->image) : '' }}">
	<div id="divFeaturedImage" class="{{ $model->image? '' : 'noDisplay' }}">
		<div class="text-center">
			<img id="imgFeaturedImage" src="{{ $model->image? url($model->image) : '' }}" style="margin-top:15px;max-height:100px;max-width: 100%">
		</div>
		<btn id="btnDeleteFeaturedImage" class="btn btn-link btn-xs">
				<span class="text-danger clickable" onclick="postEditorFeatures('featured_image_deleted')">
					{{ trans('posts.manage.delete_featured_image') }}
				</span>
		</btn>
	</div>
</div>
