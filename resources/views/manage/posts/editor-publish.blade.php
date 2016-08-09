<div class="panel panel-default w100 -publish-now">
	<div class="panel-heading">
		{{ trans('posts.manage.publish') }}
	</div>
	<div class="text-center m10">
		<button type="button" class="btn btn-success btn-sm">{{ trans('posts.manage.publish_now') }}</button>
	</div>
	@if(!$model->published_at)
		<div class="text-center m10">
			<button type="button" class="btn btn-link btn-sm" onclick="$('.-publish-now,.-publish-schedule').slideToggle('fast')">
				{{ trans('posts.manage.publish_schedule') }}
			</button>
		</div>
	@endif

</div>

<div class="panel panel-default w100 -publish-schedule" style="display:none">
	<div class="panel-heading">
		{{ trans('posts.manage.publish') }}
	</div>
	<div class="text-center m10">
		<input type="text" id="txtPublishDate" value="" class="form-control text-center datepicker" placeholder="{{ trans('posts.manage.publish_date') }}">
		<input id="txtPublishDate_extra" name="publish_date" value="" type="hidden" >
	</div>
	<div class="text-center m10">
		<button type="button" class="btn btn-primary btn-sm">{{ trans('posts.manage.save_schedule') }}</button>
	</div>
	<div class="text-center m10">
		<button type="button" class="btn btn-link btn-sm" onclick="$('.-publish-now,.-publish-schedule').slideToggle('fast')">
			{{ trans('posts.manage.publish_now') }}
		</button>
	</div>
</div>