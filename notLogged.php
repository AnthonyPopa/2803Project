<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Time</title>
    <script src="index.js"></script>
</head>
<body>
    <h1>Movie Time</h1>
    <h2>Welcome to Movie Time, a website to help you along your movie-watching journey!</h2>
    <h3>Login: </h3>
    <form method="post" action="">
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
    <p id="loginError"></p>

    <?php
        if (isset($_POST["username"])) {
            $connect = mysqli_connect("localhost", "root", null, "movietime");
            if (!$connect) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $name = $_POST["username"];
            $pass = $_POST["password"];

            $sql = "SELECT * FROM users WHERE username = '$name'";
            $result = mysqli_query($connect, $sql);

            $foundPass = "";
            while($row = mysqli_fetch_assoc($result)) {
                if ($row["username"] == $name) {
                    $foundPass = $row["password"];
                }
            }

            if ($foundPass == $pass && $pass != "") {
                session_start();
                $_SESSION["username"] = $name;
                session_write_close();
                header("Location: main.php");
            } else if ($foundPass == "") {
                echo "<script> showUsernameError(); </script>";
            } else {
                echo "<script> showPasswordError(); </script>";
            }
        }
    ?>

    <h3>New Here? </h3>
    <a href="register.php"><button>Click To Register!</button></a>
</body>
<script>
    alert("You must be logged in to do that!");
</script>
</html>