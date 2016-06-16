<div class="form-feed alert" style="display:none">
    {{ $feedWait or trans('forms.feed-wait') }}
</div>
<div class="hide">
    <span class=" form-feed-wait">{{  $feedWait or trans('forms.feed-wait')  }}</span>
    <span class=" form-feed-error">{{ $feedError or trans('forms.feed-error') }}</span>
    <span class=" form-feed-ok">{{ $feedOk or trans('forms.feed-done') }}</span>
</div>

