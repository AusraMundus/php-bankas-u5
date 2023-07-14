@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit client details</h5>
                    <form method="post" action="{{route('clients-update', $client)}}">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input name="first_name" type="text" class="form-control" value="{{old('first_name', $client->first_name)}}">
                            <label class="form-label">Last Name</label>
                            <input name="last_name" type="text" class="form-control" value="{{old('last_name', $client->last_name)}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{route('clients-index')}}" class="btn btn-secondary">Cancel</a>
                        @method('put')
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection