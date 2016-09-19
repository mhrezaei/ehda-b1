<div class="col-xs-12 col-sm-6">
    @if(sizeof($events))
        <h3>{{ trans('site.global.events') }}</h3>
        <ul class="events list-unstyled">
            @foreach($events as $event)
                <li>
                    <a href="{{ url('showPost/' . $event->id . '/' . urlencode($event->title)) }}">@pd($event->title)</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>