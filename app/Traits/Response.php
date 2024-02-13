<?php

namespace App\Traits;

trait Response
{
    
    public function signup($user, $token)
    {
        return response()->json([
            'message' => 'user created',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ],
            'status' => true,
            'code' => 201,
        ], 201);
    }

    public function signin($user, $token)
    {
        return response()->json([
            'message' => 'user login',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ],
            'status' => true,
            'code' => 200,
        ], 200);
    }
    public function okResponse($msg, $data)
    {
        /*
            $msg  => text when operation done
            $data => return data if you want to return it , if not return []
        */
        return response()->json([
            'message' => $msg,
            'data' => $data,
            'status' => true,
            'code' => 200,
        ], 200);
    }
    public function createResponse($data)
    {
        /*
            $msg  => text when operation done
            $data => return data if you want to return it , if not return []
        */
        return response()->json([
            'message' => 'created',
            'data' => $data,
            'status' => true,
            'code' => 201,
        ], 201);
    }
    public function errorResponse($msg = 'data not found')
    {
        /*
            $msg  => 'data not found' default msg error , if you want another message send it as a parameter
        */
        return response()->json([
            'message' => $msg,
            'data' => [],
            'status' => true,
            'code' => 404,
        ], 404);
    }
    public function paginateResponse($data)
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
            'message' => 'data fetched successfully',
            'data' => $dataFetched,
            'links' => $links,
            'meta' => $meta,
            'status' => true,
            'code' => 200,
        ], 200);
    }
}
