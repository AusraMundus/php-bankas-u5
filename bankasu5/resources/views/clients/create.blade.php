@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
            <h5 class="card-header">Add new client</h5>
                <div class="card-body">
                    <h6 class="card-subtitle mb-3 text-muted">Enter first name, last name and personal ID</h6>
                    <form method="post" action="{{route('clients-store')}}">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input name="first_name" type="text" class="form-control" value="{{old('first_name')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input name="last_name" type="text" class="form-control" value="{{old('last_name')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Personal ID</label>
                            <input name="personal_id" type="text" class="form-control" value="{{old('personal_id')}}">
                        </div>
                        <button type="submit" class="btn btn-primary m-1">Add</button>
                        <a class="btn btn-secondary m-1" href="{{route('clients-index')}}">Cancel</a>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection