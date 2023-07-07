<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/sass/app.scss'); ?>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container">
            <a href="<?php echo e(route('home')); ?>" class="navbar-brand mb-0 h1"><i class="bi-hexagon-fill me-2"></i> Data Master</a>

            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <hr class="d-lg-none text-white-50">

                <ul class="navbar-nav flex-row flex-wrap">
                    <li class="nav-item col-6 col-md-auto"><a href="<?php echo e(route('home')); ?>" class="nav-link">Home</a></li>
                    <li class="nav-item col-6 col-md-auto"><a href="<?php echo e(route('employees.index')); ?>" class="nav-link">Employee List</a></li>
                </ul>

                
                <div style="margin-left: 600px;" class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill"></i>
                        <?php echo e(Auth::user()->name); ?>

                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="<?php echo e(route('profile')); ?>"><i class="bi-person-circle me-1"></i>Profile</a></li>
                      <li><a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="bi bi-lock-fill"></i>
                                        <?php echo e(__('Logout')); ?></a></li>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </ul>
                  </div>
                
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row mb-0">
            <div class="col-lg-9 col-xl-10">
                <h4 class="mb-3">Employee</h4>
            </div>
            <div class="col-lg-3 col-xl-2">
                <div class="d-grid gap-2">
                    <a href="<?php echo e(route('employees.create')); ?>" class="btn btn-primary">Create Employee</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="table-responsive border p-3 rounded-3">
            <table class="table table-bordered table-hover table-striped mb-0 bg-white">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Position</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($employee->firstname); ?></td>
                            <td><?php echo e($employee->lastname); ?></td>
                            <td><?php echo e($employee->email); ?></td>
                            <td><?php echo e($employee->age); ?></td>
                            <td><?php echo e($employee->position->name); ?></td>
                            <td>
                                <div class="d-flex">
                                    <a href="<?php echo e(route('employees.show', ['employee' => $employee->id])); ?>" class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
                                    <a href="<?php echo e(route('employees.edit', ['employee' => $employee->id])); ?>" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>

                                    <div>
                                        <form action="<?php echo e(route('employees.destroy', ['employee' => $employee->id])); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('delete'); ?>
                                            <button type="submit" class="btn btn-outline-dark btn-sm me-2"><i class="bi-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
                            

                                
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
</body>
</html>
<?php /**PATH C:\Users\Dell\Downloads\latihan_modul8-auth-master\resources\views/employee/index.blade.php ENDPATH**/ ?>