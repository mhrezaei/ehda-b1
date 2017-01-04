<div class="tForms">
    <?php echo Form::open([
        'id' => isset($id) ? $id : 'frm'.rand(1,5000) ,
        'url' => isset($url)? url($url) : '#' ,
        'method' => isset($method)? $method : 'post' ,
        'files' => isset($files)? $files : 'false' ,
        'class' => isset($class)? "form-horizontal $class" : 'form-horizontal ' ,
        'no-validation' => isset($no_validation)? $no_validation : '0' ,
        'no-ajax' => isset($no_ajax)? $no_ajax : '0' ,
    ]); ?>


    <?php if(isset($title)): ?>
        <div class="title">
            <?php echo e($title); ?>...
        </div>
    <?php endif; ?>

    <?php if(0): ?> <?php /* just to avoid annying 'div-not-closed' error! */ ?>
        </div>
    <?php endif; ?>
