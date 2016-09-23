@if(sizeof($slide_show))
<div class="row">
    <div class="owl-carousel home-slider" dir="ltr">
        @foreach($slide_show as $slide)
            <div class="item" dir="rtl">
                <img src="{{ $slide->say('featured_image') }}">
                <div class="slide-text">
                    @if(strlen($slide->title))
                        <h3>{{ $slide->title }}</h3>
                    @endif
                    @if(strlen($slide->meta('title_two')))
                        <span>{{ $slide->meta('title_two') }}</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif