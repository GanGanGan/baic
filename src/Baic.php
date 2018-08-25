<?php

/*
 * This file is part of the gangangan/baic.
 *
 * (c) gangangan <gl@baic.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gangangan\Baic;

use GuzzleHttp\Client;
use Gangangan\Baic\Exceptions\HttpException;

/**
 * Class Baic.
 */
class Baic
{
    protected $apiPrefix = 'http://140.143.225.189/paygateway';
    protected $apiGetToken = '/sdk/getToken';                                           //获取Token
    protected $apiGetPorder = '/sdk/getPorder';                                         //获取Porder
    protected $apiSelectOrderByTime = '/sdk/selectOrderByTime';                         //时间区间订单查询
    protected $apiSelectOrderByPage = '/sdk/selectOrderByPage';                         //订单分页查询
    protected $apiSelectRefundByTransactionNo = '/sdk/selectRefundByTransactionNo';     //根据交易号退款查询
    protected $apiSelectByRefundRecordByPage = '/sdk/selectByRefundRecordByPage';       //退款订单分页查询

    /**
     * @var string
     */
    protected $sdkId;

    /**
     * @var string
     */
    protected $appKey;

    /**
     * @var array
     */
    protected $guzzleOptions = [];

    /**
     * Baic constructor.
     *
     * @param string $sdkId
     * @param string $appKey
     */
    public function __construct($sdkId, $appKey)
    {
        $this->sdkId = $sdkId;
        $this->appKey = $appKey;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    /**
     * @param array $options
     */
    public function setGuzzleOptions($options)
    {
        $this->guzzleOptions = $options;
    }

    /**
     * 获取Token
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Gangangan\Baic\Exceptions\HttpException
     */
    public function getToken()
    {
        $url = $this->apiPrefix . $this->apiGetToken;
        $options = [
            'connect_timeout' => 3,
            'query' => [
                'sdkId' => $this->sdkId,
                'appKey' => $this->appKey
            ],
        ];

        $this->setGuzzleOptions($options);
        try {
            $response = $this->getHttpClient()->get($url)->getBody()->getContents();
            return \json_decode($response, true);
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 获取Porder
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Gangangan\Baic\Exceptions\HttpException
     */
    public function getPorder($data)
    {
        $url = $this->apiPrefix . $this->apiGetPorder;
        return $this->doPostFormUrlEncoded($url, $data);
    }

    /**
     * 时间区间订单查询
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Gangangan\Baic\Exceptions\HttpException
     */
    public function selectOrderByTime($data)
    {
        $url = $this->apiPrefix . $this->apiSelectOrderByTime;
        return $this->doPostFormUrlEncoded($url, $data);
    }

    /**
     * 订单分页查询
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Gangangan\Baic\Exceptions\HttpException
     */
    public function selectOrderByPage($data)
    {
        $url = $this->apiPrefix . $this->apiSelectOrderByPage;
        return $this->doPostFormUrlEncoded($url, $data);
    }

    /**
     * 根据交易号退款查询
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Gangangan\Baic\Exceptions\HttpException
     */
    public function selectRefundByTransactionNo($data)
    {
        $url = $this->apiPrefix . $this->apiSelectRefundByTransactionNo;
        return $this->doPostFormUrlEncoded($url, $data);
    }

    /**
     * 退款订单分页查询
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Gangangan\Baic\Exceptions\HttpException
     */
    public function selectByRefundRecordByPage($data)
    {
        $url = $this->apiPrefix . $this->apiSelectByRefundRecordByPage;
        return $this->doPostFormUrlEncoded($url, $data);
    }

    /**
     * application/x-www-form-urlencoded POST请求
     * @param string $url
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Gangangan\Baic\Exceptions\HttpException
     */
    public function doPostFormUrlEncoded($url, $data)
    {
        $options = [
            'connect_timeout' => 3,
            'form_params' => $data
        ];
        $this->setGuzzleOptions($options);

        try {
            $response = $this->getHttpClient()->post($url)->getBody()->getContents();
            return \json_decode($response, true);
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}