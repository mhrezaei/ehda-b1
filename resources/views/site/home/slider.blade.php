@if(sizeof($slide_show))
<div class="row">
    <div class="owl-carousel home-slider" dir="ltr">
        @foreach($slide_show as $slide)
            <div class="item" dir="rtl">
                @if($slide->meta('link'))
                    <a href="{{ $slide->meta('link') }}" target="_blank">
                @endif
                <img src="{{ $slide->say('featured_image') }}">
                <div class="slide-text">
                    @if(strlen($slide->title))
                        <h3>{{ $slide->title }}</h3>
                    @endif
                    @if(strlen($slide->meta('title_two')))
                        <span>{{ $slide->meta('title_two') }}</span>
                    @endif
                </div>
                @if($slide->meta('link'))
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endif