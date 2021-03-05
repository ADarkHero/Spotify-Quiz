var songs = [];



function startNewGame(){
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var gameSet = urlParams.get('set');

    //If no set was chosen, pick the default one
    if(gameSet == null || gameSet == ""){
        gameSet = "3PxuZFikwSYIhX0bDMwWrQ";
    }
    else{
        gameSet = gameSet.replace("https://open.spotify.com/playlist/", "");
        gameSet = gameSet.split('?')[0];
    }

    //Load set
    loadGameSet(gameSet);
}



/*
* Loads the set by id
*/
function loadGameSet(gameSet){
    var json = "";
    $.ajax({url: "spotifyApi.php?type=playlist&search="+gameSet, success: function(result){
        json = jQuery.parseJSON(result);
        json.items.forEach(element => {
            songs.push(element.track.id);
        });

        //Play first song
        nextSong();
    }});  
}



/*
* Plays next song
*/
function nextSong(){
    if(songs.length > 0){
        //Hide song info
        unrevealSong();

        //Choose a song randomly
        var randomSongNumber = Math.floor(Math.random() * songs.length);

        //Load song from Spotify
        loadSpotifySong(songs[randomSongNumber]);

        //Remove song from array
        songs.splice(randomSongNumber, 1);
    }   
    else{
        alert("All songs were already played. Please reload the page to play again!");
    }
}



/*
* Gets song info from the Spotify API
*/
function loadSpotifySong(songId){
    var json = "";
    $.ajax({url: "spotifyApi.php?type=song&search="+songId, success: function(result){
        json = jQuery.parseJSON(result);

        //If it exists, write it to the GUI
        //Support for multiple artists
        var artists = json.artists[0].name;
        for(var i = 1; i < json.artists.length; i++){
            artists = artists + " | " + json.artists[i].name;
        }

        $("#spotifyArtistName").html(artists);
        $("#spotifySongTitle").html(json.name);
        $("#spotifyAlbumName").html(json.album.name);
        $("#spotifyAlbumImage").attr("src", json.album.images[0].url);
        $("#spotifyAlbumImageLink").attr("href", json.album.external_urls.spotify);

        if(json.preview_url == null){
            //TODO: Somehow fix tracks with no previews, like "JUICE WRLD - Lucid Dreams"
            //Currently skips unplayable songs
            console.log(songId + " " + artists + " - " + json.name);
            nextSong();
        }
        else{
            document.getElementById("spotifyEmbedded").setAttribute('src', json.preview_url);
            document.getElementById('spotifyEmbedded').play();
        }
    }});     
}



/*
* Adds or removes points from a player
*/
function changeScore(playerId, identifier) {
    //Read from GUI
    var currentScoreStr = $("#"+playerId).val();
    var currentCoreInt = parseInt(currentScoreStr);
    var result = 0;

    //Add/Remove one point
    if(identifier == '+'){ result = currentCoreInt + 1; }
    else{ result = currentCoreInt - 1; }
    
    //Write to GUI
    $("#"+playerId).val(result);
}



/*
* Reveals song title and name
*/
function revealSong(){
    if($( "#songInfo" ).hasClass( "hideMe" )){
        $( "#songInfo" ).removeClass( "hideMe" );

        $("#revealSong").html('Unreveal song');

        $('body').css('background-size', 'unset');
    }
    else{
        unrevealSong();
    }
}



/*
* Hides song info again
*/
function unrevealSong(){
    if(!$( "#songInfo" ).hasClass( "hideMe" )){
        $( "#songInfo" ).addClass( "hideMe" );

        $("#revealSong").html('Reveal song');

        $('body').css('background-size', '0 0');
    }
}