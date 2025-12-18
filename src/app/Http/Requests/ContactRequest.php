<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:男性,女性,その他'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone1' => ['required', 'string', function ($attribute, $value, $fail) {
                // 全角チェック
                if (mb_strlen($value) !== strlen($value)) {
                    $fail('電話番号は半角英数字で入力してください');
                    return;
                }
                // 半角数字チェック
                if (!preg_match('/^[0-9]+$/', $value)) {
                    $fail('電話番号は半角英数字で入力してください');
                    return;
                }
                // 5桁を超えた場合のチェック
                if (strlen($value) > 5) {
                    $fail('電話番号は5桁まで数字で入力してください');
                }
            }],
            'phone2' => ['required', 'string', function ($attribute, $value, $fail) {
                // 全角チェック
                if (mb_strlen($value) !== strlen($value)) {
                    $fail('電話番号は半角英数字で入力してください');
                    return;
                }
                // 半角数字チェック
                if (!preg_match('/^[0-9]+$/', $value)) {
                    $fail('電話番号は半角英数字で入力してください');
                    return;
                }
                // 5桁を超えた場合のチェック
                if (strlen($value) > 5) {
                    $fail('電話番号は5桁まで数字で入力してください');
                }
            }],
            'phone3' => ['required', 'string', function ($attribute, $value, $fail) {
                // 全角チェック
                if (mb_strlen($value) !== strlen($value)) {
                    $fail('電話番号は半角英数字で入力してください');
                    return;
                }
                // 半角数字チェック
                if (!preg_match('/^[0-9]+$/', $value)) {
                    $fail('電話番号は半角英数字で入力してください');
                    return;
                }
                // 5桁を超えた場合のチェック
                if (strlen($value) > 5) {
                    $fail('電話番号は5桁まで数字で入力してください');
                }
            }],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'exists:categories,content'],
            'content' => ['required', 'string', 'max:120'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'phone1.required' => '電話番号を入力してください',
            'phone2.required' => '電話番号を入力してください',
            'phone3.required' => '電話番号を入力してください',
            'address.required' => '住所を入力してください',
            'category.required' => 'お問い合わせの種類を選択してください',
            'category.exists' => '選択されたお問い合わせの種類は無効です',
            'content.required' => 'お問い合わせ内容を入力してください',
            'content.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
