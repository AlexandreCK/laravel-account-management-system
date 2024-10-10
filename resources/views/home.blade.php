<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Latest Accounts</h1>
    <ul>
        @foreach($accounts as $account)
            <li>
                <a href="{{ route('accounts.show', $account->id) }}">{{ $account->name }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>

