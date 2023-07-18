@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h1 class="card-header">Accounts List</h1>
                <div class="card-body">
                    <!-- Filters -->
                    <div class="m-3">
                        <form action="{{route('accounts-index')}}" method="get">
                            <fieldset>
                                <div class="row">
                                    <h4 class="card-title">Filter by balance status</h4>
                                    {{-- <div class="col-3">
                                        <select class="form-select" name="filter_by">
                                            <option value="" @if(''==$filterBy) selected @endif>No filter</option>
                                            <option value="balance" @if('balance'==$filterBy) selected @endif>Balance</option>  
                                        </select>
                                    </div> --}}
                                    <div class="col-3">
                                        <select class="form-select" name="filter_value">
                                            <option value="" @if(''==$filterValue) selected @endif>Select balance status</option>
                                            <option value="positive_balance" @if('positive_balance'==$filterValue) selected @endif>Positive balance</option>
                                            <option value="zero_balance" @if('zero_balance'==$filterValue) selected @endif>Zero balance</option>
                                            <option value="negative_balance" @if('negative_balance'==$filterValue) selected @endif>Negative balance</option>
                                        </select>
                                    </div>
                                </div>                              
                                <div class="row">
                                    <div class="col-4 mt-1">
                                        <button type="submit" class="btn btn-outline-primary">Show</button>
                                        <a class="btn btn-outline-secondary m-1" href="{{route('accounts-index')}}">Clear</a>
                                    </div>
                                </div>

                            </fieldset>
                        </form>
                    </div>

                    <!-- Accounts List -->
                    <ul class="list-group list-group-flush">
                        @forelse($accounts as $account)
                        <li class="list-group-item">
                            <div class="justify-content-between" style="display: flex; flex-direction: row; align-items: center;">
                                <div class="d-flex">
                                    <div>
                                        <div class="fw-bold fs-3 mb-2">{{$account->iban}}</div>
                                        <div>Client: <span class="fw-bold">{{$account->client->first_name}} {{$account->client->last_name}}</span></div>
                                        <div>Balance: <span class="fw-bold">{{$account->balance}} €</span></div>
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
        <div class="col-md-12 mt-4">
            {{$accounts->links()}}
        </div>
    </div>
</div>
@endsection