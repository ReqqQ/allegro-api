<?php 

namespace AllegroApi\App;

interface User{
    public static function curlAllegro(array $headerArray=[],array $postArray = []);
    public static function setConnection(string $clientId, string $clientSecret, string $redirectUrl);
}