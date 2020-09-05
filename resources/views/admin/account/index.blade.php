<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($accounts as $account)
        <tr>
            <td>{{ $account->name }}</td>
            <td>{{ $account->is_active }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
