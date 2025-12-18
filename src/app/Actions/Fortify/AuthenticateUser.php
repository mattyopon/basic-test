<?php

namespace App\Actions\Fortify;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthenticateUser
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\User|null
     */
    public function __invoke(Request $request)
    {
        // LoginRequestのバリデーションルールとメッセージを使用
        $loginRequest = new LoginRequest();
        $rules = $loginRequest->rules();
        $messages = $loginRequest->messages();
        
        // バリデーションを実行
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }
        
        // 認証処理
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['メールアドレスまたはパスワードが正しくありません。'],
            ]);
        }

        return $user;
    }
}

