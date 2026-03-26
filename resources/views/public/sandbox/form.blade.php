<form action="{{ route('sandbox.execute') }}" method="post" class="sandbox-form" id="sandboxForm">
    @csrf
    <div class="sandbox-editor">
        <textarea
            id="sandboxEditor"
            name="sql"
            placeholder="-- Напишите любой SQL-запрос...&#10;-- Ctrl+Enter для выполнения&#10;&#10;SELECT * FROM Passenger&#10;WHERE age > 25&#10;ORDER BY name;"
            spellcheck="false"
            autocomplete="off"
            autocorrect="off"
            autocapitalize="off"
        >{{ $sql ?? '' }}</textarea>
    </div>

    <div class="sandbox-run-bar">
        <div class="srb-left">
            <span><kbd>Ctrl</kbd> + <kbd>Enter</kbd> — выполнить</span>
            <span><kbd>Tab</kbd> — отступ</span>
        </div>
        <div class="srb-right">
            <button type="button" class="sb-clear-btn" title="Очистить" id="sbClearBtn">
                <i class="bi bi-trash3"></i>
            </button>
            <button type="submit" class="sb-run-btn" id="sbRunBtn">
                <i class="bi bi-play-fill"></i> Выполнить
            </button>
        </div>
    </div>
</form>
