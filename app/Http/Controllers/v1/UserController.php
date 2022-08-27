<?php

namespace App\Http\Controllers\v1;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{   
    use ResponseTraits;
    
    public function index()
    {
        try {
            $users = User::asc()->get();
            return $this->success(false, 'User List Found Successfully', $users);
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }

 
    public function store(UserCreateRequest $request)
    { 
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($request->password);
        try {
            $user = User::create($validatedData);
            if($user){
                return $this->success(false, 'User Created Successfully', $user);
            }else{
                return $this->success(true, 'User Creation Error', null);
            }
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
        
    }
    
    public function show($id)
    {
        try {

            $user = User::find($id);
            if(!empty($user)){
                return $this->success(false, 'User Found Successfully', $user);
            }else{
                return $this->success(true, 'User Not FOund', null);
            }
            
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }
    
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $userUpdate = $user->update($request->validated());
            if($userUpdate){
                return $this->success(false, 'User Update Successfully', $user);
            }else{
                return $this->success(true, 'User Update Error', null);
            }
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }
    
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return $this->success(false, 'User Deleted Successfully', null);
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }
}
