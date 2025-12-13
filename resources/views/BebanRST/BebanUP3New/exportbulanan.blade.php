<table>
    <thead>
        <tr>
            <th>UP3</th>
            <th>Gardu Induk</th>
            <th>Feeder</th>
            <th>Name</th>
            <th>Periode</th>
            @foreach ($timeColumns as $col)
                <th>{{ str_replace('_', ':', $col) }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->up3 }}</td>
                <td>{{ $row->gardu_induk }}</td>
                <td>{{ $row->feeder }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $periode }}</td>
                @foreach ($timeColumns as $col)
                    <td>{{ number_format($row->$col, 2, ',', '.') }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
