<?php
require_once __DIR__ . '/common.php';
try {
    $token = $baic->getToken();
    /**
     * $token返回结构
     *  {
     *      "success": "true",
     *      "message": "获取成功！",
     *      "token": "1252002bd3ff4a418b24b331cd28b0c4"
     *  }
     */
} catch (\Gangangan\Baic\Exceptions\Exception $e) {
    $message = $e->getMessage();
    if ($e instanceof \Gangangan\Baic\Exceptions\HttpException) {
        $message = '接口异常：' . $message;
    }
    // 其它逻辑...
}