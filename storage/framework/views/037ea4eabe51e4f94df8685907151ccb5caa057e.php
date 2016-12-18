<div class="panel panel-default m20">
	<div class="panel-body">
		<table class="table <?php echo e(isset($table_class) ? $table_class : 'table-hover'); ?>">
			<thead>
			<tr>
				<?php if(isset($selector) and $selector): ?>
					<td>
						<input type="checkbox" id="gridSelector-all" onchange="gridSelector('all')">
					</td>
				<?php endif; ?>
				<?php foreach($headings as $heading): ?>
					<?php if($heading != 'NO'): ?>
						<td><?php echo e($heading); ?></td>
					<?php endif; ?>
				<?php endforeach; ?>
			</tr>
			</thead>
			<tbody>



			<?php if(0): ?>
			</tbody>
		</table>
	</div>
</div>
<?php endif; ?>