@extends('partials.layout')

@php
    $now = date('Y-m-d');
@endphp

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Registrar compra</h6>
                    <create-purchase></create-purchase>
                </div>
            </div>
        </div>
    </div>
@endsection
