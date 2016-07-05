<div class="tForms">
    {!! Form::open([
        'url' => isset($url)? url($url) : '#' ,
        'method' => isset($method)? $method : 'post' ,
        'files' => isset($files)? $files : 'false' ,
        'class' => isset($class) ? $class : 'form-horizontal'
    ]) !!}

    @if(isset($title))
        <div class="title">
            {{$title}}...
        </div>
    @endif

    @if(0) {{-- just to avoid annying 'div-not-closed' error! --}}
        </div>
    @endif
