<?php

namespace AllegroApi\Orders;

use AllegroApi\Auth\AllegroAuth;

class Orders extends AllegroAuth
{
    public static function checkoutForms($data = [], $simple = false)
    {

        if ($simple) {
            self::$curlUrl = "https://api.allegro.pl/order/checkout-forms/$id";
        } else {
            $data = http_build_query($data);
            self::$curlUrl = "https://api.allegro.pl/order/checkout-forms?$data";
        }
        $result = self::curlAllegro([
            'Authorization: Bearer ' . file_get_contents(__DIR__ . "../../Auth/Token/token.txt"),
            'Accept: application/vnd.allegro.beta.v1+json'
        ]);
        if (isset($result->error) && $result->error == 'invalid_token') {
            self::refreshToken(file_get_contents(__DIR__ . "../../Auth/Token/token.txt"));
            self::checkoutForms($data, $simple);
        }
        return $result;
    }
}
