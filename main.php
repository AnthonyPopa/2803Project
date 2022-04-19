<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1>Movie Time</h1>

    <table>
        <tr>
            <td><a href="searchMovie.php">Search</a></td>
            <td><a href="movieRecs.php">Top Movies</a></td>
            <td><a href="searchMovie.php">My Movies</a></td>
        </tr>
    </table>

    <form id="bar" action="searchMovie.php" method="post">
    Search: <input type="text" name="searchTerm"><br>
    <input type="submit">
    </form>
    <button onclick="location.href = 'movieRecs.php';">Popular Movies</button>
    <button onclick="location.href = 'accountList.php';">View Your Movies</button>
</body>
</html>