<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ResponseTraits;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ResponseTraits;

    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {

            $request['password'] = Hash::make($request->password);
            $user = User::create($request->all());
            $user->token = $user->createToken('MyApp')->plainTextToken;
            return $this->success(false, 'User Create Successfully', $user);
            
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                $user = auth()->user();
                $user->token = $user->createToken('MyApp')->plainTextToken;
                return $this->success(false, 'Logged In Successfully', $user);

            } else {
                return $this->success(true, 'User Or Password Not Match', null);
            }
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }

    public function me(Request $request){

        try {
            $user = auth()->user();
            if($user){
                return $this->success(false, 'User Found Successfully', $user);
            }else{
                return $this->success(true, 'User Not Found', null);
            }
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }

    public function logout(Request $request){

        try{
            $request->user()->currentAccessToken()->delete();
            return $this->success(false, 'User Logout Successfully', null);
        }catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }

    }
}
