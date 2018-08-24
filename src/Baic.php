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
    protected $apiGetToken = '/sdk/getToken';
    protected $apiGetPorder = '/sdk/getPorder';

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
     * Weather constructor.
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
     * @return \Psr\Http\Message\ResponseInterface
     *
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
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Gangangan\Baic\Exceptions\HttpException
     */
    public function getPorder($data)
    {
        $url = $this->apiPrefix . $this->apiGetPorder;
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