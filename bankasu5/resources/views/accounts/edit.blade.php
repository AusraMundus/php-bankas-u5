@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
            <h2 class="card-header">Edit account balance</h2>
                <div class="card-body">
                    <h5 class="card-subtitle mb-2 text-muted">Add or withdraw money from account:</h5>
                        <form method="post" action="{{route('accounts-update', $account)}}">
                            <div class="justify-content-between">
                                <div class="d-flex mb-3">
                                    <div>
                                        <div class="fw-bold fs-4">{{$account->iban}}</div>
                                        <div>Client</div>
                                        <div class="fw-bold">{{$account->client->first_name}} {{$account->client->last_name}}</div>
                                        <div>Balance, €</div>
                                        <div class="fw-bold">{{$account->balance}}</div>
                                        <div class="mt-3">
                                            <label for="amount">Enter the amount, €</label>
                                            <input name="amount" type="0" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success m-1" name="add" value=1>Add</button>
                            <button type="submit" class="btn btn-warning m-1" name="withdraw" value=1>Withdraw</button>
                            <a class="btn btn-secondary m-1" href="{{route('accounts-index')}}">Cancel</a>
                            @method('put')
                            @csrf
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection