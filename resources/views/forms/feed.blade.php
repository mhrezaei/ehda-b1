<div class="form-feed alert" style="display:none">
    {{ $feed_wait or trans('forms.feed.wait') }}
</div>
<div class="hide">
    <span class=" form-feed-wait">{{  $feed_wait or trans('forms.feed.wait')  }}</span>
    <span class=" form-feed-error">{{ $feed_error or trans('forms.feed.error') }}</span>
    <span class=" form-feed-ok">{{ $feed_ok or trans('forms.feed.done') }}</span>
</div>

