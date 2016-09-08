@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/permits'),
	'modal_title' => trans('people.commands.view_info'),
])

<div class='modal-body profile'>

	<div style="position:absolute;top: 10px;left: 10px">
		<a href="{{url('/card/show_card/mini/'.$model->say('encrypted_code_melli'))}}" target="_blank">
			<img src="{{url('/card/show_card/mini/'.$model->say('encrypted_code_melli'))}}" style="height: 450px">
		</a>
	</div>

	<h2 class="mv20">
		{{ $model->fullName() }}
		@if($model->isVolunteer())
			<a href="{{Auth::user()->can('volunteers.search')? url('manage/volunteers/search?keyword='.$model->code_melli.'&searched=1') : 'javascript:void(0)'}}" class="badge badge-success mh10 f7" target="_blank">
				{{ trans('people.volunteer') }}
			</a>
		@endif
		@if($model->newsletter)
			<div class="badge badge-info f7">
				{{ trans('people.cards.manage.newsletter_member') }}
			</div>
		@endif

	</h2>

	<table>

		{{--
		|--------------------------------------------------------------------------
		| Status
		|--------------------------------------------------------------------------
		|
		--}}
		<tr>
			<td class="head">
				{{ trans('validation.attributes.status') }}
			</td>
			<td class="body text-{{ $model->cardStatus('color') }}">
				{{ $model->cardStatus() }}
			</td>
		</tr>

		<tr>
			<td class="head">
				{{ trans('validation.attributes.card_no') }}
			</td>
			<td class="body">
				{{ $model->say('card_no') }}
			</td>
		</tr>

		<tr>
			<td class="head">
				{{ trans('people.commands.print_status') }}
			</td>
			<td class="body text-{{trans('people.card_print_status_color.'.$model->card_print_status)}}">
				{{ trans('people.card_print_status.'.$model->card_print_status) }}
			</td>
		</tr>


		{{--
		|--------------------------------------------------------------------------
		| Personal Information
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
				{{ trans('validation.attributes.code_melli') }}
			</td>
			<td class="body">
				{{ $model->say('code_melli') }}
			</td>
		</tr>

		<tr>
			<td class="head">
				{{ trans('validation.attributes.code_id') }}
			</td>
			<td class="body">
				{{ $model->say('code_id') }}
			</td>
		</tr>

		<tr>
			<td class="head">
				{{ trans('validation.attributes.name_father') }}
			</td>
			<td class="body">
				{{ $model->say('name_father') }}
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
					{{ $model->say('marital') }}
				</span>
			</td>
		</tr>

		<tr>
			<td class="head">
				{{ trans('validation.attributes.education') }}
			</td>
			<td class="body">
				{{ $model->say('education') }}
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
					{{ trans('validation.attributes.postal_code') }}:&nbsp;
					{{ $model->say('home_postal_code') }}
				</span>
				<span>
					{{ trans('validation.attributes.tel') }}:&nbsp;
					@pd($model->say('home_tel'))
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
				{{ trans('validation.attributes.organs') }}
			</td>
			<td class="body">
				{{ $model->say('organs') }}
			</td>
		</tr>

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
				{{ $model->say('card_registered_at') }}
				@if($model->created_by)
					<span>
						{{ trans('forms.general.by'). ' ' . $model->say('created_by') }}
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
				{{--<span>--}}
					{{--{{ trans('forms.general.by').' '.$model->say('updated_by') }}--}}
				{{--</span>--}}
			</td>
		</tr>

		@if($model->trashed('card'))
			<tr>
				<td class="head">
					{{ trans('forms.general.deleted_at') }}
				</td>
				{{--<td class="body">--}}
					{{--{{ $model->say('deleted_at') }}--}}
					{{--<span>--}}
						{{--{{ trans('forms.general.by').' '.$model->say('deleted_by') }}--}}
					{{--</span>--}}
				{{--</td>--}}
			</tr>
		@endif

	</table>

</div>

@include('templates.modal.end')
