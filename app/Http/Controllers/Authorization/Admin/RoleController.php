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
            $roles = Role::where('guard_name', 'userapi')->paginate(PAGINATE);
            return $this->paginateResponse(RoleResource::collection($roles)); 
        }
        return $this->errorResponse();
    }
    public function show($id)
    {
        $role = Role::where('guard_name', 'userapi')->find($id);
        if ($role) {
            return $this->okResponse('data fetched successfully',RoleResource::make($role));
        }
        return $this->errorResponse();
    }
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create($data);
        if ($role) {
            return $this->okResponse('role created',RoleResource::make($role));
        }
    }
    public function update(RoleRequest $request, $id)
    {
        $data = $request->validated();
        $role = Role::where('guard_name', 'userapi')->find($id);
        $role->update($data);
        if ($role) {
            return $this->okResponse('role updated',RoleResource::make($role));
        }
    }
    public function destroy($id)
    {
        $role = Role::where('guard_name', 'userapi')->find($id);
        if ($role) {
            $role->delete();
            return $this->okResponse('role deleted',[]);
        }
        return $this->errorResponse();
    }
}
