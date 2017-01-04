<li id="<?php echo e(isset($id) ? $id : ''); ?>" class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:<?php echo e(isset($color) ? $color : ''); ?>">
		<?php if(isset($counter) and $counter>0): ?>
			<span class="counter">
				<?php echo App\Providers\AppServiceProvider::pd(($counter)) ?>
			</span>
		<?php endif; ?>
		<i class="fa fa-<?php echo e(isset($icon) ? $icon : 'navicon'); ?> fa-fw"></i>
		<span class="topbar <?php echo e(isset($text_class) ? $text_class : ''); ?>">
			<?php if(isset($text)): ?>
				<span class="mh5"><?php echo e($text); ?></span>
			<?php endif; ?>
		</span>
		<i class="fa fa-caret-down"></i>
	</a>
	<ul class="dropdown-menu">

		<?php foreach($items as $key => $item): ?>
			<?php if($key === 'total'): ?>
			<?php else: ?>
				<?php if($item[0] == '-' ): ?>
					<li class="divider"></li>
				<?php elseif(isset($item[3]) and !$item[3]): ?>
				<?php else: ?>
					<?php echo $__env->make('manage.frame.use.navbar-dropdown-link' , [
						'target' => url($item[0]),
						'caption'=> $item[1],
						'icon' => $item[2]
					], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</li>

