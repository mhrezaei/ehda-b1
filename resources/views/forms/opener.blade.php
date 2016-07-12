<div class="tForms">
    {!! Form::open([
        'id' => isset($id) ? $id : 'frm'.rand(1,5000) ,
        'url' => isset($url)? url($url) : '#' ,
        'method' => isset($method)? $method : 'post' ,
        'files' => isset($files)? $files : 'false' ,
        'class' => isset($class)? "form-horizontal $class" : 'form-horizontal ' ,
    ]) !!}

    @if(isset($title))
        <div class="title">
            {{$title}}...
        </div>
    @endif

    @if(0) {{-- just to avoid annying 'div-not-closed' error! --}}
        </div>
    @endif
