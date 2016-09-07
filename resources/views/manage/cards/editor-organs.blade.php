<div class="row w100">
	@foreach($organs as $organ)
		@include('forms.check' , [
			'div_class' => 'col-md-1' ,
			'name' => "_$organ",
			'label' => trans("people.organs.$organ"),
			'value' => str_contains($model->organs , trans("people.organs.$organ"))? 1 : 0 ,
			'class' => '-organSelector',
		])
	@endforeach

		<div class="col-md-2">
			<a href="javascript:void(0)" class="btn btn-link f10" onclick="$('.-organSelector').prop('checked', true)">
				{{ trans('forms.general.all') }}
			</a>
		</div>
		<div class="col-md-2">
			<a href="javascript:void(0)" class="btn btn-link f10" onclick="$('.-organSelector').prop('checked', false)">
				{{ trans('forms.general.none') }}
			</a>
		</div>
</div>
