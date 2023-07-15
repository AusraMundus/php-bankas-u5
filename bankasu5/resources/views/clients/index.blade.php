@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Clients List</h5>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($clients as $client)
                        <li class="list-group-item">
                            <div class="justify-content-between" style="display: flex; flex-direction: row; align-items: center;">
                                <div class="d-flex">
                                    <div class="ms-2">
                                        <div class="fw-bold fs-3">{{$client->first_name}} {{$client->last_name}}</div>
                                        {{-- <div>Personal ID:</div>
                                        <div class="fw-bold">{{$client->personal_id}}</div> --}}
                                        <div>Total balance:</div>
                                        <div class="fw-bold">{{$client->accounts()->sum('balance')}} €</div>
                                        <div>Total accounts:</div>
                                        <div class="fw-bold">{{$client->accounts()->count()}}</div>
                                    </div>
                                </div>
                                <div>
                                    <a class="btn btn-primary m-1" href="{{route('clients-edit', $client)}}">Edit client data</a>
                                    <a class="btn btn-danger m-1" href="{{route('clients-delete', $client)}}">Delete client</a>
                                </div>
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