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

        <div class="account-details">
            <h1>Edit Account</h1>
            <form action="{{ route('accounts.update', $account->id) }}" method="POST">
                @csrf
                @method('PUT')

                <p><strong>Account Name:</strong></p>
                <input type="text" id="name" name="name" value="{{ $account->name }}" required>

                <p><strong>Reference:</strong></p>
                <input type="text" id="reference" name="reference" value="{{ $account->reference }}" required>

                <p><strong>Account Type:</strong></p>
                <select name="type" required>
                    @foreach($types as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
                <p><strong>Docs:</strong></p>
                <textarea id="docs" name="docs" placeholder="Comma separated">{{ implode(',', $account->docs) }}</textarea>
                <p></p>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>
</body>

</html>