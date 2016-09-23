<div class="row">
    <div class="page-green-title col-xs-12">
        <h3 class="container">
            @if(isset($category))
                {{--@pd($category)--}}
                {{ $category }}
            @endif
        </h3>
    </div>
    <div class="col-xs-12">
        <div class="container">
            <h2 class="text-success">
                @if(isset($parent))
                    {{--@pd($parent)--}}
                    {{ $parent }}
                @endif
            </h2>
            <h3 class="sub-title">
                @if(isset($sub))
                    {{--@pd($sub)--}}
                    {{ $sub }}
                @endif
            </h3>
        </div>
    </div>
</div>