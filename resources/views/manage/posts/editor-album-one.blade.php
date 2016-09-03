<div id="divPhoto-{{$key}}" class="row w100 m10 p10 {{$class or ''}}" -style="height: 100px">
	<div class="col-md-3 text-center">
		<img src="{{$src or ''}}" style="margin-top:15px;max-height:100px;max-width: 100px">
	</div>
	<div class="col-md-8 text-center">
		<input name="_photo_label_{{$key}}" value="{{$label or ''}}" class="-label form-control" placeholder="{{trans('posts.post_photos.label_placeholder')}}" style="margin-top: 40px">
		<input type="hidden" name="_photo_src_{{$key}}" value="{{$src or ''}}" class="-src form-control">
		<button type="button" class="btn btn-link" onclick="postPhotoRemoved($(this))">
			<span class="text-danger">
				<i class="fa fa-remove"></i>
				{{ trans('posts.post_photos.remove') }}
			</span>
		</button>
	</div>
	<div class="col-md-1 text-center">
	</div>
</div>