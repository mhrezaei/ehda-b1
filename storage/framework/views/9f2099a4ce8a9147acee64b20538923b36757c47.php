<div class="form-group text-center">
    <label class="col-12 control-label">
        <span id="organCheck"><?php echo e(trans('site.global.organ_detail_line1')); ?></span>
        <span class="text-danger" style="display: none;">*</span>
    </label>
</div>
<div class="form-group text-center">
    <div class="col-12 body-items">
        <p>
            <input type="checkbox" id="chRegisterAll" name="chRegisterAll" error-value="<?php echo e(trans('validation.javascript_validation.organs')); ?>"
                   <?php if(Auth::check() and strpos(Auth::user()->organs, 'Heart Lung Liver Kidney Pancreas Tissues') !== false): ?>
                   checked="checked"
                    <?php endif; ?>
            >
            <label for="chRegisterAll" class="form-control-label">
                <?php echo e(trans('people.organs.all')); ?>

            </label>
        </p>
        <input type="checkbox" id="chRegisterHeart" name="chRegisterHeart"
               <?php if(Auth::check() and strpos(Auth::user()->organs, 'Heart') !== false): ?>
               checked="checked"
                <?php endif; ?>
        >
        <label for="chRegisterHeart" class="form-control-label">
            <?php echo e(trans('people.organs.heart')); ?>

        </label>
        <input type="checkbox" id="chRegisterLung" name="chRegisterLung"
               <?php if(Auth::check() and strpos(Auth::user()->organs, 'Lung') !== false): ?>
               checked="checked"
                <?php endif; ?>
        >
        <label for="chRegisterLung" class="form-control-label">
            <?php echo e(trans('people.organs.lung')); ?>

        </label>
        <input type="checkbox" id="chRegisterLiver" name="chRegisterLiver"
               <?php if(Auth::check() and strpos(Auth::user()->organs, 'Liver') !== false): ?>
               checked="checked"
                <?php endif; ?>
        >
        <label for="chRegisterLiver" class="form-control-label">
            <?php echo e(trans('people.organs.liver')); ?>

        </label>
        <input type="checkbox" id="chRegisterKidney" name="chRegisterKidney"
               <?php if(Auth::check() and strpos(Auth::user()->organs, 'Kidney') !== false): ?>
               checked="checked"
                <?php endif; ?>
        >
        <label for="chRegisterKidney" class="form-control-label">
            <?php echo e(trans('people.organs.kidney')); ?>

        </label>
        <input type="checkbox" id="chRegisterPancreas" name="chRegisterPancreas"
               <?php if(Auth::check() and strpos(Auth::user()->organs, 'Pancreas') !== false): ?>
               checked="checked"
                <?php endif; ?>
        >
        <label for="chRegisterPancreas" class="form-control-label">
            <?php echo e(trans('people.organs.pancreas')); ?>

        </label>
        <input type="checkbox" id="chRegisterTissues" name="chRegisterTissues"
               <?php if(Auth::check() and strpos(Auth::user()->organs, 'Tissues') !== false): ?>
               checked="checked"
                <?php endif; ?>
        >
        <label for="chRegisterTissues" class="form-control-label">
            <?php echo e(trans('people.organs.tissues')); ?>

        </label>
    </div>
</div>
<div class="form-group text-center">
    <p>
        <?php echo e(trans('site.global.organ_detail_line2')); ?><br>
        <?php echo e(trans('site.global.organ_detail_line3')); ?>

    </p>
</div>