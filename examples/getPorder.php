<?php
require_once __DIR__ . '/common.php';

$data = [
    'token' => '1252002bd3ff4a418b24b331cd28b0c4',  //获取的token
    'sdkId' => $sdkId,                              //自己的sdkId
    'orderAmount' => 10,                            //单位
    'currencyType' => 'BAIC',                       //币种
    'orderNo' => '12121212',                        //自己系统中的订单号
];

try {
    $porder = $baic->getPorder($data);
    /**
     * $porder返回结构
     *  {
     *      "success": "true",
     *      "message": "获取成功！",
     *      "porder": "yh4ea65gh41ae65t4pxm-123123-999-1534925308319-BAIC"
     *  }
     */
} catch (\Gangangan\Baic\Exceptions\Exception $e) {
    $message = $e->getMessage();
    if ($e instanceof \Gangangan\Baic\Exceptions\HttpException) {
        $message = '接口异常：' . $message;
    }
    // 其它逻辑...
}