<?php

namespace Sparkinzy\KwaishopSdk;

use GuzzleHttp\Client;
use Hanson\Foundation\Foundation;
use http\Client\Request;

/**
 *
 * Class Kwaishop
 * @package Sparkinzy\KwaishopSdk
 */
class Kwaishop extends Foundation
{


    public $item;
    public $user;

    protected $config;
    /**
     * 授权跳转链接
     * @var string
     */
    private $authorize_url = 'https://s.kwaixiaodian.com/oauth/authorize';
    /**
     * 获取token refreshToken
     * @var string
     */
    private $token_url = 'https://s.kwaixiaodian.com/oauth2/access_token';
    /**
     * 刷新授权地址
     * @var string
     */
    private $refresh_token_url = 'https://s.kwaixiaodian.com/oauth2/refresh_token';

    public function __construct($config)
    {
        parent::__construct($config);

        $this->config = $config;
        $this->item   = new Item($config['app_key'], $config['app_secret'], $config['sign_secret']);
        $this->user   = new User($config['app_key'], $config['app_secret'], $config['sign_secret']);
        $this->user->setAccessToken($config['access_token']);
        $this->item->setAccessToken($config['access_token']);
    }

    /**
     * 自动跳转到授权页面
     */
    public function authorize()
    {
        $url = $this->authorize_url . '?' . http_build_query([
                'appId'         => $this->config['app_key'],
                'response_type' => 'code',
                'scope'         => 'user_info,merchant_user,merchant_logistics,merchant_item',
                'redirect_uri'  => $this->config['redirect_uri'],
                'state'         => $this->config['state'],
            ]);
        header('location:' . $url);
    }

    /**
     * 获取授权信息
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function token()
    {
        $client  = new Client();
        $options = [
            'app_id'     => $this->config['app_key'],
            'grant_type' => 'code',
            'code'       => $_GET['code'],
            'app_secret' => $this->config['app_secret']

        ];
        $rs      = $client->get($this->token_url, [
            'query'=>$options,
        ]);
        return json_decode(strval($rs->getBody()), true);
    }

    /**
     * 刷新授权
     * @param string $refresh_token
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function refresh_token(string $refresh_token)
    {
        $client  = new Client();
        $options = [
            'app_id'        => $this->config['app_id'],
            'grant_type'    => 'refresh_token',
            'app_secret'    => $this->config['app_secret'],
            'refresh_token' => $refresh_token,
        ];
        $rs      = $client->post($this->refresh_token_url, [
            'form_params'=>$options
        ]);
        return json_decode(strval($rs->getBody()), true);


    }


    public function __call($name, $arguments)
    {
        return $this->{$name};
    }


}