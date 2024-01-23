<?php

namespace App\Http\Controllers\Authorization\Admin;

use App\Http\Requests\Authorization\Admin\RoleRequest;
use App\Traits\Response;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\Authorization\RoleResource;

class RoleController extends Controller
{
    use Response;
    public function __construct()
    {
        $this->middleware('permission:show_role')->only(['index', 'show']);
        $this->middleware('permission:add_role')->only(['store']);
        $this->middleware('permission:edit_role')->only(['update']);
        $this->middleware('permission:delete_role')->only(['destroy']);
    }
    public function index()
    {
        if (Role::exists()) {
            $roles = Role::where('guard_name', 'userapi')->paginate(4);
            return RoleResource::collection($roles);
        }
        return $this->errorResponse('Data Not Found');
    }
    public function show($id)
    {
        $role = Role::where('guard_name', 'userapi')->find($id);
        if ($role) {
            return RoleResource::make($role);
        }
        return $this->errorResponse('Record Not Found');
    }
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create($data);
        if ($role) {
            return $this->okResponse('role created');
        }
    }
    public function update(RoleRequest $request, $id)
    {
        $data = $request->validated();
        $role = Role::where('guard_name', 'userapi')->find($id);
        $role->update($data);
        if ($role) {
            return $this->okResponse('role updated');
        }
    }
    public function destroy($id)
    {
        $role = Role::where('guard_name', 'userapi')->find($id);
        if ($role) {
            $role->delete();
            return $this->okResponse('Record Deleted');
        }
        return $this->errorResponse('Record Not Found');
    }
}
