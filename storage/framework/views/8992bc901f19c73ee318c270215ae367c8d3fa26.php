<?php if(!isset($permission) or Auth::user()->can($permission)): ?>
	<li <?php echo e((Request::is('*'.$link) ? 'class="active"' : '')); ?>>

		<?php /*
		|--------------------------------------------------------------------------
		| Main Manu
		|--------------------------------------------------------------------------
		| 
		*/ ?>

		<?php if(isset($disabled) and $disabled): ?>
			<a href="javascript:void(0)" class="null-content" style="cursor: default;z-index: -1">
				<i class="fa fa-<?php echo e(isset($icon) ? $icon : 'dot-circle-o'); ?> fa-fw" style="width: 20px"></i>
				&nbsp;<?php echo e($caption); ?>&nbsp;
			</a>
		<?php else: ?>
			<a href="<?php echo e(url ('manage/'.$link)); ?>">
				<i class="fa fa-<?php echo e(isset($icon) ? $icon : 'dot-circle-o'); ?> fa-fw"></i>
				&nbsp;<?php echo e($caption); ?>&nbsp;
				<?php if(isset($sub_menus)): ?>
					<span class="fa arrow"></span>
				<?php endif; ?>
			</a>
		<?php endif; ?>

		<?php /*
		|--------------------------------------------------------------------------
		| Sub Menus
		|--------------------------------------------------------------------------
		|
		*/ ?>

		<?php if(isset($sub_menus)): ?>
			<ul class="nav nav-second-level">
				<?php foreach($sub_menus as $sub_menu): ?>  <?php /*  [0:target 1:caption 2:icon 3:permission  */ ?>
					<?php if(!isset($sub_menu[3]) or Auth::user()->can($sub_menu[3])): ?>
						<li <?php echo e((Request::is('*'.$sub_menu[0]) ? 'class="active"' : '')); ?>>
							<a href="<?php echo e(url ("manage/".$sub_menu[0])); ?>">
								<i class="fa fa-<?php echo e(isset($sub_menu[2]) ? $sub_menu[2] : 'dot-circle-o'); ?> fa-fw" style="width: 20px"></i>
								&nbsp;<?php echo e($sub_menu[1]); ?>&nbsp;
							</a>
						</li>
				<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

	</li>
<?php endif; ?>