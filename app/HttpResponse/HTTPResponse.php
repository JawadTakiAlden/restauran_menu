<?php

namespace App\HttpResponse;

trait HTTPResponse
{
    public function success($data = null , $message = "request was successfully" , $code = 200){
        return response([
           'data' => $data,
           'message' => $message,
        ] , $code);
    }

    public function error($message = null , $code = null){
        return response([
            'message' => $message,
        ] , $code);
    }

    public function serverError($th = null){
        if ($th){
            return $this->error($th->getMessage() , 500);
        }
        return $this->error("error happen , the support team notified and will solve the problem soon" , 500);
    }
}
