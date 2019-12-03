<?php

namespace AllegroApi\Auth;

use AllegroApi\AllegroRestApi\AllegroRestApi;

class AllegroAuth extends AllegroRestApi 
{

    /**
     * Returns Url to Auth.
     *
     * @return string Url to allegro
     */
    public static function getAuthUrl()
    {
        return self::$authorizationUri . '?' . http_build_query([
            'response_type' => 'code',
            'client_id' => self::$clientId,
            'redirect_uri' => self::$redirectUrl
        ]);
    }
    /**
     * Get token from allegro
     *
     * @param string $code String of characters from function getAuthUrl
     * @return array Data from allegro
     */
    public static function token(string $code, bool $refresh = true)
    {
        $result = self::curlAllegro([
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => self::$redirectUrl
        ]);

        ($refresh) ? self::refreshToken($result->refresh_token) : self::saveData($result);
    }
    protected static function refreshToken($refresh)
    {
        $data = http_build_query(array('grant_type' => 'refresh_token', 'refresh_token' => $refresh));
        self::$curlUrl = "https://allegro.pl/auth/oauth/token?$data";
        self::saveData(self::curlAllegro());
    }
    private static function saveData($result)
    {
        file_put_contents(__DIR__ . "/Token/token.txt", $result->access_token);
        file_put_contents(__DIR__ . "/Token/refresh.txt", $result->refresh_token);
    }
}
