<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Employee</title>
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
    <div class="container-sm my-5">
        <div class="row justify-content-center">
            <div class="p-5 bg-light rounded-3 col-xl-4 border">
                <div class="mb-3 text-center">
                    <i class="bi-person-circle fs-1"></i>
                    <h4>Detail Employee</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <h5><?php echo e($employee->firstname); ?></h5>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <h5><?php echo e($employee->lastname); ?></h5>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <h5><?php echo e($employee->email); ?></h5>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="age" class="form-label">Age</label>
                        <h5><?php echo e($employee->age); ?></h5>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="age" class="form-label">Position</label>
                        <h5><?php echo e($employee->position->name); ?></h5>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 d-grid">
                        <a href="<?php echo e(route('employees.index')); ?>" class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
</body>
</html>
<?php /**PATH C:\Users\Dell\Downloads\latihan_modul8-auth-master\resources\views/employee/show.blade.php ENDPATH**/ ?>