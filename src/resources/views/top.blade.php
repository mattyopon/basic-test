<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F5F5DC;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            border-bottom: 1px solid #ddd;
        }

        .header__logo {
            font-size: 24px;
            font-weight: bold;
            color: #7A746D;
            text-decoration: none;
            font-family: serif;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .top-title {
            color: #8B4513;
            font-size: 48px;
            margin-bottom: 50px;
            text-align: center;
        }

        .menu-card {
            background-color: white;
            border-radius: 10px;
            padding: 50px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .menu-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .menu-item {
            width: 100%;
        }

        .menu-link {
            display: block;
            width: 100%;
            padding: 15px 30px;
            background-color: #8B4513;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: 500;
            text-align: center;
            transition: background-color 0.3s;
        }

        .menu-link:hover {
            background-color: #6B3410;
        }

        .menu-link.secondary {
            background-color: #D4A574;
        }

        .menu-link.secondary:hover {
            background-color: #C49564;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="{{ route('top') }}" class="header__logo">FashionablyLate</a>
    </header>

    <main class="main-content">
        <h1 class="top-title">FashionablyLate</h1>
        <div class="menu-card">
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="{{ route('login') }}" class="menu-link">ログイン</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('register') }}" class="menu-link">登録</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('contact.index') }}" class="menu-link secondary">お問い合わせ</a>
                </li>
            </ul>
        </div>
    </main>
</body>
</html>

