<?php

namespace AllegroApi\Auth;

use AllegroApi\Allegro;

class AllegroAuth extends Allegro
{
    private static $curlUrl;
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
        $result = self::curlAllegro("POST", [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => self::$redirectUrl
        ]);

        ($refresh) ? self::refreshToken($result->refresh_token) : self::saveData($result);
    }

    private static function refreshToken($refresh)
    {
        $data = http_build_query(array('grant_type' => 'refresh_token', 'refresh_token' => $refresh));
        self::$curlUrl = "https://allegro.pl/auth/oauth/token?$data";
        self::saveData(self::curlAllegro());
    }
    private static function curlAllegro(string $type = 'GET', array $customArray = [])
    {
        $curl =  curl_init(self::$curlUrl ?? self::$tokenUri);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, self::$header);
        if (is_null(self::$curlUrl)) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($customArray));
        }
        $result = json_decode(curl_exec($curl));
        return $result;
    }
    private static function saveData($result)
    {
        file_put_contents(__DIR__ . "/Token/token.txt", $result->access_token);
        file_put_contents(__DIR__ . "/Token/refresh.txt", $result->refresh_token);
    }
}
