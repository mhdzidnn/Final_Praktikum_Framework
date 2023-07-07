<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
                    <li class="nav-item col-2 col-md-auto"><a href="{{ route('home') }}" class="nav-link active">Home</a></li>
                    <li class="nav-item col-2 col-md-auto"><a href="{{ route('employees.index') }}" class="nav-link">Employee List</a></li>
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
                {{-- <li class="nav-item dropdown"> --}}
                {{-- <a href="{{ route('profile') }}" class="btn btn-outline-light my-2 ms-md-auto"><i class="bi-person-circle me-1"></i> My Profile</a> --}}
                {{-- </li> --}}
            </div>
        </div>
    </nav>

{{-- @extends('layouts.app')

@section('content') --}}
    {{-- @include('default') --}}
    <div class="container mt-4">
        <h4>Home</h4>
        <hr>
        <div class="d-flex align-items-center py-2 px-4 bg-light rounded-3 border">
            <div class="bi-house-fill me-3 fs-1"></div>
            <h4 class="mb-0">Well done! this is Home.</h4>
        </div>
    </div>
{{-- @endsection --}}
    @vite('resources/js/app.js')
</body>
</html
