<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォームの確認画面 - FashionablyLate</title>
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
            background-color: white;
            border-bottom: 1px solid #ddd;
            position: relative;
        }

        .header__logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--logo-color);
            text-decoration: none;
            font-family: serif;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            background-color: white;
        }

        .brand-title {
            color: var(--logo-color);
            font-size: 36px;
            margin-bottom: 10px;
            text-align: center;
            font-family: serif;
        }

        .confirm-title {
            color: var(--logo-color);
            font-size: 36px;
            margin-bottom: 40px;
            text-align: center;
            font-family: serif;
        }

        .confirm-card {
            background-color: #FFFFFF;
            border-radius: 5px;
            padding: 50px;
            width: 100%;
            max-width: 900px;
        }

        .confirm-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .confirm-table tr {
            border-bottom: 1px solid #ddd;
        }

        .confirm-label {
            background-color: #E8D4B8;
            color: white;
            font-weight: 500;
            padding: 15px 20px;
            width: 200px;
            vertical-align: top;
        }

        .confirm-label-empty {
            background-color: white;
            padding: 15px 20px;
            width: 200px;
        }

        .confirm-value {
            background-color: white;
            color: #333;
            padding: 15px 20px;
        }

        .button-group {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }

        .btn-submit {
            padding: 12px 40px;
            background-color: var(--logo-color);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #6B5B52;
        }

        .btn-edit {
            color: var(--logo-color);
            text-decoration: underline;
            font-size: 16px;
            cursor: pointer;
            transition: color 0.3s;
            margin-left: 20px;
        }

        .btn-edit:hover {
            color: #6B5B52;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="{{ route('top') }}" class="header__logo">FashionablyLate</a>
    </header>

    <main class="main-content">
        <h2 class="confirm-title">Confirm</h2>
        <div class="confirm-card">
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
                <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
                <input type="hidden" name="gender" value="{{ $data['gender'] }}">
                <input type="hidden" name="email" value="{{ $data['email'] }}">
                <input type="hidden" name="phone1" value="{{ $data['phone1'] }}">
                <input type="hidden" name="phone2" value="{{ $data['phone2'] }}">
                <input type="hidden" name="phone3" value="{{ $data['phone3'] }}">
                <input type="hidden" name="address" value="{{ $data['address'] }}">
                <input type="hidden" name="building" value="{{ $data['building'] ?? '' }}">
                <input type="hidden" name="category" value="{{ $data['category'] }}">
                <input type="hidden" name="content" value="{{ $data['content'] }}">

                <table class="confirm-table">
                    <tr>
                        <td class="confirm-label">お名前</td>
                        <td class="confirm-value">{{ $data['last_name'] }} {{ $data['first_name'] }}</td>
                    </tr>
                    <tr>
                        <td class="confirm-label">性別</td>
                        <td class="confirm-value">{{ $data['gender'] }}</td>
                    </tr>
                    <tr>
                        <td class="confirm-label">メールアドレス</td>
                        <td class="confirm-value">{{ $data['email'] }}</td>
                    </tr>
                    <tr>
                        <td class="confirm-label">電話番号</td>
                        <td class="confirm-value">{{ $data['phone1'] }}{{ $data['phone2'] }}{{ $data['phone3'] }}</td>
                    </tr>
                    <tr>
                        <td class="confirm-label">住所</td>
                        <td class="confirm-value">{{ $data['address'] }}</td>
                    </tr>
                    @if(!empty($data['building']))
                    <tr>
                        <td class="confirm-label">建物名</td>
                        <td class="confirm-value">{{ $data['building'] }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="confirm-label">お問い合わせの種類</td>
                        <td class="confirm-value">{{ $data['category'] }}</td>
                    </tr>
                    <tr>
                        <td class="confirm-label">お問い合わせ内容</td>
                        <td class="confirm-value">{{ $data['content'] }}</td>
                    </tr>
                </table>

                <div class="button-group">
                    <button type="submit" class="btn-submit">送信</button>
                    <a href="javascript:history.back()" class="btn-edit">修正</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
