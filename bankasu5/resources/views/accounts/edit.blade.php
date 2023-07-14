@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
            <h5 class="card-header">Edit account balance</h5>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Add or withdraw money from account</h6>
                        <form method="post" action="{{route('accounts-destroy', $account)}}">
                            <div class="justify-content-between">
                                <div class="d-flex mb-3">
                                    <div class="ms-2">
                                        <div class="fw-bold fs-3">{{$account->iban}}</div>
                                        <div>Client</div>
                                        <div class="fw-bold">{{$account->client_id}}</div>
                                        <div>Balance, €</div>
                                        <div class="fw-bold">{{$account->balance}}</div>
                                        <div>
                                            <label for="amount">Enter the amount, €:</label>
                                            <input name="amount" type="number" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success m-1">Add</button>
                            <button type="submit" class="btn btn-danger m-1">Withdraw</button>
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