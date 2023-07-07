<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    @vite('resources/sass/app.scss')
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand mb-0 h1"><i class="bi-hexagon-fill me-2"></i> Data Master</a>

            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <hr class="d-lg-none text-white-50">

                <ul class="navbar-nav flex-row flex-wrap">
                    <li class="nav-item col-6 col-md-auto"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item col-6 col-md-auto"><a href="{{ route('employees.index') }}" class="nav-link">Employee List</a></li>
                </ul>

                {{-- <hr class="d-lg-none text-white-50"> --}}
                <div style="margin-left: 600px;" class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill"></i>
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi-person-circle me-1"></i>Profile</a></li>
                      <li><a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="bi bi-lock-fill"></i>
                                        {{ __('Logout') }}</a></li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                  </div>
                {{-- <a href="{{ route('profile') }}" class="btn btn-outline-light my-2 ms-md-auto"><i class="bi-person-circle me-1"></i> My Profile</a> --}}
            </div>
        </div>
    </nav>
    <div class="container mt-4">

        <div class="row mb-0">
            <div class="col-lg-9 col-xl-6">
                <h4 class="mb-3">{{ $pageTitle }}</h4>
            </div>
            <div class="col-lg-3 col-xl-6">
                <ul class="list-inline mb-0 float-end">
                    <li class="list-inline-item">
                        <a href="{{ route('employees.exportExcel') }}" class="btn btn-outline-success">
                            <i class="bi bi-download me-1"></i> to Excel
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('employees.exportPdf') }}" class="btn btn-outline-danger">
                            <i class="bi bi-download me-1"></i> to PDF
                        </a>
                    </li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item">
                        <a href="{{ route('employees.create') }}" class="btn btn-primary">
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
                {{-- <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->firstname }}</td>
                            <td>{{ $employee->lastname }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->age }}</td>
                            <td>{{ $employee->position->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('employees.show', ['employee' => $employee->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
                                    <a href="{{ route('employees.edit', ['employee' => $employee->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>

                                    <div>
                                        <form action="{{ route('employees.destroy', ['employee' => $employee->id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-dark btn-sm me-2"><i class="bi-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody> --}}
            </table>
                            {{-- <div class="d-flex">
                                <a href="{{ route('employees.show', ['employee' => 3]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
                                <a href="{{ route('employees.edit', ['employee' => 3]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a> --}}

                                {{-- <div>
                                    <form action="{{ route('employees.destroy', ['employee' => 3]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-dark btn-sm me-2"><i class="bi-trash"></i></button>
                                    </form>
                                </div> --}}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @vite('resources/js/app.js')
    @include('sweetalert::alert')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        {{-- <script type="module">
            $(document).ready(function()
            {
                $('#employeeTable').DataTable({
                    serverSide: true,
                    processing: true,
                    ajax: "/getEmployees",
                    columns:
                    [
                        { data: "id", name: "id", visible: false },
                        { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                        { data: "firstname", name: "firstname" },
                        { data: "lastname", name: "lastname" },
                        { data: "email", name: "email" },
                        { data: "age", name: "age" },
                        { data: "position.name", name: "position.name" },
                        { data: "actions", name: "actions", orderable: false,searchable: false }
                    ],
                    order: [[0, "desc"]],
                    lengthMenu:
                    [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"],
                    ],
                });
                $(".datatable").on("click", ".btn-delete", function (e)
                {
                    e.preventDefault();

                    var form = $(this).closest("form");
                    var name = $(this).data("name");

                    Swal.fire({
                        title: "Are you sure want to delete\n" + name + "?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "bg-primary",
                        confirmButtonText: "Yes, delete it!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                 });
            });
        </script> --}}
</body>
</html>
