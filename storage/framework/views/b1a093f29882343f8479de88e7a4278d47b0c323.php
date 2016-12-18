<?php $__env->startSection('body'); ?>
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<?php echo $__env->yieldContent('navbar-brand'); ?>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-left">
                <?php echo $__env->yieldContent('navbar-menus'); ?>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php echo $__env->yieldContent('sidebar'); ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			 <div class="row">
                <div class="col-lg-12">
                    <?php /*<h1 class="page-header"><?php echo $__env->yieldContent('page_heading'); ?></h1>*/ ?>
                    <h1></h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">
				<?php echo $__env->yieldContent('section'); ?>
			</div>
					<!-- /#page-wrapper -->
			<?php echo $__env->yieldContent('modal'); ?>
		</div>
 </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('manage.frame.layouts.plane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>