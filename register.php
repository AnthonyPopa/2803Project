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
        <input type="submit" value="Register">
    </form>
    <p id="error"></p>
    <p id="OK"></p>
    <script>
        document.getElementById("username").addEventListener("input", query);
        document.getElementById("password").addEventListener("input", query);
        document.getElementById("error").style.color = "red";
        document.getElementById("OK").style.color = "green";
    </script>

    <?php
        $config = parse_ini_file("config.ini");
        $servername = $config['dbHost'];
        $username = $config['dbUser'];
        $password = $config['dbPass'];
        if (isset($_POST["username"])) {
            $connect = mysqli_connect($servername, $username, $password, "movietime");
            if (!$connect) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $name = strtolower($_POST["username"]);
            $pass = password_hash($_POST["password"], PASSWORD_BCRYPT);

            $sql = "SELECT * FROM users WHERE username = '$name'";
            $result = mysqli_query($connect, $sql);

            if (mysqli_num_rows($result) == 0 && strlen($_POST["password"]) >= 8 && strlen($name) >= 6) {
                $sql = "INSERT INTO users (username, password)
                VALUES ('$name', '$pass')";
                if (!mysqli_query($connect, $sql)) {
                    die("Failed to add new user: " . mysqli_error($connect));
                }
                $sql = "CREATE TABLE $name (movie VARCHAR(20), watched BIT)";
                if (!mysqli_query($connect, $sql)) {
                    die("Failed to create new table for user");
                }
                session_start();
                $_SESSION["username"] = $name;
                session_write_close();
                header("Location: main.php");
            }
        }
    ?>
</body>
</html>