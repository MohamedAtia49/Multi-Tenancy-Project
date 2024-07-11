@extends('layouts.app')

@section('content')

    <div class="container">


        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-bg-dark">Create Tenant</h1>
            </div><!-- card-header -->
            <div class="card-body text-center">
                <form action="{{ route('tenant.store') }}" method="post" >
                    @csrf
                    <h3 class="text-primary">Site Name</h3>
                    <input type="text" name="name" class="form-control mb-3">
                    <h3 class="text-primary">Domain</h3>
                    <input type="text" name="domain" class="form-control mb-3">
                    <button type="submit" class="btn btn-primary btn-outline-warning">Create</button>
                </form>
            </div>
        </div><!-- card -->
    </div>


@endsection
