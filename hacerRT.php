<?php
function doRT($id_tweet){
        ini_set('display_errors', 1);
        require_once('TwitterAPIExchange.php');
        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/ 
        $settings = array(
            'oauth_access_token' => "",
            'oauth_access_token_secret' => "",
            'consumer_key' => "",
            'consumer_secret' => ""
        );
        $url = 'https://api.twitter.com/1.1/statuses/retweet/'.$id_tweet.'.json';
        // $url = 'https%3A%2F%2Fapi.twitter.com%2F1.1%2Fstatuses%2Fupdate.json';
        $requestMethod = 'POST';
        /** POST fields required by the URL above. See relevant docs as above **/
        $postfields = array( '' => '','' => "" );
        /** Perform a POST request and echo the response **/
        $twitter = new TwitterAPIExchange($settings);
        return $twitter->buildOauth($url, $requestMethod)->setPostfields($postfields)->performRequest();
}

doRT("470880387716378624");