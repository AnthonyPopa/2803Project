<?php
//Pull api key from config
$config = parse_ini_file("config.ini");
$servername = $config['dbHost'];
$username = $config['dbUser'];
$password = $config['dbPass'];
$apiKey = $config['apiKey'];

// Setup url for seach
$imgUrl = 'https://image.tmdb.org/t/p/original';

//Get the current user (temporarily hardcoded to test user)
session_start();
if(!isset($_SESSION['username'])) {
  header("Location: notLogged.php");
  die();
}
$sessionUser = $_SESSION['username'];
 
function getData($id) {
    $config = parse_ini_file("config.ini");
    $apiKey = $config['apiKey'];
    $url = "https://api.themoviedb.org/3/movie/".$id."?api_key=".$apiKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    $jsn = json_decode($result,true);
    return($jsn);
}


//Set page header
echo "
<!DOCTYPE HTML>
<head>
<script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js></script>
<link rel='stylesheet' href='style.css'>
<title>Your Library</title>
</head>

<body>
    <div id='nav'>
        <h1>Movie Time</h1>

        <table>
            <tr>
                <td><a href='main.php'>Search</a></td>
                <td><a href='movieRecs.php'>Top Movies</a></td>
                <td><a href='accountList.php'>My Movies</a></td>
            </tr>
        </table>
    </div>

    <div class ='main'>";
//getData('test');


// Initialize and test sql connection
$conn = new mysqli($servername, $username, $password, 'movietime');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$qstring = 'SELECT * FROM '.$sessionUser.';';

$result = mysqli_query($conn,$qstring) or die(mysqli_error($conn));

while ($rows = mysqli_fetch_assoc($result)){
    $res = getData($rows['movie']);
    echo '<img src = "'.$imgUrl.$res["poster_path"].'" id = "'.strval($res["id"]).'">
    <p>'.$res['title'].'</p>
    ';
}

echo "</div></body>
";

?>