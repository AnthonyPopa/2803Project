<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="register.js"></script>
</head>
<body>
    <h3>Enter a username and password below:</h3>
    <form id="form" method="post" action="">
        <div>
            <label for="username">Username: </label>
            <input id="username" name="username" type="text">
        </div>
        <div>
            <label for="password">Password: </label>
            <input id="password" name="password" type="password">
        </div>
        <input type="submit">
    </form>
    <p id="registerError"></p>

</body>
</html>