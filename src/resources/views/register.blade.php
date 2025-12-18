<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FashionablyLate</title>
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
            background-color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            padding: 20px 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            background-color: white;
            border-bottom: 1px solid #ddd;
        }

        .header__logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--logo-color);
            text-decoration: none;
            font-family: serif;
        }

        .login-button {
            background-color: var(--logo-color);
            border: 1px solid #E8D4B8;
            color: #E8D4B8;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            position: absolute;
            right: 40px;
        }

        .login-button:hover {
            background-color: #6B5B52;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background-color: #F2ECE7;
        }

        .register-title {
            color: var(--logo-color);
            font-size: 36px;
            margin-bottom: 30px;
            font-family: serif;
        }

        .register-card {
            background-color: #FFFFFF;
            border-radius: 5px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
        }

        .register-card form {
            text-align: left;
        }

        .register-card form .register-button {
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }

        .form-label {
            display: block;
            color: #333;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 500;
            text-align: left;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 0;
            font-size: 16px;
            transition: border-color 0.3s;
            background-color: #F5F5F5;
        }

        .form-input:focus {
            outline: none;
            border-color: #8B4513;
            background-color: white;
        }

        .form-input::placeholder {
            color: #999;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }

        .register-button {
            display: inline-block;
            width: auto;
            background-color: var(--logo-color);
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .register-button:hover {
            background-color: #6B5B52;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="{{ route('top') }}" class="header__logo">FashionablyLate</a>
        <a href="{{ route('login') }}" class="login-button">login</a>
    </header>

    <main class="main-content">
        <h1 class="register-title">Register</h1>
        <div class="register-card">
            <form action="/register" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">お名前</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-input @error('name') is-invalid @enderror" 
                        placeholder="例:山田 太郎"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input @error('email') is-invalid @enderror" 
                        placeholder="例: test@example.com"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">パスワード</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input @error('password') is-invalid @enderror" 
                        placeholder="例:coachtech1106"
                    >
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="register-button">登録</button>
            </form>
        </div>
    </main>
</body>
</html>

