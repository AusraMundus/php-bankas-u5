@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
            <h5 class="card-header">Add new account</h5>
                <div class="card-body">
                    <h6 class="card-subtitle mb-3 text-muted">Choose the client from the clients list</h6>
                    <form method="post" action="{{route('accounts-store')}}">

                        <div class="mb-3">
                            <label class="form-label">Clients list</label>
                            <select name="client_id" class="form-select">
                                <option>Click this to select the client</option>
                                @foreach ($clients as $client)
                                <option value="{{$client->id}}" @if($client->id == old('client_id')) selected @endif>{{$client->first_name}} {{$client->last_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Account No</label>
                            <input name="iban" type="text" class="form-control" value="{{old('iban')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Balance, €</label>
                            <input name="balance" type="text" class="form-control" value="{{old('balance')}}">
                        </div>
                        <button type="submit" class="btn btn-primary m-1">Add</button>
                        <a class="btn btn-secondary m-1" href="{{route('accounts-index')}}">Cancel</a>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection