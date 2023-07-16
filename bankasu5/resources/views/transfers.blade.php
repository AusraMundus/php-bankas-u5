@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="card-header">Transfers between accounts</h2>
                <div class="card-body">
                    <h5 class="card-subtitle mb-3 text-muted">Select accounts for money transfer:</h5>
                    <form method="" action="">
                    {{-- <form method="post" action="{{route('tranfers-update')}}"> --}}
                        <div class="mb-3">
                            <label class="form-label">Account you want to transfer FROM</label>
                            <select name="client_id" class="form-select">
                                <option>Click this to select the account</option>
                                    @foreach ($accounts as $account)
                                    <option value="{{$account->id}}" @if($account->id == old('account_id')) selected @endif>
                                        {{$account->iban}}, {{$account->client->first_name}} {{$account->client->last_name}}, Balance: {{$account->balance}} €</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Account you want to transfer TO</label>
                            <select name="client_id" class="form-select">
                                <option>Click this to select the account</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{$account->id}}" @if($account->id == old('account_id')) selected @endif>
                                        {{$account->iban}}, {{$account->client->first_name}} {{$account->client->last_name}}, Balance: {{$account->balance}} €</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount">Enter the amount, €</label>
                            <input name="amount" type="0" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success m-1">Transfer</button>
                        <a class="btn btn-secondary m-1" href="{{route('accounts-index')}}">Cancel</a>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection