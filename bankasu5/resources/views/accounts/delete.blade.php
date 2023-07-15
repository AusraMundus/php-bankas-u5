@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
            <h2 class="card-header">Confirm account delete</h2>
                <div class="card-body">
                    <h5 class="card-subtitle mb-2 text-muted">Are you sure you want to delete this account?</h5>
                        <form method="post" action="{{route('accounts-destroy', $account)}}">
                            <div class="justify-content-between">
                                <div class="d-flex mb-3">
                                    <div>
                                        <div class="fw-bold fs-3">{{$account->iban}}</div>
                                        <div>Client</div>
                                        <div class="fw-bold">{{$account->client->first_name}} {{$account->client->last_name}}</div>
                                        <div>Balance, €</div>
                                        <div class="fw-bold">{{$account->balance}}</div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger m-1">Delete</button>
                            <a class="btn btn-secondary m-1" href="{{route('accounts-index')}}">Cancel</a>
                            @method('delete')
                            @csrf
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection