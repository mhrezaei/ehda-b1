<?php if(!isset($id)) $id = \Illuminate\Support\Str::random(60) ; ?>
<div class="checkbox">
    <label title="{{ $title or '' }}">
		<input type="hidden" name="{{$name}}" value="0">
		{!! Form::checkbox($name , '1' , $value , [
		    'class' => isset($class)? $class : ''
		]) !!}
        {{ $label or trans("validation.attributes.$name") }}
    </label>
</div>
