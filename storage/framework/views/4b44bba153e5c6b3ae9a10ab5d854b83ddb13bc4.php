<?php if($user): ?>
    <table style="width: 100%; font-family: Tahoma; font-size: 12px; border: 1px solid black; direction: rtl;">
        <thead>
            <th style="border: 1px solid black;">ردیف</th>
            <th style="border: 1px solid black;">مشخصات</th>
            <th style="border: 1px solid black;">اطلاعات تماس</th>
            <th style="border: 1px solid black;">تمایلات</th>
        </thead>
        <tbody>
            <?php foreach($user as $u): ?>
                <tr>
                    <th style="border: 1px solid black;"><?php echo e($u->id + 1); ?></th>
                    <td style="border: 1px solid black;">
                        نام و نام خانوادگی: <?php echo e($u->name_first . ' ' . $u->name_last); ?><hr>
                        نام پدر: <?php echo e($u->name_father); ?><hr>
                        کدملی: <?php echo e($u->code_melli); ?><hr>
                        تاریخ تولد: <?php echo e($u->say('birth_date')); ?>

                    </td>
                    <td style="border: 1px solid black;">
                        آدرس: <?php echo e($u->home_address); ?><hr>
                        شماره تماس: <?php echo e($u->home_tel); ?><hr>
                        موبایل: <?php echo e($u->mobile); ?><hr>
                        استان و شهر: <?php echo e($u->say('home_province') . ' ' . $u->say('home_city')); ?>

                    </td>
                    <td style="border: 1px solid black;">
                        <?php if(is_array($u->say('activities'))): ?>
                            <?php foreach($u->say('activities') as $key => $value): ?>
                                <?php echo e($value); ?>

                                <hr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>