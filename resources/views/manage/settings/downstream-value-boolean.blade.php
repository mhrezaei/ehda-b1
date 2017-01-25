@include('forms.group-start' , [
    'label' => '' ,
    'fake' => isset($label)? '' : $label = trans('validation.attributes.global_value') ,
    'fake2' => isset($name)? '' : $name = 'global_value',
])

@include('forms.check' , [
    'name' => isset($domain)? $domain->slug : $name,
    'label' => isset($domain)? $domain->title : $label ,
    'class' => isset($domain)? '' : 'form-default',
])

@include('forms.group-end')
