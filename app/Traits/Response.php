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
    // ok & error response
    public function okResponse($msg,$data)
    {
        return response()->json([
            'message' => $msg,
            'data' => $data,
            'status' => true,
            'code' => 200,
        ], 200);
    }
    public function errorResponse($msg = 'data not found')
    {

        return response()->json([
            'message' => $msg,
            'data' => [],
            'status' => true,
            'code' => 400,
        ], 400);
    }
    public function paginateResponse($msg,$data)
    {
        $dataFetched = $data->items();

        $links = [
            'first' => $data->url(1),
            'last' => $data->url($data->lastPage()),
            'next' => $data->nextPageUrl(),
            'prev' => $data->previousPageUrl(),
        ];

        $meta = [
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'from' => $data->firstItem(),
            'to' => $data->lastItem(),
        ];

        return response()->json([
            'message' => $msg,
            'data' => $dataFetched,
            'links' => $links,
            'meta' => $meta,
            'status' => true,
            'code' => 200,
        ],200);
    }
}