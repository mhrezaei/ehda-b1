<?php /*
|--------------------------------------------------------------------------
| Inserts a dropdown action button
|--------------------------------------------------------------------------
| Parameters: $id AND $actions = ['fa_icon' , 'caption' , 'link or js_command' , optional permit command , optional boolian condition]
*/ ?>

<span class="dropdown">
	<button id="action<?php echo e($id); ?>" class="btn btn-<?php echo e(isset($button_class) ? $button_class : 'default'); ?> btn-<?php echo e(isset($button_size) ? $button_size : 'xs'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php echo e(isset($button_extra) ? $button_extra : ''); ?>>
		<?php echo e(isset($button_label) ? $button_label : trans('forms.button.action')); ?>

	</button>
	<ul class="dropdown-menu" aria-labelledby="action<?php echo e($id); ?>">
		<?php foreach($actions as $action): ?>
			<?php
				//first things first...
				$icon = $action[0] ;
				$caption = $action[1] ;
				$extra = null ;

				//target...
				$action[2] = str_replace('-id-' , $id , $action[2]);
				if(str_contains($action[2],'(')) {
					$js_command = $action[2] ;
					$target = 'javascript:void(0)' ;
				}
				elseif(str_contains($action[2] , 'modal')) {
					$target = 'javascript:void(0)' ;
					$array = explode(':',$action[2]) ;
					if(!isset($array[2])) $array[2] = 'lg' ;
					$js_command = "masterModal('". url($array[1]) ."' , '". $array[2] ."' )" ;
				}
				elseif(str_contains($action[2] , 'url')) {
					$array = explode(':',$action[2]) ;
					$target = url($array[1]) ;
					$js_command = null ;
					if(str_contains($action[2] , 'urlN'))
						$extra .= ' target="_blank" ';
				}
				else {
					$js_command = null ;
					$target = $action[2] ;
				}

				//rest...
				if(isset($action[3]))
					$permit = \Illuminate\Support\Facades\Auth::user()->can($action[3]) ;
				else
					$permit = true ;
				if(isset($action[4]))
					$permit = $action[4] and $permit ;

			?>
			<?php if($permit): ?>
				<li>
					<a href="<?php echo e($target); ?>" onclick="<?php echo e($js_command); ?>" <?php echo e($extra); ?>>
						<i class="fa fa-<?php echo e(isset($icon) ? $icon : 'circle'); ?> fa-fw"></i>
						<?php echo e($caption); ?>

					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</span>
