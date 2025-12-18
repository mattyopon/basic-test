<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * お問い合わせフォーム表示
     */
    public function index()
    {
        $categories = \App\Models\Category::all();
        return view('contact', compact('categories'));
    }

    /**
     * 確認画面
     */
    public function confirm(ContactRequest $request)
    {
        $data = [
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'phone3' => $request->phone3,
            'address' => $request->address,
            'building' => $request->building ?? '',
            'category' => $request->category,
            'content' => $request->content,
        ];

        return view('confirm', compact('data'));
    }

    /**
     * お問い合わせ送信処理
     */
    public function store(ContactRequest $request)
    {
        // 性別を数値に変換（男性→1、女性→2、その他→3）
        $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];
        $gender = $genderMap[$request->gender] ?? 1;
        
        // カテゴリ名からIDを取得
        $category = \App\Models\Category::where('content', $request->category)->first();
        
        Contact::create([
            'category_id' => $category->id ?? 1,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $gender,
            'email' => $request->email,
            'tel' => $request->phone1 . $request->phone2 . $request->phone3,
            'address' => $request->address,
            'building' => $request->building ?? null,
            'detail' => $request->content,
        ]);

        return redirect()->route('contact.thanks');
    }

    /**
     * お問い合わせ完了ページ
     */
    public function thanks()
    {
        return view('thanks');
    }
}

