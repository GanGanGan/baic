
<h1 align="center">Baic</h1>

<p align="center">基于Baic网关的 PHP 简单组件。</p>

## 安装

```sh
$ composer require gangangan/baic -vvv
```
## 配置

在使用本扩展之前，你需要去 [BAIC商户后台] 注册账号，然后创建应用，获取应用的 APP Id与Key。

## 使用

```php
use Gangangan\Baic\Baic;

$sdkId = 'Your sdkId';
$appKey = 'Your appKey';

$baic = new Baic($sdkId, $appKey);
```

>###  1.获取Token
>
>```php
>$response = $baic->getToken();
>```
>响应示例：
>
>```json
>{
>    "success": "true",
>    "message": "获取成功！",
>    "token": "1252002bd3ff4a418b24b331cd28b0c4"
>}
>```
>|参数|参数类型|参数说明|
>|:---:|:---:|:---:|
>|success|String|是否校验成功:true成功;false不成功|
>|message|String|相应信息|
>|token|String|Token|

>### 2.获取Porder
>
>```php
>$data = [
>    'token' => '1252002bd3ff4a418b24b331cd28b0c4',  //获取的token
>    'sdkId' => $sdkId,                              //自己的sdkId
>    'orderAmount' => 10,                            //单位
>    'currencyType' => 'BAIC',                       //币种
>    'orderNo' => '12121212',                        //自己系统中的订单号
>];
>$response = $baic->getPorder($data);
>```
>响应示例：
>
>```json
>{
>    "success": "true",
>    "message": "請求成功！",
>    "porder": "yh4ea65gh41ae65t4pxm-123123-999-1534925308319-BAIC"
>}
>```

拿到porder后生成二维码，然后钱包APP扫码进行后续操作

>### 3.查询订单根据时间
>```php
>$data = [
>    'token' => '1252002bd3ff4a418b24b331cd28b0c4',      //token
>    'sdkId' => $sdkId,                                  //自己的sdkId
>    'beginTime' => '1534038254774',                     //开始时间
>    'endTime' => '1534239254774',                       //结束时间
>    'merchantId' => 'asdasdasdasdasd',                  //商户ID
>];
>$response = $baic->selectOrderByTime($data);
>```
>响应示例：
>
>```json
>{
>    "data": [
>        {
>            "currencyType": "USDT",
>            "orderAmount": 1,
>            "walletAccount": "216778721177910-0003",
>            "transactionNo": "1808143532200921700720",
>            "refundList": [
>                {
>                    "currencyType": "USDT",
>                    "transactionType": 1,
>                    "refundNo": "1808143551139775261736",
>                    "refundTime": 1535009861000,
>                    "operator": "李四",
>                    "refundAmount": 0.5,
>                    "isSuccess": 1
>                }
>            ],
>            "transactionTime": 1534235335000,
>            "verifyFailureReasons": null,
>            "isSuccess": 1
>        }
>    ],
>    "success": "true",
>    "message": "查詢成功!"
>}
>```
>|参数|参数类型|参数说明|
>|:---:|:---:|:---:|
>|currencyType|String|币种|
>|orderAmount|String|交易金额|
>|walletAccount|String|钱包账号|
>|transactionNo|String|交易号|
>|transactionTime|Date|交易时间|
>|verifyFailureReasons|String|参数校验失败原因|
>|isSuccess|Int|是否成功|
>|refundList的数据结构：|---|---|
>|refundAmount|BigDecimal|退款金额|
>|currencyType|String|币种|
>|isSuccess|Int|是否操作成功|
>|refundNo|String|退款流水号|
>|refundTime|Date|退款时间|
>|operator|String|操作人|
>|transactionType|Byte|交易类型:0:购买,1:退货|

>### 4.查询订单根据页数
>```php
>$data = [
>    'token' => '1252002bd3ff4a418b24b331cd28b0c4',      //token
>    'sdkId' => $sdkId,                                  //自己的sdkId
>    'limit' => 10,                                      //开始时间
>    'page' => 1,                                        //结束时间
>];
>$response = $baic->selectOrderByPage($data);
>```
>
>响应示例：
>```json
>{
>    "data": [
>        {
>            "currencyType": "BAIC",
>            "orderAmount": 30.432444,
>            "walletAccount": null,
>            "transactionNo": "1808223643283327367154",
>            "transactionTime": 1535008977000,
>            "verifyFailureReasons": null,
>            "isSuccess": null
>        }
>    ],
>    "success": "true",
>    "message": "查詢成功!"
>}
>```

>###5.查询订单根据交易号
>```php
>$data = [
>    'token' => '1252002bd3ff4a418b24b331cd28b0c4',      //token
>    'sdkId' => $sdkId,                                  //自己的sdkId
>    'transactionNo' => '1808223643283327367154',        //交易号
>];
>$response = $baic->selectByTransactionNo($data);
>```
>响应示例：
>```json
>{
>    "data": {
>        "currencyType": "BAIC",
>        "orderNo": "123e123r4312r1233",
>        "orderAmount": 30.432444,
>        "isRefund": false,
>        "walletAccount": null,
>        "transactionNo": "1808223643283327367154",
>        "transactionTime": 1535008977000,
>        "operator": "999",
>        "verifyFailureReasons": null,
>        "merchantName": "海灵顿",
>        "isSuccess": null,
>        "refundAmount": null
>    },
>    "success": "true",
>    "message": "查詢成功!"
>}
>```
>|参数|参数类型|参数说明|
>|:---:|:---:|:---:|
>|orderNo|String|订单号|
>|transactionNo|String|交易号|
>|transactionTime|Date|订单时间|
>|walletAccount|String|钱包账号|
>|orderAmount|BigDecimal|订单金额|
>|merchantName|String|商户名字|
>|currencyType|String|币种|
>|operator|String|操作人|
>|isSuccess|Byte|是否操作成功|
>|varifyFailureReasons|String|参数校验失败原因|
>|isRefund|boolean|是否退款|
>|refundAmount|BigDecimal|退款金额|


>###6.查询退款根据交易号
>```php
>$data = [
>    'token' => '1252002bd3ff4a418b24b331cd28b0c4',      //token
>    'sdkId' => $sdkId,                                  //自己的sdkId
>    'transactionNo' => '1808223225350327327962',        //交易号
>];
>$response = $baic->selectRefundByTransactionNo($data);
>```
>响应示例：
>```json
>{
>    "data": {
>        "currencyType": "BAIC",
>        "orderNo": "312312323",
>        "orderAmount": 1,
>        "isRefund": false,
>        "walletAccount": "218606395509603-0003",
>        "transactionNo": "1808223225350327327962",
>        "transactionTime": 1535008975000,
>        "operator": "0258b2a6-cfd6-4c46-8577-a3d922c83e00",
>        "verifyFailureReasons": null,
>        "merchantName": "全家",
>        "isSuccess": 1,
>        "refundAmount": null
>    },
>    "success": "true",
>    "message": "查詢成功!"
>}
>```

>###7.查询退款根据页数
>```php
>$data = [
>    'token' => '1252002bd3ff4a418b24b331cd28b0c4',      //token
>    'sdkId' => $sdkId,                                  //自己的sdkId
>    'limit' => 1,                                       //一页几个
>    'page' => 1,                                        //第几页
>];
>```
>响应示例：
>```json
>{
>    "data": [
>        {
>            "currencyType": "USDT",
>            "orderNo": "20180807095633656",
>            "refundNo": "1808141677440091440840",
>            "refundTime": 1535009861000,
>            "walletAccount": "216778721177910-0003",
>            "transactionNo": "1808073579226312821320",
>            "verifyFailureReasons": null,
>            "isSuccess": 1,
>            "refundAmount": 1
>        }
>    ],
>    "success": "true",
>    "message": "查詢成功!"
>}
>```

>###8.退款操作
>```php
>$data = [
>    'token' => '1252002bd3ff4a418b24b331cd28b0c4',      //token
>    'sdkId' => $sdkId,                                  //自己的sdkId
>    'merchantId' => 'asdasdasdasdasd',                  //商户ID
>    'transactionNo' => '1808223225350327327962',        //交易号
>];
>```
>响应示例：
>```json
>{
>    "isSuccess": 1,
>    "refundAmount": 1,
>    "currencyType": "BAIC",
>    "orderNO": "1212121212",
>    "success": "true",
>    "message": "查詢成功!"
>}
>```

## 参考
- [BAIC网关接口]

## License

MIT