@include('forms.group-start' , [
	'label' => trans($caption),
])

<div class="row w100 m5">
	@foreach($permits as $permit)
		<div class="col-md-3">
			<div class="checkbox">
				<label>
					<input type="hidden" name="permit{{$module}}_{{$permit}}" value="0">
					{!! Form::checkbox("permit".$module."_".$permit , '1' , $model->can("$module.$permit")? '1' : '0' , ['class' => '-permits']) !!}
					{{ trans('manage.permits.'.$permit) }}
				</label>
			</div>
		</div>
	@endforeach
</div>

@include('forms.group-end')
