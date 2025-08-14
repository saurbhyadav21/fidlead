<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Search Results</h2>
        <p>Data Type: {{ $dataType }}</p>
        <ul>
            @foreach($searchFields as $index => $field)
                <li>{{ $field }}: {{ $searchValues[$index] }}</li>
            @endforeach
        </ul>
    </div>
</body>
</html>
