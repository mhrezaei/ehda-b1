@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/permits'),
	'modal_title' => $model->fullName(),
])

<div class='modal-body profile'>

	<table>

		{{--
		|--------------------------------------------------------------------------
		| Personal Information
		|--------------------------------------------------------------------------
		|
		--}}

		<tr>
			<td class="head">
				{{ trans('validation.attributes.code_meli') }}
			</td>
			<td class="body">
				{{ $model->say('code_meli') }}
			</td>
		</tr>

		<tr>
			<td class="head">
				{{ trans('validation.attributes.email') }}
			</td>
			<td class="body">
				{{ $model->say('email') }}
			</td>
		</tr>

		<tr>
			<td class="head">
				{{ trans('validation.attributes.birth_date') }}
			</td>
			<td class="body">
				{{ $model->say('birth_date') }}
				<span>
					{{ $model->say('birth_city') }}
				</span>
				<span>
					{{ trans('forms.general.'.$model->say('marital_status')) }}
				</span>
			</td>
		</tr>

		<tr>
			<td class="head">
				{{ trans('validation.attributes.education') }}
			</td>
			<td class="body">
				{{ trans('forms.education.'.$model->edu_level) }}
				<span>
					{{ $model->say('edu_field') }}
				</span>
				<span>
					{{ $model->edu_city? $model->say('edu_city') : '' }}
				</span>
			</td>
		</tr>

		{{--
		|--------------------------------------------------------------------------
		| Contact Details
		|--------------------------------------------------------------------------
		|
		--}}

		<tr>
			<td colspan="2">
				<hr>
			</td>
		</tr>


		<tr>
			<td class="head">
				{{ trans('validation.attributes.tel_mobile') }}
			</td>
			<td class="body">
				@pd($model->tel_mobile)
				<span>
					{{ trans('validation.attributes.tel_emergency') }}:&nbsp;
					@pd($model->tel_emergency)
				</span>
			</td>
		</tr>

		<tr>
			<td class="head">
				{{ trans('validation.attributes.home_address') }}
			</td>
			<td class="body">
				{{ $model->say('home_city').' . ' }}
				{{ $model->say('home_address') }}
				<span>
					{{ trans('validation.attributes.tel') }}:&nbsp;
					@pd($model->say('home_tel'))
				</span>
			</td>
		</tr>
		
		<tr>
			<td class="head">
				{{ trans('validation.attributes.work_address') }}
			</td>
			<td class="body">
				{{ $model->say('work_city').' . ' }}
				{{ $model->say('work_address') }}
				<span>
					{{ trans('validation.attributes.tel') }}:&nbsp;
					@pd($model->say('work_tel'))
				</span>
			</td>
		</tr>

		{{--
		|--------------------------------------------------------------------------
		| Misc Fields
		|--------------------------------------------------------------------------
		|
		--}}


		<tr>
			<td colspan="2">
				<hr>
			</td>
		</tr>
		
		<tr>
			<td class="head">
				{{ trans('exams.single') }}
			</td>
			<td class="body">
				@if($model->exam_passed_at)
					@pd($model->say('exam_result'))
					<span>
						({{$model->say('exam_passed_at')}})
					</span>
				@else
					{{ trans('exams.not_passed') }}
				@endif
			</td>
		</tr>
		
		<tr>
			<td class="head">
				{{ trans('validation.attributes.familization') }}
			</td>
			<td class="body">
				{{ trans("people.familization.".$model->familization) }}
			</td>
		</tr>

		<tr>
			<td class="head">
				{{ trans('validation.attributes.motivation') }}
			</td>
			<td class="body">
				{{ $model->say('motivation') }}
			</td>
		</tr>

		<tr>
			<td class="head">
				{{ trans('validation.attributes.alloc_time') }}
			</td>
			<td class="body">
				@pd($model->say('alloc_time'))
			</td>
		</tr>

		{{-- @TODO: Activitis --}}

		{{--
		|--------------------------------------------------------------------------
		| Timestamps
		|--------------------------------------------------------------------------
		|
		--}}

		<tr>
			<td colspan="2">
				<hr>
			</td>
		</tr>
		

		<tr>
			<td class="head">
				{{ trans('forms.general.created_at') }}
			</td>
			<td class="body">
				{{ $model->say('created_at') }}
				@if($model->created_by)
					<span>
						{{ trans('forms.general.by' , ['person'=>$model->say('created_by')]) }}
					</span>
				@endif
			</td>
		</tr>

		<tr>
			<td class="head">
				{{ trans('forms.general.updated_at') }}
			</td>
			<td class="body">
				{{ $model->say('updated_at') }}
				<span>
					{{ trans('forms.general.by' , ['person'=>$model->say('updated_by')]) }}
				</span>
			</td>
		</tr>


		@if($model->published_at)
			<tr>
				<td class="head">
					{{ trans('forms.general.published_at') }}
				</td>
				<td class="body">
					{{ $model->say('published_at') }}
					<span>
						{{ trans('forms.general.by' , ['person'=>$model->say('published_by')]) }}
					</span>
				</td>
			</tr>
		@endif


		@if($model->deleted_at)
			<tr>
				<td class="head">
					{{ trans('forms.general.deleted_at') }}
				</td>
				<td class="body">
					{{ $model->say('deleted_at') }}
					<span>
						{{ trans('forms.general.by' , ['person'=>$model->say('deleted_by')]) }}
					</span>
				</td>
			</tr>
		@endif

	</table>

</div>

@include('templates.modal.end')