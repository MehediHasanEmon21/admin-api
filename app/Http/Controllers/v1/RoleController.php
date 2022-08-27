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

    public function index()
    {
        try {
            $roles = Role::asc()->get();
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

    public function show($id)
    {
        try {
            $role = Role::find($id);
            return $this->success(false, 'Role Fond Successfully', $role);
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }


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

    public function assign_role(Request $request)
    {

        try {
            $role = Role::where('id', $request->id)->first();
            if ($role) {
                // $role = $role->update(['permissions' => $request->resources]);
                $role->permissions = $request->resources;
                $role->save();
                return $this->success(false, 'Permission Assigned Successfully', $role);
            } else {
                return $this->success(true, 'Role Not Found', null);
            }
        } catch (Exception $e) {
            return $this->success(true, $e->getMessage(), null);
        }
    }
}
