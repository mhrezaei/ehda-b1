@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => $model_data->first()->categories(),
])