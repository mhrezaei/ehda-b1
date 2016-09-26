<div class="col-xs-12 col-sm-6">
    @if(sizeof($events))
        <h3>{{ trans('site.global.events') }}</h3>
        <ul class="events list-unstyled">
            @foreach($events as $event)
                <li>
                    <a href="{{ $event->say('link') }}">@pd($event->say('title_limit'))</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>