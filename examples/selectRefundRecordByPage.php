<?php
require_once __DIR__ . '/common.php';

$data = [
    'token' => '1252002bd3ff4a418b24b331cd28b0c4',      //token
    'sdkId' => $sdkId,                                  //自己的sdkId
    'limit' => 1,                                       //一页几个
    'page' => 1,                                        //第几页
];

try {
    $response = $baic->selectRefundRecordByPage($data);
} catch (\Gangangan\Baic\Exceptions\Exception $e) {
    $message = $e->getMessage();
    if ($e instanceof \Gangangan\Baic\Exceptions\HttpException) {
        $message = '接口异常：' . $message;
    }
    // 其它逻辑...
}