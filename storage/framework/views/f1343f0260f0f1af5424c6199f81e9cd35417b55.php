<ul class="nav nav-tabs">
	<?php foreach($tabs as $tab): ?>
		<li role="setting" class="<?php echo e($tab == $page[1][0] ? 'active' : ''); ?>">
			<a href="<?php echo e(url ($tab == $page[1][0] ? '#' : "manage/".$page[0][0]."/$tab" )); ?>"><?php echo e(trans("manage.".$page[0][0].".$tab.trans")); ?></a>
		</li>
	<?php endforeach; ?>
</ul>