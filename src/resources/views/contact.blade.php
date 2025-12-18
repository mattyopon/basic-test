<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム入力ページ - FashionablyLate</title>
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
        }

        .brand-title {
            color: var(--logo-color);
            font-size: 36px;
            margin-bottom: 10px;
            text-align: center;
            font-family: serif;
        }

        .contact-title {
            color: var(--logo-color);
            font-size: 36px;
            margin-bottom: 40px;
            text-align: center;
            font-family: serif;
        }

        .contact-card {
            background-color: #FFFFFF;
            border-radius: 5px;
            padding: 50px;
            width: 100%;
            max-width: 900px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 30px;
            margin-bottom: 25px;
            align-items: start;
        }

        .form-label {
            color: var(--logo-color);
            font-size: 14px;
            font-weight: 500;
            padding-top: 12px;
        }

        .form-label-required {
            color: #dc3545;
            margin-right: 3px;
        }

        .form-input-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 0;
            font-size: 16px;
            transition: border-color 0.3s;
            font-family: inherit;
            background-color: #f5f5f5;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--logo-color);
            background-color: white;
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #999;
        }

        .form-textarea {
            min-height: 150px;
            resize: vertical;
        }

        .name-group {
            display: flex;
            gap: 10px;
        }

        .name-group .form-input {
            flex: 1;
        }

        .phone-group {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .phone-group .form-input {
            flex: 1;
        }

        .phone-separator {
            color: #666;
            font-size: 16px;
        }

        .radio-group {
            display: flex;
            gap: 20px;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .radio-item input[type="radio"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: var(--logo-color);
        }

        .radio-item label {
            cursor: pointer;
            color: #333;
            font-weight: normal;
            font-size: 16px;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
        }

        .btn-top {
            padding: 12px 30px;
            background-color: #D4A574;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-top:hover {
            background-color: #C49564;
        }

        .submit-button {
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

        .submit-button:hover {
            background-color: #6B5B52;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="{{ route('top') }}" class="header__logo">FashionablyLate</a>
    </header>

    <main class="main-content">
        <h2 class="contact-title">Contact</h2>
        <div class="contact-card">
            <form action="{{ route('contact.confirm') }}" method="POST">
                @csrf
                
                <div class="form-row">
                    <label class="form-label">
                        お名前<span class="form-label-required">※</span>
                    </label>
                    <div class="form-input-group">
                        <div class="name-group">
                            <input 
                                type="text" 
                                name="last_name" 
                                class="form-input @error('last_name') is-invalid @enderror" 
                                placeholder="例:山田"
                                value="{{ old('last_name') }}"
                            >
                            <input 
                                type="text" 
                                name="first_name" 
                                class="form-input @error('first_name') is-invalid @enderror" 
                                placeholder="例:太郎"
                                value="{{ old('first_name') }}"
                            >
                        </div>
                        @error('last_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        @error('first_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <label class="form-label">
                        性別<span class="form-label-required">※</span>
                    </label>
                    <div class="form-input-group">
                        <div class="radio-group">
                            <div class="radio-item">
                                <input 
                                    type="radio" 
                                    id="gender_male" 
                                    name="gender" 
                                    value="男性"
                                    {{ old('gender', '男性') == '男性' ? 'checked' : '' }}
                                >
                                <label for="gender_male">男性</label>
                            </div>
                            <div class="radio-item">
                                <input 
                                    type="radio" 
                                    id="gender_female" 
                                    name="gender" 
                                    value="女性"
                                    {{ old('gender') == '女性' ? 'checked' : '' }}
                                >
                                <label for="gender_female">女性</label>
                            </div>
                            <div class="radio-item">
                                <input 
                                    type="radio" 
                                    id="gender_other" 
                                    name="gender" 
                                    value="その他"
                                    {{ old('gender') == 'その他' ? 'checked' : '' }}
                                >
                                <label for="gender_other">その他</label>
                            </div>
                        </div>
                        @error('gender')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <label for="email" class="form-label">
                        メールアドレス<span class="form-label-required">※</span>
                    </label>
                    <div class="form-input-group">
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
                </div>

                <div class="form-row">
                    <label class="form-label">
                        電話番号<span class="form-label-required">※</span>
                    </label>
                    <div class="form-input-group">
                        <div class="phone-group">
                            <input 
                                type="text" 
                                name="phone1" 
                                class="form-input @error('phone1') is-invalid @enderror" 
                                placeholder="080"
                                value="{{ old('phone1') }}"
                                maxlength="5"
                            >
                            <span class="phone-separator">-</span>
                            <input 
                                type="text" 
                                name="phone2" 
                                class="form-input @error('phone2') is-invalid @enderror" 
                                placeholder="1234"
                                value="{{ old('phone2') }}"
                                maxlength="5"
                            >
                            <span class="phone-separator">-</span>
                            <input 
                                type="text" 
                                name="phone3" 
                                class="form-input @error('phone3') is-invalid @enderror" 
                                placeholder="5678"
                                value="{{ old('phone3') }}"
                                maxlength="5"
                            >
                        </div>
                        @error('phone1')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        @error('phone2')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        @error('phone3')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        @error('phone')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <label for="address" class="form-label">
                        住所<span class="form-label-required">※</span>
                    </label>
                    <div class="form-input-group">
                        <input 
                            type="text" 
                            id="address" 
                            name="address" 
                            class="form-input @error('address') is-invalid @enderror" 
                            placeholder="例:東京都渋谷区千駄ヶ谷1-2-3"
                            value="{{ old('address') }}"
                        >
                        @error('address')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <label for="building" class="form-label">建物名</label>
                    <div class="form-input-group">
                        <input 
                            type="text" 
                            id="building" 
                            name="building" 
                            class="form-input" 
                            placeholder="例: 千駄ヶ谷マンション101"
                            value="{{ old('building') }}"
                        >
                    </div>
                </div>

                <div class="form-row">
                    <label for="category" class="form-label">
                        お問い合わせの種類<span class="form-label-required">※</span>
                    </label>
                    <div class="form-input-group">
                        <select 
                            id="category" 
                            name="category" 
                            class="form-select @error('category') is-invalid @enderror"
                        >
                            <option value="">選択してください</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->content }}" {{ old('category') == $category->content ? 'selected' : '' }}>{{ $category->content }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <label for="content" class="form-label">
                        お問い合わせ内容<span class="form-label-required">※</span>
                    </label>
                    <div class="form-input-group">
                        <textarea 
                            id="content" 
                            name="content" 
                            class="form-textarea @error('content') is-invalid @enderror"
                            placeholder="お問い合わせ内容をご記載ください"
                        >{{ old('content') }}</textarea>
                        @error('content')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="button-group">
                    <a href="{{ route('top') }}" class="btn-top">トップに戻る</a>
                    <button type="submit" class="submit-button">確認画面</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
