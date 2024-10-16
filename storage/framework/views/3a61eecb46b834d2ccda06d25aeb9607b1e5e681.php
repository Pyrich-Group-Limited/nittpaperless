<div class="container">
    <h4>Select Users to Add as Employees</h4>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('users.assign')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="users[]" value="<?php echo e($user->id); ?>">
                        </td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Make Employees</button>
    </form>
</div>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/employee/create.blade.php ENDPATH**/ ?>