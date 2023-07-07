<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Position</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($employee->firstname); ?></td>
                <td><?php echo e($employee->lastname); ?></td>
                <td><?php echo e($employee->email); ?></td>
                <td><?php echo e($employee->age); ?></td>
                <td><?php echo e($employee->position->name); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH C:\Users\Dell\LatihanPraktikum_Module08\resources\views/employee/export_excel.blade.php ENDPATH**/ ?>