@extends('templates.manage.manage')

@section('content')
<!-- Page Content -->
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title" style="font-family: 'IRANSans';">صفحه نخست</h3>
			</div> <div class="panel-body" style="font-family: 'IRANSans';">
				<div class="col-lg-12">
					متن

					<br>
					<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<div style="clear:both;"></div>
<!--three section end-->


<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
@endsection