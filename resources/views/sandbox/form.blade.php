<form method="POST" action="/sandbox">
    @csrf

    <textarea name="sql" rows="8" cols="80"
              placeholder="Введите SQL"></textarea>

    <br><br>
    <button type="submit">Выполнить</button>
</form>
