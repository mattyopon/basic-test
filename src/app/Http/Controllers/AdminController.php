<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    /**
     * 管理画面
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        // 名前・メールアドレスでの検索（部分一致・完全一致）
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 性別での検索
        if ($request->filled('gender') && $request->gender !== 'all') {
            // 文字列（'男性'、'女性'、'その他'）または数値（'1'、'2'、'3'）の両方に対応
            if (is_numeric($request->gender)) {
                $query->where('gender', (int)$request->gender);
            } else {
                $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];
                $genderValue = $genderMap[$request->gender] ?? null;
                if ($genderValue) {
                    $query->where('gender', $genderValue);
                }
            }
        }

        // お問い合わせ種類での検索
        if ($request->filled('category') && $request->category !== 'all') {
            // 数値の場合は直接category_idで検索、文字列の場合はカテゴリ名からIDを取得
            if (is_numeric($request->category)) {
                $query->where('category_id', (int)$request->category);
            } else {
                $category = Category::where('content', $request->category)->first();
                if ($category) {
                    $query->where('category_id', $category->id);
                }
            }
        }

        // 日付での検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->with('category')->orderBy('created_at', 'desc')->paginate(7)->withQueryString();
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    /**
     * 詳細表示
     */
    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        $genderMap = [1 => '男性', 2 => '女性', 3 => 'その他'];
        
        return response()->json([
            'id' => $contact->id,
            'last_name' => $contact->last_name ?? '',
            'first_name' => $contact->first_name ?? '',
            'name' => ($contact->last_name ?? '') . ' ' . ($contact->first_name ?? ''),
            'gender' => $genderMap[$contact->gender] ?? '-',
            'email' => $contact->email ?? '-',
            'tel' => $contact->tel ?? '-',
            'phone' => $contact->tel ?? '-', // モーダルで使用しているため残す
            'address' => $contact->address ?? '-',
            'building' => $contact->building ?? null,
            'category_name' => $contact->category->content ?? '-',
            'category' => $contact->category->content ?? '-', // モーダルで使用しているため残す
            'detail' => $contact->detail ?? '-',
            'content' => $contact->detail ?? '-', // モーダルで使用しているため残す
        ]);
    }

    /**
     * 削除
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['success' => true]);
    }

    /**
     * CSVエクスポート
     */
    public function export(Request $request)
    {
        $query = Contact::query();

        // 検索条件を適用
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            // 文字列（'男性'、'女性'、'その他'）または数値（'1'、'2'、'3'）の両方に対応
            if (is_numeric($request->gender)) {
                $query->where('gender', (int)$request->gender);
            } else {
                $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];
                $genderValue = $genderMap[$request->gender] ?? null;
                if ($genderValue) {
                    $query->where('gender', $genderValue);
                }
            }
        }

        if ($request->filled('category') && $request->category !== 'all') {
            // 数値の場合は直接category_idで検索、文字列の場合はカテゴリ名からIDを取得
            if (is_numeric($request->category)) {
                $query->where('category_id', (int)$request->category);
            } else {
                $category = Category::where('content', $request->category)->first();
                if ($category) {
                    $query->where('category_id', $category->id);
                }
            }
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->with('category')->orderBy('created_at', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="contacts_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($contacts) {
            $file = fopen('php://output', 'w');
            
            // BOMを追加（Excelで文字化けしないように）
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // ヘッダー行
            fputcsv($file, [
                'ID',
                'お名前',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせの種類',
                'お問い合わせ内容',
                '登録日時'
            ]);

            // データ行
            $genderMap = [1 => '男性', 2 => '女性', 3 => 'その他'];
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->last_name . ' ' . $contact->first_name,
                    $genderMap[$contact->gender] ?? '',
                    $contact->email,
                    $contact->tel ?? '',
                    $contact->address ?? '',
                    $contact->building ?? '',
                    $contact->category->content ?? '',
                    $contact->detail,
                    $contact->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
