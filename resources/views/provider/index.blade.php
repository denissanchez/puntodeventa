@extends('partials.layout')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Proveedores</h6>
                    <div class="table-responsive">
                        <table id="table" class="table">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($providers as $provider)
                                <tr>
                                    <td>{{ $provider->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/custom/provider.index.js') }}"></script>
@endsection
