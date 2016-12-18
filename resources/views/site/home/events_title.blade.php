<div class="col-xs-12 col-sm-4">
    @if(sizeof($events))
        <h4>{{ trans('site.global.events') }}</h4>
        <ul class="events list-unstyled">
            @foreach($events as $event)
                <li>
                    <a href="{{ $event->say('link') }}">@pd($event->say('title_limit'))</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>