@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Confirm client delete</h5>
                    <form method="post" action="{{route('clients-destroy', $client)}}">
                        <div class="justify-content-between">
                            <div>
                                <div class="d-flex">
                                    <div class="ms-2">
                                        <div>{{$client->first_name}}</div>
                                        <div>{{$client->last_name}}</div>
                                        <div>{{$client->personal_id}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a href="{{route('clients-index')}}" class="btn btn-secondary">Cancel</a>
                        @method('delete')
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection