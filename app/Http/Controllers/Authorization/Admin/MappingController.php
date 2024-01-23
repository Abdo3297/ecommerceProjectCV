<?php

namespace App\Http\Controllers\Authorization\Admin;

use App\Traits\Response;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authorization\Admin\RolePermissionRequest;

class MappingController extends Controller
{
    use Response;
    public function __construct()
    {
        $this->middleware('permission:assignPermissionsToRole')->only(['assignPermissionsToRole']);
        $this->middleware('permission:revokePermissionsFromRole')->only(['revokePermissionsFromRole']);
    }
    public function assignPermissionsToRole(RolePermissionRequest $request)
    {
        $data = $request->validated();
        $role = Role::where('guard_name', 'userapi')->find($data['role_id']);
        $role->syncPermissions($data['permissions']);
        return $this->okResponse('Permissions assigned successfully');
    }
    public function revokePermissionsFromRole(RolePermissionRequest $request)
    {
        $data = $request->validated();
        $role = Role::where('guard_name', 'userapi')->find($data['role_id']);
        $role->revokePermissionTo($data['permissions']);
        return $this->okResponse('Permissions revoked successfully');
    }
}
