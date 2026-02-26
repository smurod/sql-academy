@if($result['status'] === 'ok')
    <h3>✅ Успешно</h3>

    @if(isset($result['rows']))
        <table border="1">
            <tr>
                @foreach(array_keys((array)$result['rows'][0] ?? []) as $col)
                    <th>{{ $col }}</th>
                @endforeach
            </tr>

            @foreach($result['rows'] as $row)
                <tr>
                    @foreach((array)$row as $val)
                        <td>{{ $val }}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    @endif
@else
    <h3>❌ Ошибка</h3>
    <p>{{ $result['message'] }}</p>
@endif
