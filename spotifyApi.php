<?php

require_once('config.php');

$type = "song";
$authorization = "Authorization: Bearer ".getAccessToken($client_id, $client_secret);

if(isset($_GET["type"])){
    $type = $_GET["type"];
}

if($type == "playlist"){
    $spotifyURL = 'https://api.spotify.com/v1/playlists/' . $_GET["search"] . '/tracks?offset=0&limit=100&market=DE'; 
}
else if($type == "song"){
    $spotifyURL = 'https://api.spotify.com/v1/tracks/' . $_GET["search"];  
}

$spotifyJson = makeSpotifyCall($spotifyURL, $authorization);

//echo($spotifyURL);
echo($spotifyJson);



/*
 * Generates a spotify access token
 * Thanks/Credits to ahallora on GitHub
 */
function getAccessToken($client_id, $client_secret){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token' );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($ch, CURLOPT_POST,           1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' ); 
    curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 

    $result=curl_exec($ch);

    $token = json_decode($result, true);
    return $token['access_token'];
}



/*
 * Calls the spotify api and return a decoded json array
 */
function makeSpotifyCall($spotifyURL, $authorization){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $spotifyURL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $json = curl_exec($ch);
    curl_close($ch);
    return $json;
}
