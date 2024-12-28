<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function loginform(){
        return view('admin.auth.login');
    }
    public function register(Request $request){
        $fields  = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:8',
        ]);
        
        $user = User::create($fields);

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json(compact('user','token'));
    }

    public function login(Request $request){
        $fields  = $request->validate([
            'ascod' => 'required|exists:users',
            'password' => 'required',
        ]);

        $user = User::where('ascod', $request->ascod)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return back()->with('error', 'Assistant code or Password is Incorect');
        }

        // $token = $user->createToken($user->email)->plainTextToken;
        Auth::login($user);
        return redirect()->to(route('dashboard'));
    }

    public function changePass(Request $request, $id)
    {
        $this->validate($request, [
            'password'  => 'required|min:8|string',
            'confirmPassword'  => 'required|same:password',
        ]);
        User::where('id', $id)->update([
            'password' => Hash::make($request->password),
        ]);
        Auth::logout();
        return redirect()->to(route('user.login.page'));
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login.page');
    }
}
