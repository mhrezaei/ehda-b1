@if($model->canPublish() and !$model->isPublished())
	<div class="panel panel-default w100">
		<div class="panel-heading">
			{{ trans('posts.manage.show_date') }}
		</div>

		<div class="text-center m10">
			<input type="text" id="txtPublishDate" value="{{ $model->published_at? jdate($model->published_at)->format('Y/m/d') : '' }}" class="form-control text-center datepicker" placeholder="{{ trans('posts.manage.publish_immediately') }}">
			<input id="txtPublishDate_extra" name="publish_date" value="{{$model->published_at? $model->published_at : '' }}" type="hidden" >
		</div>

	</div>
@endif