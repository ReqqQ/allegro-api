<?php
require __DIR__.'/../../vendor/autoload.php';
use AllegroApi\AllegroRestApi\AllegroRestApi;
use AllegroApi\Orders\Orders;

Class Test{
    public static function AllegroTest(){
     
      AllegroRestApi::setConnection(
        "80d193300298438fb8f23df1511e9d58",
        "gMzlITPUJXkcu9uihhtRDfMWhHPh1NAJvr0U14DEBbBLXC3nMZwdEUmn5xzdqBBb",
        "http://192.168.1.49/allegro-api/src/Test/Test.php"
    );
    // AllegroRestApi::getAuthUrl
   // print_r("test");
      // if(empty($_GET['code'])){
      //  echo '<script>window.location.href="'.AllegroAuth::getAuthUrl().'"</script>';
      // } 
      // AllegroAuth::token($_GET['code']);
      $data=AllegroRestApi::checkoutForms(['limit' => "100", 'status' => "READY_FOR_PROCESSING"
      ]);
     var_dump($data);
    }
}
Test::AllegroTest();
?>