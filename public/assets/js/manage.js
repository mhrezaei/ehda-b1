/**
 * Created by jafar on 7/6/2016 AD.
 */
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
	alert($id) ;
}