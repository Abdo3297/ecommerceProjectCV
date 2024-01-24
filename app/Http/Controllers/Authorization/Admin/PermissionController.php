<?php

namespace App\Http\Controllers\Authorization\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authorization\Admin\PermissionRequest;
use App\Http\Resources\Authorization\PermissionResource;
use App\Traits\Response;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    use Response;
    public function __construct()
    {
        $this->middleware('permission:show_permission')->only(['index','show']);
        $this->middleware('permission:add_permission')->only(['store']);
        $this->middleware('permission:edit_permission')->only(['update']);
        $this->middleware('permission:delete_permission')->only(['destroy']);
    }
    public function index()
    {
        if(Permission::exists()) {
            $permissions = Permission::where('guard_name','userapi')->paginate(PAGINATE);
            return $this->paginateResponse('data fetched successfully',PermissionResource::collection($permissions));
        }
        return $this->errorResponse();
    }
    public function show($id)
    {
        $permission = Permission::where('guard_name','userapi')->find($id);
        if($permission) {
            return $this->okResponse('data fetched successfully',PermissionResource::make($permission));
        }
        return $this->errorResponse();
    }
    public function store(PermissionRequest $request)
    {
        $data = $request->validated();
        $permission = Permission::create($data);
        if($permission) {
            return $this->okResponse('permission created',PermissionResource::make($permission));
        }
    }
    public function update(PermissionRequest $request,$id)
    {
        $data = $request->validated();
        $permission = Permission::where('guard_name','userapi')->find($id);
        $permission->update($data);
        if($permission) {
            return $this->okResponse('permission updated',PermissionResource::make($permission));
        }
    }
    public function destroy($id)
    {
        $permission = Permission::where('guard_name','userapi')->find($id);
        if($permission) {
            $permission->delete();
            return $this->okResponse('Record Deleted',[]);
        }
        return $this->errorResponse();
    }
}
