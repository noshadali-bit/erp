<table class="table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Department</th>
        </tr>
    </thead>
    <tbody>
        @foreach($movements as $movement)
        <tr>
            <td>{{ $movement->date }}</td>
            <td>{{ ucfirst($movement->movement_type) }}</td>
            <td>{{ $movement->quantity }}</td>
            <td>{{ $movement->department->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>