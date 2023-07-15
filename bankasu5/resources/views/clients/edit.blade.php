@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h2 class="card-header">Edit client details</h2>
                <div class="card-body">
                <h5 class="card-subtitle mb-2 text-muted">Edit first name and/or last name:</h5>
                    <form method="post" action="{{route('clients-update', $client)}}">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input name="first_name" type="text" class="form-control" value="{{old('first_name', $client->first_name)}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input name="last_name" type="text" class="form-control" value="{{old('last_name', $client->last_name)}}">
                        </div>
                        <button type="submit" class="btn btn-success m-1">Save</button>
                        <a class="btn btn-secondary m-1" href="{{route('clients-index')}}">Cancel</a>
                        @method('put')
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection