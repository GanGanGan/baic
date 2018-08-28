<?php
require_once __DIR__ . '/common.php';

$data = [
    'token' => '1252002bd3ff4a418b24b331cd28b0c4',      //token
    'sdkId' => $sdkId,                                  //自己的sdkId
    'transactionNo' => '1808223225350327327962',        //交易号
];

try {
    $response = $baic->selectRefundByTransactionNo($data);
} catch (\Gangangan\Baic\Exceptions\Exception $e) {
    $message = $e->getMessage();
    if ($e instanceof \Gangangan\Baic\Exceptions\HttpException) {
        $message = '接口异常：' . $message;
    }
    // 其它逻辑...
}