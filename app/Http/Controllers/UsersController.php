<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create_account(Request $request)
    {
        User::create($request->validate([
            'Account' => 'required|max:50|unique:App\Models\User,email',
            'Password' => 'required|max:50'
        ]));
        $this->success_response();
    }

    public function delete_account(Request $request)
    {
        $request->validate([
            'Account' => 'required|max:50'
        ]);
        $user = User::where('email', $request->Account)->firstOrFail();
        $user->delete();
        $this->success_response();
    }

    public function update_password(Request $request)
    {
        $data = $request->validate([
            'Account' => 'required|max:50',
            'Password' => 'required|max:50'
        ]);
        $user = User::where('email', $data['Account'])->firstOrFail();
        $user->password = $data['Password'];
        $user->save();
        $this->success_response();
    }

    public function validate_login(Request $request)
    {
        $data = $request->validate([
            'Account' => 'required|max:50',
            'Password' => 'required|max:50'
        ]);
        $user = User::where([
            'email' => $data['Account'],
            'password' => $data['Password']
        ])->first();
        if ($user) {
            response()->json([
                'Code' => '0',
                'Message' => '',
                'Result' => null
            ]);
        } else {
            response()->json([
                'Code' => '2',
                'Message' => 'Login Failed',
                'Result' => null
            ], 400);
        }
    }

    private function success_response()
    {
        return response()->json([
            'Code' => '0',
            'Message' => '',
            'Result' => [
                'IsOK' => true
            ]
        ]);
    }
}
