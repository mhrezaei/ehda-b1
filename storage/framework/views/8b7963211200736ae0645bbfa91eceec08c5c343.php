<!-- nav bar -->

<nav class="navbar navbar-info navbar-fixed-top" style="direction: rtl; text-align: right; display: block;">
	<div class="container-fluid" style="direction: rtl;">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header" style="float: right;direction: rtl; margin-left: 20px;">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo e(URL::to('/manage/index')); ?>" style="padding-top: 8px;">
				<img src="<?php echo e(URL::to('assets/images/manage/logo.png')); ?>" alt="اهدای عضو، اهدای زندگی">
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse floatLeft" id="bs-example-navbar-collapse-1" style="direction: rtl;">
			<ul class="nav navbar-nav" style="direction: rtl !important;">
				<li class="dropdown" style="font-family: 'IRANSans';">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #086E84;">
						<div class="glyphicon glyphicon-user"></div>
						محمد هادی رضایی
						<span class="caret"></span></a>
					<ul class="dropdown-menu" style="font-size: 13px;">
						<li><a href="<?php echo e(URL::to('/manage/index')); ?>">
								<span class="glyphicon glyphicon-pencil" style="padding-left: 5px;"></span>ویرایش اطلاعات
							</a></li>
						<li><a href="<?php echo e(URL::to('/manage/index')); ?>">
								<span class="glyphicon glyphicon-off" style="padding-left: 5px;"></span>خروج
							</a></li>
					</ul>
				</li>
			</ul>

		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

<!-- nav bar -->
<div style="clear: both;"></div>