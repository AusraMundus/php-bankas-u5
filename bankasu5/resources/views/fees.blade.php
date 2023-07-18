@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card">
                <h2 class="card-header">Bank Statistics</h2>
                <div class="card-body">
                    <ul class="list-group list-group-flush m-1">
                        <li class="list-group-item">
                            <div>Total clients:</div>
                            <div class="fw-bold">{{$clients->count()}}</div>
                        </li>
                        <li class="list-group-item">
                            <div>Total accounts:</div>
                            <div class="fw-bold">{{$accounts->count()}}</div>
                        </li>
                        <li class="list-group-item">
                            <div>Total balance:</div>
                            <div class="fw-bold">{{$accounts->sum('balance')}} €</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <h2 class="card-header">Monthly Service Fee</h2>
                <div class="card-body">
                    <p class="card-subtitle mb-3 text-muted">The monthly maintenance/service fee charged on the 15th of each month. This fee does not apply to clients who do not have accounts.</p>
                    <form action="{{route('clients-charge')}}" method='get'>
                        <div class="d-flex justify-content-center">
                            <button  class="btn btn-warning pl-3 pr-3" type="submit">Charge</button>
                        </div>
                    </form>
                    @csrf
                </div>
            </div>
        </div>
    </div>
</div>
@endsection