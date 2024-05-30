<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visited Pages</title>
</head>
<body>
<h1>Visited Pages</h1>

<ul>
    @foreach($visitedPages as $page)
        <li>{{ $page }}</li>
    @endforeach
</ul>
</body>
</html>
