@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h1 class="card-header">Bank Statistics</h1>
                <div class="card-body">
                    <ul class="list-group list-group-flush m-1">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
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
                        <li class="list-group-item">
                            <div>Maximum balance in a single account:</div>
                            <div class="fw-bold">{{$accounts->max('balance')}} €</div>
                        </li>
                        <li class="list-group-item">
                            <div>Average balance in accounts:</div>
                            <div class="fw-bold">{{round($accounts->avg('balance'))}} €</div>
                        </li>
                        <li class="list-group-item">
                            <div>Zero balance accounts:</div>
                            <div class="fw-bold">{{$accounts->where('balance', 0)->count()}}</div>
                        </li>
                        <li class="list-group-item">
                            <div>Negative balance accounts:</div>
                            <div class="fw-bold">{{$accounts->where('balance','<', 0)->count()}}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection