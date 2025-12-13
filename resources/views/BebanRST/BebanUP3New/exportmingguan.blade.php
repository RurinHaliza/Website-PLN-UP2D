<h3 style="text-align:center;">Laporan Beban Mingguan</h3>
<p>
    Feeder: <strong>{{ $feeder }}</strong><br>
    Name: <strong>{{ $name }}</strong><br>
    Periode: <strong>{{ $tanggalMulai }} s/d {{ $tanggalAkhir }}</strong>
</p>

<table>
    <thead>
        <tr>
            <th>Up3</th>
            <th>Gardu Induk</th>
            <th>Feeder</th>
            <th>Name</th>
            @for($i = 0; $i < 24; $i++)
                @for($j = 0; $j < 60; $j += 15)
                    @if(!($i == 0 && $j == 0))
                        <th>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}</th>
                    @endif
                    @if($i == 23 && $j == 45)
                        <th>23:59</th>
                    @endif
                @endfor
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $row->up3 }}</td>
                <td>{{ $row->gardu_induk }}</td>
                <td>{{ $row->feeder }}</td>
                <td>{{ $row->name }}</td>
                @for($i = 0; $i < 24; $i++)
                    @for($j = 0; $j < 60; $j += 15)
                        @if(!($i == 0 && $j == 0))
                            @php
                                $field = str_pad($i, 2, '0', STR_PAD_LEFT) . '_' . str_pad($j, 2, '0', STR_PAD_LEFT);
                            @endphp
                            <td>{{ number_format($row->$field ?? 0, 2, ',', '.') }}</td>
                        @endif
                        @if($i == 23 && $j == 45)
                            <td>{{ number_format($row->{'23_59'} ?? 0, 2, ',', '.') }}</td>
                        @endif
                    @endfor
                @endfor
            </tr>
        @endforeach
    </tbody>
</table>
