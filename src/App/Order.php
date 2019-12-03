<?php
namespace AllegroApi\App;
interface Order {
    public static function checkoutForms($data = [], $simple = false);
}