<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="form-container">
        <h1>Account Form</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form id="accountForm" action="{{ route('accounts.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Account Name" required>
            <input type="text" name="reference" placeholder="Reference" required>
            <select name="type" required>
                @foreach($types as $type)
                <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
            <textarea name="docs" placeholder="Documents" rows="4"></textarea>
            <button type="submit">Submit</button>
        </form>
    </div>
    <div class="accounts-container">
        <h1>Latest Accounts</h1>
        <ul>
            @foreach($accounts as $account)
            <li>
                <a href="{{ route('accounts.show', $account->id) }}">{{ $account->name }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
