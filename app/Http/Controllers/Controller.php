<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function response($data){
        return response()->json([
            'data'=>$data
        ]);
    }

    public function success(string $message = null, $data = null){
        return response()->json([
            'status' => 'success',
            'success' => true,
            'message' => $message ?? 'Operation Success',
            'data' => $data,
        ]);
    }

    public function error(string $message , array $data = null){
        return response()->json([
            'status' => 'error',
            'success' => false,
            'message' => $message ?? 'Error Occured',
            'data' => $data
        ], 400);
    }
}
