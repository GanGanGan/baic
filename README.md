
<h1 align="center">Baic</h1>

<p align="center">基于Baic网关的 PHP 简单组件。</p>

## 安装

```sh
$ composer require gangangan/baic -vvv
```
## 配置

在使用本扩展之前，你需要去 [BAIC商户后台] 注册账号，然后创建应用，获取应用的 API Id与Key。

## 使用

```php
use Gangangan\Baic\Baic;

$sdkId = 'Your sdkId';
$appKey = 'Your appKey';

$baic = new Baic($sdkId, $key);
```

###  获取Token

```php
$response = $baic->getToken();
```
示例：

```json
{
    "success": "true",
    "message": "获取成功！",
    "token": "1252002bd3ff4a418b24b331cd28b0c4"
}
```

### 获取Porder

```
$data = [
    'token' => '1252002bd3ff4a418b24b331cd28b0c4',  //获取的token
    'sdkId' => $sdkId,                              //自己的sdkId
    'orderAmount' => 10,                            //单位
    'currencyType' => 'BAIC',                       //币种
    'orderNo' => '12121212',                        //自己系统中的订单号
];
$response = $baic->getPorder($data);
```
示例：

```json
{
    "success": "true",
    "message": "請求成功！",
    "porder": "yh4ea65gh41ae65t4pxm-123123-999-1534925308319-BAIC"
}
```

拿到porder后生成二维码，然后钱包APP扫码进行后续操作

## 参考
- [BAIC网关接口]

## License

MIT