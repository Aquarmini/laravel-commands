<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/9/6 Time: 13:36
// +----------------------------------------------------------------------
namespace App\Services;

class AjaxResponse
{
    protected function ajaxResponse($status = 1, $data = [], $message = '')
    {
        $out = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'timestamp' => time()
        ];

        return response()->json($out);
    }

    public function success($data = null)
    {
        return $this->ajaxResponse(1, $data);
    }

    public function fail($message, $extra = [])
    {
        return $this->ajaxResponse(0, $extra, $message);
    }
}