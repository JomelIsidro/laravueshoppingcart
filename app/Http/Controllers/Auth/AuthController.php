<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\ProfileModel;
use Hash;

class AuthController extends Controller
{
    public function login() {
        return response()->json('test login',200,[],JSON_PRETTY_PRINT);
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $user_id = Auth::user()->id;
            return response()->json(Auth::user(),200,[],JSON_PRETTY_PRINT); 
            // return redirect()->intended('incoming')
            //             ->withSuccess('You have Successfully loggedin');
        }
        return response()->json('login failed',200,[],JSON_PRETTY_PRINT); 
        // return redirect("login")->with('messageError','Invalid Username or Password!');
    }

    public function registration() {
        return response()->json('test registration',200,[],JSON_PRETTY_PRINT);
    }

    public function postRegistration(Request $request) {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        
        $data = $request->all();
        $check = $this->create($data);
        
        return response()->json($check,200,[],JSON_PRETTY_PRINT); 
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'username' => $data['username'],
        'password' => Hash::make($data['password'])
      ]);
    }
}
