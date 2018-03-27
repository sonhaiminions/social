<?php
namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
	public function getSignUp() {
		return view('Auth.SignUp');
	}
	public function postSignUp(Request $request) {
		$this->validate($request,
			[
				'email' => 'required |unique:users|
				min:4|max:100',
				'username' => 'required|min:4|unique:users|max:100',
				'password' => 'required|min:4|unique:users|max:100',
			],
			[
				'email.required' => 'require email',
				'username.required' => 'require username',
				'password.required' => 'require password',
			]);
		$user = new User();
		$user->username = $request->username;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$user->save();
		return redirect()->route('home')->with('info', 'you registed a account ! ');

	}
	public function getSignIn() {
		return view('Auth.SignIn')->with('info', 'you login ! ');
	}
	public function postSignIn(Request $request) {
		$this->validate($request,
			[
				'email' => 'required |
                min:4|max:100',
				'password' => 'required|min:4|max:100',
			],
			[
				'email.required' => 'require email',
				'password.required' => 'require password',
			]);
		// dd($request->email);
		$data = [
			'email' => $request->email,
			'password' => $request->password,
		];
		// dd($data);
		if (Auth::attempt($data)) {

			return redirect()->route('timeline')->with('info', 'you login ! ');
		} else {
			return redirect()->route('signin')->with('info', 'you cannot login with those info ! ');
		}


	}
	public function logout() {
		Auth::logout();
		return redirect()->route('home')->with('info', 'logout success,see U again');
	}

}