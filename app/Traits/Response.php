<?php

namespace App\Traits;


trait Response {
    // auth
    public function  registerOrLogin($msg,$user,$token,$status) 
    {
        return response()->json([
            'message' => $msg,
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ],
            'status' => true,
            'code' => $status,
        ], $status);
    }
    // CRUD
    public function read($data)
    {
        return response()->json([
            'message' => 'Successfully Get Data',
            'data' => $data,
            'status' => true,
            'code' => 200,
        ], 200);
    }
    public function update($data)
    {
        return response()->json([
            'message' => 'Successfully Update Data',
            'data' => $data,
            'status' => true,
            'code' => 200,
        ], 200);
    }
    // ok & error response
    public function okResponse($msg)
    {
        return response()->json([
            'message' => $msg,
            'data' => [],
            'status' => true,
            'code' => 200,
        ], 200);
    }
    public function errorResponse($msg)
    {
        return response()->json([
            'message' => $msg,
            'data' => [],
            'status' => true,
            'code' => 400,
        ], 400);
    }
}