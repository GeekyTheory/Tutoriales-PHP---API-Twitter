<?php
function follow($usuario){
        ini_set('display_errors', 1);
        require_once('TwitterAPIExchange.php');
        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/ 
        $settings = array(
            'oauth_access_token' => "",
            'oauth_access_token_secret' => "",
            'consumer_key' => "",
            'consumer_secret' => ""
        );
        $url = 'https://api.twitter.com/1.1/friendships/create.json';
        // $url = 'https%3A%2F%2Fapi.twitter.com%2F1.1%2Fstatuses%2Fupdate.json';
        $requestMethod = 'POST';
        /** POST fields required by the URL above. See relevant docs as above **/
        $postfields = array( 'screen_name' => $usuario,'follow' => "true" );
        /** Perform a POST request and echo the response **/
        $twitter = new TwitterAPIExchange($settings);
        return $twitter->buildOauth($url, $requestMethod)->setPostfields($postfields)->performRequest();
}

//$mensaje = "Tutorial realizado con éxito en @GeekyTheory. #PHP + #Twitter: Cómo enviar tweets desde PHP |  http://geekytheory.com/php-twitter-como-enviar-tweets-desde-php"
//$mensaje = "Prueba del envío de tweets desde #PHP con la API de Twitter para el próximo tutorial en @GeekyTheory";
$respuesta = follow("geeksphone");
echo $respuesta;
//$respuesta = '{"created_at":"Sun May 25 22:01:53 +0000 2014","id":470686216393093120,"id_str":"470686216393093120","text":"Prueba del env\u00edo de tweets desde #PHP con la API de Twitter para el pr\u00f3ximo tutorial en @GeekyTheory","source":"\u003ca href=\"http:\/\/geekytheory.com\" rel=\"nofollow\"\u003eGeekyPHP\u003c\/a\u003e","truncated":false,"in_reply_to_status_id":null,"in_reply_to_status_id_str":null,"in_reply_to_user_id":null,"in_reply_to_user_id_str":null,"in_reply_to_screen_name":null,"user":{"id":309084573,"id_str":"309084573","name":"Alejandro Esquiva","screen_name":"Alex_Esquiva","location":"Bigastro","description":"Estudiante Ingenier\u00eda de Telecomunicaciones, Administrador y Redactor http:\/\/t.co\/jxmw2XoiJT, @geekytheory #arduino #raspberrypi #php #java #coding","url":"http:\/\/t.co\/KTr3NdjbKH","entities":{"url":{"urls":[{"url":"http:\/\/t.co\/KTr3NdjbKH","expanded_url":"http:\/\/about.me\/alejandro.esquiva","display_url":"about.me\/alejandro.esqu\u2026","indices":[0,22]}]},"description":{"urls":[{"url":"http:\/\/t.co\/jxmw2XoiJT","expanded_url":"http:\/\/geekytheory.com","display_url":"geekytheory.com","indices":[70,92]}]}},"protected":false,"followers_count":226,"friends_count":193,"listed_count":10,"created_at":"Wed Jun 01 14:14:13 +0000 2011","favourites_count":48,"utc_offset":-7200,"time_zone":"Greenland","geo_enabled":true,"verified":false,"statuses_count":1162,"lang":"es","contributors_enabled":false,"is_translator":false,"is_translation_enabled":false,"profile_background_color":"131516","profile_background_image_url":"http:\/\/pbs.twimg.com\/profile_background_images\/262404222\/Patterns_20110304_Flower-pattern.jpg","profile_background_image_url_https":"https:\/\/pbs.twimg.com\/profile_background_images\/262404222\/Patterns_20110304_Flower-pattern.jpg","profile_background_tile":true,"profile_image_url":"http:\/\/pbs.twimg.com\/profile_images\/378800000425513708\/cc332bd948f65a97f4da8810e5d7a91d_normal.jpeg","profile_image_url_https":"https:\/\/pbs.twimg.com\/profile_images\/378800000425513708\/cc332bd948f65a97f4da8810e5d7a91d_normal.jpeg","profile_banner_url":"https:\/\/pbs.twimg.com\/profile_banners\/309084573\/1378585307","profile_link_color":"009999","profile_sidebar_border_color":"EEEEEE","profile_sidebar_fill_color":"EFEFEF","profile_text_color":"333333","profile_use_background_image":true,"default_profile":false,"default_profile_image":false,"following":false,"follow_request_sent":false,"notifications":false},"geo":null,"coordinates":null,"place":null,"contributors":null,"retweet_count":0,"favorite_count":0,"entities":{"hashtags":[{"text":"PHP","indices":[33,37]}],"symbols":[],"urls":[],"user_mentions":[{"screen_name":"GeekyTheory","name":"GeekyTheory","id":821970349,"id_str":"821970349","indices":[88,100]}]},"favorited":false,"retweeted":false,"lang":"es"}';
$json = json_decode($respuesta);

echo '<meta charset="utf-8">';
echo "Usuario: ".$json->name." (@".$json->screen_name.")";
echo "<br>";
echo "ID USER: ".$json->id_str;
echo "<br>";
echo "Fecha Envio: ".$json->created_at;
?>
