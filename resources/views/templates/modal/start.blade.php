<div id="{{ $modalId or '' }}" class="modal fade">
	<div class="modal-dialog modal-{{ $modalSize or '' }}  ">
		<div class="modal-content">
			{!! Form::open([
				'url'=>$formAction,
				'id'=>$modalId."-form",
				'class'=>$formClass
			]) !!}

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 id="{{ $modalId or ''}}-title" class="modal-title">
					{{ $modalTitle or '' }}
				</h4>
			</div>
