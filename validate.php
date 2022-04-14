<?php
    $connect = mysqli_connect("localhost", "root", null, "movietime");
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data["username"];
    $pass = $data["password"];

    $sql = "SELECT * FROM users WHERE username = '$name'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "name";
    } else if (strlen($pass) < 8) {
        echo "pass";
    } else {
        echo "ok";
    }
?>