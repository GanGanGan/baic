<?php
require_once __DIR__ . '/common.php';

$data = [
    'token' => '1252002bd3ff4a418b24b331cd28b0c4',      //token
    'sdkId' => $sdkId,                                  //自己的sdkId
    'beginTime' => '1534038254774',                     //开始时间
    'endTime' => '1534239254774',                       //结束时间
    'merchantId' => 'asdasdasdasdasd',                  //商户ID
];

try {
    $response = $baic->selectOrderByTime($data);
} catch (\Gangangan\Baic\Exceptions\Exception $e) {
    $message = $e->getMessage();
    if ($e instanceof \Gangangan\Baic\Exceptions\HttpException) {
        $message = '接口异常：' . $message;
    }
    // 其它逻辑...
}