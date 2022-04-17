<?php
    $connect = mysqli_connect("localhost", "root", null, "movietime");
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $data = json_decode(file_get_contents('php://input'), true);
    $name = strtolower($data["username"]);
    $pass = $data["password"];

    $sql = "SELECT * FROM users WHERE username = '$name'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Username is already taken.";
    } else if (strlen($name) < 6) {
        echo "Username must be at least 6 characters.";
    } else if (strlen($pass) < 8) {
        echo "Password must be at least 8 characters.";
    } else {
        echo "ok";
    }
?>