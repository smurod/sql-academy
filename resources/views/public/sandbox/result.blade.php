<div class="sandbox-results" id="sbResults">
    <div class="sandbox-results-header">
        <div class="sr-tabs">
            <button type="button" class="sr-tab active">Результат</button>
        </div>
        <span class="sr-info" id="sbResultsInfo">
            @isset($result)
                @if($result['status'] === 'ok' && isset($result['count']))
                    {{ $result['count'] }} строк
                @elseif($result['status'] === 'error')
                    Ошибка
                @endif
            @endisset
        </span>
    </div>
    <div class="sandbox-results-body" id="sbResultsBody">

        @unless(isset($result))
            <div class="sb-result-empty">
                <i class="bi bi-terminal"></i>
                <span>Выполните запрос, чтобы увидеть результат</span>
            </div>

        @elseif($result['status'] === 'ok' && isset($result['rows']) && count($result['rows']) > 0)
            <div class="sb-table-wrap">
                <table class="sb-result-table">
                    <thead>
                    <tr>
                        <th class="row-num-header">#</th>
                        @foreach(array_keys((array)$result['rows'][0]) as $col)
                            <th>{{ $col }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result['rows'] as $idx => $row)
                        <tr>
                            <td class="row-num">{{ $idx + 1 }}</td>
                            @foreach((array)$row as $val)
                                @if(is_null($val))
                                    <td class="null-val">NULL</td>
                                @else
                                    <td>{{ $val }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        @elseif($result['status'] === 'ok' && isset($result['affected_rows']))
            <div class="sb-result-msg success">
                <i class="bi bi-check-circle-fill"></i>
                <div class="sb-msg-content">
                    <h4 class="success">Запрос выполнен</h4>
                    <p>{{ $result['message'] }} — {{ $result['affected_rows'] }} строк затронуто</p>
                </div>
            </div>

        @elseif($result['status'] === 'ok')
            <div class="sb-result-msg success">
                <i class="bi bi-check-circle-fill"></i>
                <div class="sb-msg-content">
                    <h4 class="success">Запрос выполнен</h4>
                    <p>0 строк возвращено</p>
                </div>
            </div>

        @else
            <div class="sb-result-msg error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <div class="sb-msg-content">
                    <h4 class="error">Ошибка SQL</h4>
                    <p>{{ $result['message'] }}</p>
                </div>
            </div>
        @endunless

    </div>
</div>
