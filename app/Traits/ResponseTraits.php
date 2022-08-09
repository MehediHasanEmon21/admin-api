<?php

namespace App\Traits;

trait ResponseTraits{
    public function success($error= null, $msg = null, $data = null){

        return response()->json([
            'error' => $error,
            'message' => $msg,
            'data' => $data
        ]);
    }

    public function error ($error= null, $msg = null, $data = null){

        return response()->json([
            'error' => $error,
            'message' => $msg,
            'data' => $data
        ]);
    }
}