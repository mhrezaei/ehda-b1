<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingqs">
        <h4 class="panel-title">
            <a class="collapsed" style="color: #1F398B;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseqs" aria-expanded="false" aria-controls="collapseqs">
                {{ trans('site.global.new_faq_qs') }}
            </a>
        </h4>
    </div>
    <div id="collapseqs" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingqs">
        <div class="panel-body">
            {!! Form::open([
                'url'	=> '/faq/new' ,
                'method'=> 'post',
                'class' => 'clearfix ehda-card-form js',
                'name' => 'new_faq_qs',
                'id' => 'new_faq_qs',
            ]) !!}

            {!! Form::close() !!}
        </div>
    </div>
</div>