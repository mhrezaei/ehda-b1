@if(strlen($static_paragraph['fix_background']->title))
<div class="row fixed-background" style="background-image:url({{ url('assets') }}/site/images/image-1.jpg)">
    <h3 class="text-white text-center" style="line-height:3em;font-size:450%;height:3em; direction: rtl;">@pd($static_paragraph['fix_background']->title)</h3>
</div>
@endif