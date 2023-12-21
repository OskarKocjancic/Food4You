@extends('layout-login')
@section('header-title', 'Registration')
@section('title', 'Registration page')
@section('content')


    <div class="mt-5">
        @if ($errors->any())
            <div class="col-12">
                @foreach ($errors->all() as $err)
                    <div class="alert alert-danger">{{ $err }}</div>
                @endforeach
            </div>
        @endif
    </div>

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-sm-auto">
                <form action="{{ route('registration.post') }}" method="POST" class="m-sm-auto" style="width: 100%;">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
            
                    <button type="submit" class="btn btn-primary" style="background-color: #0F4C5F; border-color:#0F4C5F">Submit</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection
