<?php foreach($commands as $command): ?>
	<input type="hidden" class="js" data-delay="<?php echo e(isset($command[1]) ? $command[1] : 1); ?>" value="<?php echo e(isset($command[0]) ? $command[0] : ''); ?>">
<?php endforeach; ?>
