<!DOCTYPE html>
<html>
<head>
    <title>Account Details</title>
</head>
<body>
    <h1>{{ $account->name }}</h1>
    <p>Reference: {{ $account->reference }}</p>
    <p>Type: {{ $account->type }}</p>
    <p>Docs:</p>
    <ul>
        @foreach($account->docs as $doc)
            <li>{{ $doc }}</li>
        @endforeach
    </ul>
    <a href="{{ route('home') }}">Back to Home</a>
</body>
</html>

