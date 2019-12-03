<?php
namespace AllegroApi\App;
interface Auth{
    public static function getAuthUrl();
    public static function token(string $code, bool $refresh = true);
    public static function refreshToken($refresh);
    public static function saveData($result);
}