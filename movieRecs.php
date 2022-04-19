<?php
//Pull api key from config
$config = parse_ini_file("config.ini");
$servername = $config['dbHost'];
$username = $config['dbUser'];
$password = $config['dbPass'];
$apiKey = $config['apiKey'];

// Setup url for seach
$imgUrl = 'https://image.tmdb.org/t/p/original';
$url = 'https://api.themoviedb.org/3/discover/movie?api_key='.$apiKey.'&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&with_watch_monetization_types=flatrate';

//Get the current user (temporarily hardcoded to test user)
session_start();
if(!isset($_SESSION['username'])) {
  header("Location: notLogged.php");
  die();
}
$sesionUser = $_SESSION['username'];
 


// Curl url generated above and store results
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
$jsn = json_decode($result,true);
$res = $jsn['results'];

$num = min(count($res),10);

//Set page header
echo "
<!DOCTYPE HTML>
<head>
<script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js></script>
<title>Search Results</title>
<style>
img {
  max-width: 100px;
 }
</style>
</head>
";

// Echo posters from first 10 results with id of the movie id
for ($i = 0; $i < $num; $i ++) {
  echo '<img src = "'.$imgUrl.$res[$i]["poster_path"].'" id = "'.strval($res[$i]["id"]).'">
  <caption>'.$res[$i]['title'].'</caption>
  ';
}


// Echo javascript functions needed to modify database
echo "<script>
const config = {
  user: '".$username."',
  password: '".$password."',
  server: '".$servername."',
  database: 'movie'
};
function addMovie(username,movieID) {
  $.ajax({
    url:'addMovie.php',
    type:'POST',

    data:{
      id: movieID,
      user: username,
    },
    cache: false,
    success: function(data, status, error) {
      alert(data);
    },
    error: function(xhr, status, error) {
    console.error(xhr);
    }
})
}";


// Add event listeners to each movie poster
for ($i = 0; $i < $num; $i ++) {
  echo "
  document.getElementById('".strval($res[$i]["id"])."').addEventListener('click', function(){
  addMovie('".$sesionUser."','".strval($res[$i]["id"])."')});";
     
}

echo '</script>';




?>