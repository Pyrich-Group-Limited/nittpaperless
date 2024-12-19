<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        h1 {
            text-align: center;
        }
        .content {
            margin: 20px;
        }
    </style>
</head>
<body>
    <h1>Memo</h1>
    <div class="content">
        {!! nl2br(e($content)) !!}
    </div>
</body>
</html>
