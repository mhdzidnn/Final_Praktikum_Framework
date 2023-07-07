<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
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
    <div class="container-sm mt-5">
        <form action="{{ route('employees.update', ['employee' => $employee->id]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row justify-content-center">
                <div class="p-5 bg-light rounded-3 col-xl-6">
                    <div class="mb-3 text-center">
                        <i class="bi-person-circle fs-1"></i>
                        <h4>Edit Employee</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input class="form-control @error('firstName') is-invalid @enderror" type="text" name="firstName" id="firstName" value="{{ $errors->any() ? old('firstName') : $employee->firstname }}" placeholder="Enter First Name">
                            @error('firstName')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input class="form-control @error('lastName') is-invalid @enderror" type="text" name="lastName" id="lastName" value="{{ $errors->any() ? old('lastName') : $employee->lastname }}" placeholder="Enter Last Name">
                            @error('lastName')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{ $errors->any() ? old('email') : $employee->email }}" placeholder="Enter Email">
                            @error('email')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input class="form-control @error('age') is-invalid @enderror" type="text" name="age" id="age" value="{{ $errors->any() ? old('age') : $employee->age }}" placeholder="Enter Age">
                            @error('age')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="position" class="form-label">Position</label>
                            <select name="position" id="position" class="form-select">
                                @php
                                    $selected = "";
                                    if ($errors->any())
                                        $selected = old('position');
                                    else
                                        $selected = $employee->position_id;
                                @endphp
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}" {{ $selected == $position->id ? 'selected' : '' }}>{{ $position->code.' - '.$position->name }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="age" class="form-label">Curriculum Vitae (CV)</label>
                            @if ($employee->original_filename)
                                <h5>{{ $employee->original_filename }}</h5>
                                <a href="{{ route('employees.downloadFile', ['employeeId' => $employee->id]) }}" class="btn btn-primary btn-sm mt-2">
                                    <i class="bi bi-download me-1"></i> Download CV
                                </a>
                            @else
                                <h5>Tidak ada</h5>
                            @endif
                        </div>

                        <div class="col-md-12 mb-3">
                            <input type="file" class="form-control" name="cv" id="cv">
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('employees.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i> Cancel</a>
                        </div>
                        <div class="col-md-6 d-grid">
                            <button type="submit" class="btn btn-dark btn-lg mt-3"><i class="bi-check-circle me-2"></i> Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @vite('resources/js/app.js')
</body>
</html>
