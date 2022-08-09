<?php

namespace App\Http\Controllers\v1;

use Exception;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseTraits;

class RoleController extends Controller
{   

    use ResponseTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $roles = Role::paginate(10);
            return $this->success(false, 'Roles List Found Successfully', $roles);
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }
   
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
        ]);
        
        try {
            $role = Role::create([
                'name' => $request->name,
                'permissions' => $request->permissions
            ]);
            return $this->success(false, 'Roles Created Successfully', $role);
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $role = Role::find($id);
            return $this->success(false, 'Role Fond Successfully', $role);
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        try {
            $role = Role::find($id);
            $role->update([
                'name' => $request->name,
                'permissions' => $request->permissions
            ]);
            return $this->success(false, 'Roles Update Successfully', $role);
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $role = Role::find($id);
            $role->delete();
            return $this->success(false, 'Roles Deleted Successfully', null);
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }
}
