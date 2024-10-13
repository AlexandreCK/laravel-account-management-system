<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <link rel="stylesheet" href="{{ asset('css/accounts.css') }}">
</head>

<body>
    <div class="container">
        <div class="account-details">
            <h1>{{ $account->name }}</h1>
            <p><strong>Reference:</strong> {{ $account->reference }}</p>
            <p><strong>Type:</strong> {{ $account->type }}</p>
            <p><strong>Docs:</strong></p>
            <ul>
                @if (is_array($account->docs))
                @foreach($account->docs as $doc)
                <li>{{ $doc }}</li>
                @endforeach
                @else
                <li>No documents available</li>
                @endif
            </ul>
            <a href="{{ route('home') }}" class="back-button">Back to Home</a>
        </div>
    </div>
</body>

</html>
