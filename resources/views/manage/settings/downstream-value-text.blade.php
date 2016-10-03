@include('forms.input' , [
    'name' => isset($domain)? $domain->slug : 'global_value',
    'label' => isset($domain)? $domain->title : trans('validation.attributes.global_value'),
    'value' => isset($domain)? $model->value($domain->slug) : $model->global_value,
    'class' => isset($domain)? '' : 'form-default' ,
])
