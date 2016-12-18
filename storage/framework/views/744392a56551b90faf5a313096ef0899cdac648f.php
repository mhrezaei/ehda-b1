<a class="navbar-brand" href="<?php echo e(url ('manage')); ?>">
	<?php echo e(trans('manage.global.page_title')); ?>

</a>

<?php $trans = $link = 'manage'; ?>

<?php foreach($page as $i => $p): ?>
	<?php
	$trans .= ".$p[0]";
	$link .= "/$p[0]";
	?>

	<span class="navbar-brand">/</span>
	<a class="navbar-brand navbar-brand-sub" href="<?php echo e(isset($p[2])? $p[2] : url($link)); ?>">
		<?php /*<?php if($i==0): ?>*/ ?>
			<?php /*<?php echo e(trans("manage.modules.$p[0]")); ?>*/ ?>
		<?php if(isset($p[1])): ?>
			<?php echo e($p[1]); ?>

		<?php else: ?>
			<?php echo e(trans("$trans.trans")); ?>

		<?php endif; ?>
	</a>
<?php endforeach; ?>
