<?php

namespace Sparkinzy\KwaishopSdk;

use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    private $appKey;
    private $appSecret;
    private $signSecret;
    private $version    = 1;
    private $signMethod = 'MD5';

    const URL = 'https://open.kwaixiaodian.com';

    public $access_token;

    public function __construct(string $appKey, string $secret, string $signSecret)
    {
        $this->appKey     = $appKey;
        $this->appSecret  = $secret;
        $this->signSecret = $signSecret;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token): void
    {
        $this->access_token = $access_token;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * 签名
     * @param array $params
     */
    public function signature(array $params)
    {
        ksort($params);
        $params['signSecret'] = $this->signSecret;
        $waitSign             = [];
        foreach ($params as $key => $item) {
            if (is_array($item)) {
                $waitSign[] = $key . '=' . json_encode($item, JSON_UNESCAPED_UNICODE);
            } else {
                $waitSign[] = $key . '=' . $item;
            }
        }
        return strtolower(md5(implode('&', $waitSign)));

    }

    public function request(string $method, array $param = [], string $request_method = 'GET')
    {
        $params = [
            'appkey'       => $this->appKey,
            'timestamp'    => time() * 1000,
            'signMethod'   => $this->signMethod,
            'version'      => $this->version,
            'method'       => $method,
            'access_token' => $this->access_token,
        ];
        if (!empty($param)) {
            $params['param'] = json_encode($param, JSON_UNESCAPED_UNICODE);
        }
        $params['sign'] = $this->signature($params);
        $http           = $this->getHttp();
        $method_uri     = '/' . str_replace('.', '/', $method);
        if ($request_method && strtoupper($request_method) === 'GET') {
            $response = $http->get(self::URL . $method_uri, $params);
        } else {
            $response = $http->post(self::URL . $method_uri, $params);
        }
        return json_decode(strval($response->getBody()), true);
    }

    public function __call($name, $arguments)
    {
        return $this->{$name}(...$arguments);
    }

}