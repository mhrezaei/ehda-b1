<?php /* $tabs = [ 0:url 1:caption 2:permit 3:badge 4:badge-color ] */ ?>
<ul class="nav nav-tabs">
	<?php foreach($tabs as $tab): ?>
		<?php
			$url = $tab[0] ;
			$caption = $tab[1] ? $tab[1] : trans('manage/'.$page[0][0].".$tab.trans") ;
			$permit = isset($tab[2]) ? $tab[2] : 'any' ;
			if($url==$current)
				$active = true ;
			else
				$active = false ;
		?>
		<?php if(Auth::user()->can($permit)): ?>
			<li class="<?php echo e($active ? 'active' : ''); ?>">
				<a href="<?php echo e(url("manage/".$page[0][0]."/".$url)); ?>">
					<?php echo e($caption); ?>

					<?php if(isset($tab[3]) and $tab[3]>0): ?>
						<span class="label label-<?php echo e(isset($tab[4]) ? $tab[4] : 'warning'); ?> p5">
							<?php echo App\Providers\AppServiceProvider::pd(($tab[3])) ?>
						</span>
					<?php endif; ?>
				</a>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
