<?php if(0): ?>
	<div>
		<div>
			<table>
				<tbody>
				<?php endif; ?>


				<?php if(1): ?>
				</tbody>
			</table>
		</div>
		<div class="grid_count">
			<?php if($model_data->count()): ?>
				<?php echo App\Providers\AppServiceProvider::pd((trans('manage.global.grid_count' , [
					'rows' => $model_data->count() ,
					'total' => $model_data->total()
				]))) ?>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>