@if (Session::has('alert'))
    <div class="alert alert-info">
        <p>{{ Session::get('alert') }}</p>
    </div>
@endif
