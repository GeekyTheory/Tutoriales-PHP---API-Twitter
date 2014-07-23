<?php
function unfollow($usuario){
        ini_set('display_errors', 1);
        require_once('TwitterAPIExchange.php');
        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/ 
        $settings = array(
            'oauth_access_token' => "",
            'oauth_access_token_secret' => "",
            'consumer_key' => "",
            'consumer_secret' => ""
        );
        $url = 'https://api.twitter.com/1.1/friendships/destroy.json';
        // $url = 'https%3A%2F%2Fapi.twitter.com%2F1.1%2Fstatuses%2Fupdate.json';
        $requestMethod = 'POST';
        /** POST fields required by the URL above. See relevant docs as above **/
        $postfields = array( 'screen_name' => $usuario, );
        /** Perform a POST request and echo the response **/
        $twitter = new TwitterAPIExchange($settings);
        return $twitter->buildOauth($url, $requestMethod)->setPostfields($postfields)->performRequest();
}

//$mensaje = "Tutorial realizado con éxito en @GeekyTheory. #PHP + #Twitter: Cómo enviar tweets desde PHP |  http://geekytheory.com/php-twitter-como-enviar-tweets-desde-php"
//$mensaje = "Prueba del envío de tweets desde #PHP con la API de Twitter para el próximo tutorial en @GeekyTheory";
$respuesta = unfollow("geeksphone");