/**
 * Created by jafar on 7/6/2016 AD.
 */
function modalForm($modal_id , $item_id)
{
	//Preparetions...
	var $modal_selector = '#' + $modal_id ;
	var $form_selector = $modal_selector + ' form ' ;
	var $url = $($form_selector+'._0').html().replace('-id-',$item_id);

	//Form Placement...
	if($item_id=='0')
		$($modal_selector + '-title').html($($form_selector+'._1').html());
	else
		$($modal_selector + '-title').html($($form_selector+'._2').html());

	//Form Load...
	$($form_selector + 'div.modal-body').html('....').load($url);
	$($modal_selector).modal() ;

}
function domainEditor($id)
{
	//Preparetions...
	var $modal_id = 'modalDomainEditor' ;
	var $form_selector = '#' + $modal_id + ' form ' ;

	//Form Placement...
	forms_reset($form_selector , 'title');
	$($form_selector + '[name=id] ').val($id) ;
	if($id!='0') {
		$('#'+$modal_id+ '-title').html($($form_selector+'._2').html());

		var $title = $('#domain-'+$id+'-title').attr('data-toggle');
		var $slug = $('#domain-'+$id+'-slug').attr('data-toggle');

		$($form_selector + '[name=title] ').val($title) ;
		$($form_selector + '[name=slug] ').val($slug) ;
	}
	else {
		$('#'+$modal_id+ '-title').html($($form_selector+'._1').html());

		$($form_selector + '[name=title] ').val('') ;
		$($form_selector + '[name=slug] ').val('') ;
	}

	$('#modalDomainEditor').modal() ;
}

function domainCities($id)
{
	var $modal_id = "modalDomainCities" ;
	var $form_selector = '#' + $modal_id + ' form ' ;

	//Form Placement...
	forms_reset($form_selector , 'cities');
	$($form_selector + '[name=id] ').val($id) ;

	$('#'+$modal_id+ '-title').html($($form_selector+'._1').html()+'  '+$('#domain-'+$id+'-title').attr('data-toggle'));

	$('#'+$modal_id).modal() ;
	$($form_selector + '[name=cities] ');

	//@TODO: Make a state selector from an array or something! 

}

