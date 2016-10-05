@if($activity)
    @foreach($activity as $act)
        <div class="checkbox">
            <label>
                <input name="activity[]" type="checkbox" value="{{ $act->slug }}" style="display: block;"> {{ $act->title }}
            </label>
        </div>
    @endforeach
@endif