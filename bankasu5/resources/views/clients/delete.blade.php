@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
            <h2 class="card-header">Confirm client delete</h2>
                <div class="card-body">
                    <h5 class="card-subtitle mb-2 text-muted">Are you sure you want to delete this client?</h5>
                        <form method="post" action="{{route('clients-destroy', $client)}}">
                            <div class="justify-content-between">
                                <div class="d-flex mb-3">
                                    <div class="ms-2">
                                        <div class="fw-bold fs-3">{{$client->first_name}} {{$client->last_name}}</div>
                                        <div>Personal ID</div>
                                        <div class="fw-bold">{{$client->personal_id}}</div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger m-1">Delete</button>
                            <a class="btn btn-secondary m-1" href="{{route('clients-index')}}">Cancel</a>
                            @method('delete')
                            @csrf
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection