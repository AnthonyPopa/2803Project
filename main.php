<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Main Page</h1>
    <form action="searchMovie.php" method="post">
    Search: <input type="text" name="searchTerm"><br>
    <input type="submit">
    </form>
    <button onclick="location.href = 'movieRecs.php';">Popular Movies</button>
</body>
</html>