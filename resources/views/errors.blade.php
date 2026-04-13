<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied - 403</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
        }
        .error-img {
            max-width: 350px;
            margin-bottom: 32px;
        }
        .error-text {
            font-size: 1.5rem;
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 24px;
        }
        .btn-back {
            background-color: #0ea5e9;
            color: white;
            padding: 12px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: background-color 0.2s;
            box-shadow: 0 4px 6px -1px rgba(14, 165, 233, 0.2);
        }
        .btn-back:hover {
            background-color: #0284c7;
        }
    </style>
</head>
<body>
    <img src="{{ asset('assets/images/error-illustration.png') }}" alt="403 Access Denied" class="error-img">

    <div class="error-text">You can't access this page.</div>

    <a href="{{ url()->previous() }}" class="btn-back">Back</a>
</body>
</html>
