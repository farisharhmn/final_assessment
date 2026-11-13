<?php
session_start();

include "db.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // add your login logic here
    if (empty($username) || empty($password)) {
        // id($username = "" || $password = "") {) {
        $error = "Please fill in all the fields.";
    } else {

        $sql = $conn->prepare("SELECT * FROM users WHERE username = '$username'");

        $sql->execute();

        $user = $sql->get_result()->fetch_assoc();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid username or password.";
        }

    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body>
    <?php
    if (!empty($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <h1>Student Grading System - Login</h1>

    <h2>Login</h2>

    <form method="POST">
        <lable>Username</lable>
        <input type="text" name="username"><br><br>
        <label>Password</label>
        <input type="text" name="password"><br><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>