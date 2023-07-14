@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Clients List</h5>
                    <ul class="list-group list-group-flush">
                        
                        @forelse($clients as $client)
                        <li class="list-group-item">
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
                            <div>
                                <a class="btn btn-primary" href="{{route('clients-edit', $client)}}">
                                    Edit
                                </a>
                                <a class="btn btn-danger" href="{{route('clients-delete', $client)}}">
                                    Delete    
                                </a>
                            </div>
                        </li>

                        @empty
                        <li class="list-group-item">
                            <p class="text-center">No clients</p>
                        </li>

                        @endforelse

                    </ul>
  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection