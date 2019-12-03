<?php
namespace AllegroApi\AllegroRestApi;


class AllegroRestApi 
{
 
    protected static $clientId;
    protected static $clientSecret;
    protected static $redirectUrl;
    protected static $curlUrl;
    protected static $authorizationUri = 'https://ssl.allegro.pl/auth/oauth/authorize';
    protected static $tokenUri = 'https://ssl.allegro.pl/auth/oauth/token';
    protected static $header = ['Content-Type: application/x-www-form-urlencoded'];
    public static function setConnection(string $clientId, string $clientSecret, string $redirectUrl)
    {
        self::$header[] = 'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret);
        self::$clientId=$clientId;
        self::$clientSecret=$clientSecret;
        self::$redirectUrl = $redirectUrl;
    }
    protected static function curlAllegro(array $headerArray=[],array $postArray = [])
    {
        if(!empty($headerArray))
            self::$header= $headerArray;
      //   echo var_dump(self::$header);
        $curl =  curl_init(self::$curlUrl ?? self::$tokenUri);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, self::$header);
        if (is_null(self::$curlUrl)) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postArray));
        }
        $result = json_decode(curl_exec($curl));
       // echo var_dump($result);
        return $result;
    }
}

