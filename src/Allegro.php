<?php
namespace AllegroApi;
class Allegro
{
    protected static $clientId;
    protected static $clientSecret;
    protected static $redirectUrl;
    protected static $authorizationUri = 'https://ssl.allegro.pl/auth/oauth/authorize';
    protected static $tokenUri = 'https://ssl.allegro.pl/auth/oauth/token';
    public static $header = ['Content-Type: application/x-www-form-urlencoded'];
    public static function setConnection(string $clientId, string $clientSecret, string $redirectUrl)
    {
        self::$header[] = 'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret);
        self::$redirectUrl = $redirectUrl;
    }
    public static function getAuthorizationUri()
    {
        return self::$AuthorizationUri . '?' . http_build_query([
            'response_type' => 'code',
            'client_id' => self::$ClientId,
            'redirect_uri' => self::$RedirectUri
        ]);
    }
}

