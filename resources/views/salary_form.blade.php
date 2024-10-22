<form action="/calculate" method="POST">
    @csrf
    <label for="gross_salary">Gross Annual Salary:</label>
    <input type="number" id="gross_salary" name="gross_salary" required>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <button type="submit">Calculate</button>
</form>
