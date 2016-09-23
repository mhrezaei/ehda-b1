@if(sizeof($event_slide_show))
<div class="row">
    <div class="owl-carousel home-slider events-slider" dir="ltr">
        @foreach($event_slide_show as $slide)
        <div class="item">
            <img src="{{ $slide->say('featured_image') }}">
            <div class="event-box">
                <div class="text">
                    @if(strlen($slide->title))
                        <h2>{{ $slide->title }}</h2>
                    @endif
                    @if(strlen($slide->meta('title_two')))
                        <p>{{ $slide->meta('title_two') }}</p>
                    @endif
                    @if(strlen($slide->meta('link')))
                        {{--<br>--}}
                        <a href="{{ url('') . $slide->meta('link') }}" style="color: white;">{{ trans('site.global.continue') }}</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif