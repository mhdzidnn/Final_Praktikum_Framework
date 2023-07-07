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
            <div class="col-lg-9 col-xl-6">
                <h4 class="mb-3"><?php echo e($pageTitle); ?></h4>
            </div>
            <div class="col-lg-3 col-xl-6">
                <ul class="list-inline mb-0 float-end">
                    <li class="list-inline-item">
                        <a href="<?php echo e(route('employees.exportExcel')); ?>" class="btn btn-outline-success">
                            <i class="bi bi-download me-1"></i> to Excel
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?php echo e(route('employees.exportPdf')); ?>" class="btn btn-outline-danger">
                            <i class="bi bi-download me-1"></i> to PDF
                        </a>
                    </li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item">
                        <a href="<?php echo e(route('employees.create')); ?>" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Create Employee
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <hr>
        <div class="table-responsive border p-3 rounded-3">
            <table class="table table-bordered table-hover table-striped
            mb-0 bg-white datatable" id="employeeTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Position</th>
                        <th></th>
                    </tr>
                </thead>
                
            </table>
                            

                                
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
    <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        
</body>
</html>
<?php /**PATH C:\Users\Dell\LatihanPraktikum_Module08\resources\views/employee/index.blade.php ENDPATH**/ ?>