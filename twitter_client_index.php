<?php

require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
#Also known as API KEY
$consumerkey = "NHPIF4PbdTseGiPQOG8v40XIC";

#Also known as API SECRET KEY
$consumersecret = "2BUaTeXsXc5FVpjRv9H675ixMhnCs94fmqp1ADOjNGbB4tUgM2";



$accesstoken = "1466027932355563520-hbOxed8StdUk6Mnl84U1zuK02wnMTH";

$accesstokensecret = "qF6Yh9ePx4YGfuTuNrjJVrt50Wc6uVyr8J3zwZ7FRpm6e";

$connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
$content = $connection->get("account/verify_credentials");

#$statues = $connection->post("statuses/update", ["status" => "5, This came from my twitter app!"]);

$statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);

foreach($statuses as $tweet){
    if($tweet-> favorite_count >= 2){
        $status = $connection->get("statuses/oembed", ["id" => $tweet ->id]);
        echo $status-> html;
 
}
}
?>