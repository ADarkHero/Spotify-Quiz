<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Spotify Song Guessing Game</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">

    

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css\cover.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">Spotify song guessing game</h3>
    </div>
  </header>

  <main class="px-3">
    <h1>Create a new game:</h1>
    <form action="game.php" method="get">
      <div class="mb-3">
        <label for="spotifyLink" class="form-label">Spotify playlist link</label>
        <input type="text" class="form-control" id="spotifyLink" name="set" placeholder="https://open.spotify.com/playlist/3PxuZFikwSYIhX0bDMwWrQ?si=1a4c1ba439e1422a">
      </div>
      <div class="mb-3">
        <label for="numberOfPlayers" class="form-label">Number of players</label>
        <input type="number" class="form-control" name="players" id="numberOfPlayers" placeholder="3">
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3">Start game</button>
      </div>
    </form>
  </main>

  <footer class="mt-auto text-white-50">
    <p>Made by <a href="https://www.adarkhero.de" class="text-white">ADarkHero</a></p>
  </footer>
</div>


    
  </body>
</html>
