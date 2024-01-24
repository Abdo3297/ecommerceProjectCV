<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Traits\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\Admin\AdminResource;

class ProfileController extends Controller
{
    use Response;
    public function __invoke()
    {
        $admin = auth('adminapi')->user();
        return $this->okResponse('data fetched successfully',AdminResource::make($admin));
    }
}
