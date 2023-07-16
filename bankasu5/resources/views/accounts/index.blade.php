@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h1 class="card-header">Accounts List</h1>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($accounts as $account)
                        <li class="list-group-item">
                            <div class="justify-content-between" style="display: flex; flex-direction: row; align-items: center;">
                                <div class="d-flex">
                                    <div>
                                        <div class="fw-bold fs-3 mb-2">{{$account->iban}}</div>
                                        <div>Client</div>
                                        <div class="fw-bold">{{$account->client->first_name}} {{$account->client->last_name}}</div>
                                        <div>Balance</div>
                                        <div class="fw-bold">{{$account->balance}} €</div>
                                    </div>
                                </div>
                                <div>
                                    <a class="btn btn-primary m-1" href="{{route('accounts-edit', $account)}}">Edit balance</a>
                                    <a class="btn btn-danger m-1" href="{{route('accounts-delete', $account)}}">Delete account</a>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">
                            <p class="text-center">No accounts</p>
                        </li>
                    @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection