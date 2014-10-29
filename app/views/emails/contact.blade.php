<!doctype html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>Email</title>
</head>
<body>
    <h1>{{ $subject }}</h1>
    <h4>{{ $name }} &lt;{{ $from }}&gt;</h4>
    <p>
        {{ $content }}
    </p>
</body>
</html>