<?php
/**
 * Author: Alejandro Esquiva Rodríguez
 * Twitter:@alex_esquiva
 * Mail: alejandro@geekytheory.com
 */

function getJsonTweets($query,$num_tweets){
        ini_set('display_errors', 1);
        require_once('TwitterAPIExchange.php');
 
        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
       $settings = array(
            'oauth_access_token' => "",
            'oauth_access_token_secret' => "",
            'consumer_key' => "",
            'consumer_secret' => ""
        );
        
        if($num_tweets>100) $num_tweets = 100;
       
        $url = 'https://api.twitter.com/1.1/search/tweets.json';
        $getfield = '?q='.$query.'&count='.$num_tweets;
 
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        $json =  $twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();
        return $json;
}

function insertarTweetInfo(
        $id_tweet,
        $tweet,
        $rts,
        $favs,
        $fecha_creacion,
        $usuario,
        $url_imagen,
        $followers,
        $followings,
        $num_tweets
        ){
    
    //Creamos la conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "twitterdata");
    //Comprobamos laconexión
    if($conexion){
    }else{
           die('Ha sucedido un error inexperador en la conexion de la base de datos<br>');
    }
    //Codificación de la base de datos en utf8
    mysqli_query ($conexion,"SET NAMES 'utf8'");
    mysqli_set_charset($conexion, "utf8");
    
    //Creamos la sentencia SQL para insertar los datos de entrada
    $sql = "insert into tweets (id_tweet,tweet,rt,fav,fecha_creacion,usuario,url_imagen,followers,followings,num_tweets) 
            values (".$id_tweet.",'".$tweet."',".$rts.",".$favs.",'".$fecha_creacion."','".$usuario."','".$url_imagen."',".$followers.",".$followings.",".$num_tweets.");";
            $consulta = mysqli_query($conexion,$sql);
    //Comprobamos si la consulta ha tenido éxito
    if($consulta){
    }else{
           die("No se ha podido insertar en la base de datos<br><br>".mysqli_error($conexion));
    }
    
    //Cerramos la conexión de la base de datos
    $close = mysqli_close($conexion);
    if($close){
    }else{
        Die('Ha sucedido un error inexperado en la desconexion de la base de datos<br>');
    }	
}

//Obtenemos el JSON con la información
$json = getJsonTweets("GeekyTheory", 10);
//Codificamos el json
$json = json_decode($json);
//obtenemos un array con las filas, es decir con cada tweet.
$rows = $json->statuses;
//Iteramos los tweets, extraemos la información y la almacenamos en la base de datos.
for($i=0;$i<count($rows);$i++){
    $id_tweet = $rows[$i]->id_str;
    $tweet = $rows[$i]->text;
    $rts = $rows[$i]->retweet_count;
    $favs = $rows[$i]->favorite_count;
    $fecha_creacion = $rows[$i]->created_at;
    $usuario = $rows[0]->user->screen_name;
    $url_imagen = $rows[0]->user->profile_image_url;
    $followers = $rows[0]->user->followers_count;
    $following = $rows[0]->user->friends_count;
    $num_tweets = $rows[0]->user->statuses_count;
    
    //insertamos los datos en la base de datos
    insertarTweetInfo($id_tweet, $tweet, $rts, $favs, $fecha_creacion, $usuario, $url_imagen, $followers, $followings, $num_tweets);
}