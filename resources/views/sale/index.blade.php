@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Productos</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card m-b-30">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $key=>$sale)
                        <tr>
                            <td>{{ $sale->code }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
