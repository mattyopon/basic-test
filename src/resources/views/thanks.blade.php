<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせありがとうございます - FashionablyLate</title>
    <style>
        :root {
            --logo-color: #7A746D;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #FEFEFE;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: 'Thank you';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 200px;
            font-weight: bold;
            color: rgba(200, 200, 200, 0.15);
            white-space: nowrap;
            z-index: 0;
            pointer-events: none;
            font-family: serif;
        }

        .main-content {
            position: relative;
            z-index: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }

        .thanks-message {
            color: #4A4A4A;
            font-size: 18px;
            font-weight: 500;
        }

        .home-button {
            display: inline-block;
            background-color: var(--logo-color);
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .home-button:hover {
            background-color: #6B5B52;
        }
    </style>
</head>
<body>
    <main class="main-content">
        <p class="thanks-message">お問い合わせありがとうございました</p>
        <a href="{{ route('contact.index') }}" class="home-button">HOME</a>
    </main>
</body>
</html>
