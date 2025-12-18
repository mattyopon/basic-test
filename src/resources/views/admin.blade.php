<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - FashionablyLate</title>
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
        }

        .header {
            padding: 20px 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            position: relative;
            border-bottom: 1px solid #ddd;
        }

        .header__logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--logo-color);
            text-decoration: none;
            font-family: serif;
        }

        .logout-button {
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

        .logout-button:hover {
            background-color: #6B5B52;
        }

        .main-content {
            padding: 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .admin-title {
            color: var(--logo-color);
            font-size: 32px;
            margin-bottom: 30px;
            text-align: center;
            font-family: serif;
        }

        .search-section {
            background-color: white;
            padding: 15px 30px;
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #8B4513;
        }

        .button-group {
            display: flex;
            gap: 10px;
            align-items: flex-end;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-search {
            background-color: var(--logo-color);
            color: white;
        }

        .btn-search:hover {
            background-color: #6B5B52;
        }

        .btn-reset {
            background-color: #E8D4B8;
            color: #8B4513;
        }

        .btn-reset:hover {
            background-color: #D4C4A8;
        }

        .btn-export {
            background-color: white;
            border: 1px solid #ccc;
            color: #666;
            margin-right: auto;
        }

        .btn-export:hover {
            background-color: #f5f5f5;
        }

        .table-section {
            padding: 15px 30px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table thead {
            background-color: var(--logo-color);
            color: white;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .btn-detail {
            background-color: white;
            border: 1px solid #ccc;
            color: #666;
            padding: 6px 12px;
            border-radius: 3px;
            font-size: 12px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-detail:hover {
            background-color: #f5f5f5;
        }

        .pagination {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            background-color: white;
            padding: 0 30px 20px 30px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 3px;
            text-decoration: none;
            color: #333;
        }

        .pagination .active {
            background-color: var(--logo-color);
            color: white;
            border-color: var(--logo-color);
        }

        /* モーダル */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 40px;
            border-radius: 5px;
            width: 90%;
            max-width: 700px;
            position: relative;
        }

        .modal-close {
            position: absolute;
            right: 15px;
            top: 15px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #f5f5f5;
            border: none;
            font-size: 20px;
            font-weight: bold;
            color: #666;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            transition: background-color 0.3s;
        }

        .modal-close:hover {
            background-color: #e0e0e0;
            color: #333;
        }

        .modal-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .modal-table tr {
            border-bottom: 1px solid #ddd;
        }

        .modal-label {
            color: #8B4513;
            font-weight: 500;
            padding: 15px 20px;
            width: 200px;
            vertical-align: top;
        }

        .modal-value {
            background-color: white;
            color: #333;
            padding: 15px 20px;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="{{ route('top') }}" class="header__logo">FashionablyLate</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">logout</button>
        </form>
    </header>

    <main class="main-content">
        <h1 class="admin-title">Admin</h1>

        <div class="search-section">
            <form action="{{ route('admin') }}" method="GET" class="search-form" id="searchForm">
                <div class="form-group" style="flex: 2;">
                    <input 
                        type="text" 
                        id="search" 
                        name="search" 
                        class="form-input" 
                        placeholder="名前やメールアドレスを入力してください"
                        value="{{ request('search') }}"
                    >
                </div>

                <div class="form-group">
                    <select id="gender" name="gender" class="form-select">
                        <option value="all">性別</option>
                        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>

                <div class="form-group">
                    <select id="category" name="category" class="form-select">
                        <option value="all">お問い合わせの種類</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input 
                        type="date" 
                        id="date" 
                        name="date" 
                        class="form-input" 
                        value="{{ request('date') }}"
                    >
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-search">検索</button>
                    <button type="button" class="btn btn-reset" onclick="resetForm()">リセット</button>
                </div>
            </form>
        </div>

        <div class="pagination">
            <a href="{{ route('admin.export', request()->query()) }}" class="btn btn-export">エクスポート</a>
            @if($contacts->hasPages())
                @if($contacts->onFirstPage())
                    <span>&lt;</span>
                @else
                    <a href="{{ $contacts->previousPageUrl() }}">&lt;</a>
                @endif

                @foreach(range(1, $contacts->lastPage()) as $page)
                    @if($page == $contacts->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $contacts->url($page) }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if($contacts->hasMorePages())
                    <a href="{{ $contacts->nextPageUrl() }}">&gt;</a>
                @else
                    <span>&gt;</span>
                @endif
            @endif
        </div>

        <div class="table-section">
            <table class="table">
                <thead>
                    <tr>
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                        <th>お問い合わせ内容</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                            <td>
                                @if($contact->gender == 1)男性
                                @elseif($contact->gender == 2)女性
                                @elseif($contact->gender == 3)その他
                                @else-
                                @endif
                            </td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->category->content ?? '-' }}</td>
                            <td>{{ Str::limit($contact->detail, 30) }}</td>
                            <td>
                                <button class="btn-detail" onclick="showDetail({{ $contact->id }})">詳細</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 40px;">
                                データがありません
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- モーダルウィンドウ -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <div id="modalBody"></div>
        </div>
    </div>

    <script>
        function resetForm() {
            document.getElementById('searchForm').reset();
            document.getElementById('gender').value = 'all';
            document.getElementById('category').value = 'all';
            window.location.href = '{{ route("admin") }}';
        }

        function showDetail(id) {
            fetch(`/admin/contact/${id}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const modalBody = document.getElementById('modalBody');
                const buildingRow = data.building ? `
                    <tr>
                        <td class="modal-label">建物名</td>
                        <td class="modal-value">${data.building}</td>
                    </tr>
                ` : '';
                modalBody.innerHTML = `
                    <table class="modal-table">
                        <tr>
                            <td class="modal-label">お名前</td>
                            <td class="modal-value">${data.name || '-'}</td>
                        </tr>
                        <tr>
                            <td class="modal-label">性別</td>
                            <td class="modal-value">${data.gender || '-'}</td>
                        </tr>
                        <tr>
                            <td class="modal-label">メールアドレス</td>
                            <td class="modal-value">${data.email || '-'}</td>
                        </tr>
                        <tr>
                            <td class="modal-label">電話番号</td>
                            <td class="modal-value">${data.phone || '-'}</td>
                        </tr>
                        <tr>
                            <td class="modal-label">住所</td>
                            <td class="modal-value">${data.address || '-'}</td>
                        </tr>
                        ${buildingRow}
                        <tr>
                            <td class="modal-label">お問い合わせの種類</td>
                            <td class="modal-value">${data.category || '-'}</td>
                        </tr>
                        <tr>
                            <td class="modal-label">お問い合わせ内容</td>
                            <td class="modal-value">${data.content || '-'}</td>
                        </tr>
                    </table>
                    <button class="btn-delete" onclick="deleteContact(${data.id})">削除</button>
                `;
                document.getElementById('modal').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('データの取得に失敗しました');
            });
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        function deleteContact(id) {
            if (!confirm('このデータを削除しますか？')) {
                return;
            }

            fetch(`/admin/contact/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeModal();
                    location.reload();
                } else {
                    alert('削除に失敗しました');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('削除に失敗しました');
            });
        }

        // モーダル外をクリックで閉じる
        window.onclick = function(event) {
            const modal = document.getElementById('modal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
