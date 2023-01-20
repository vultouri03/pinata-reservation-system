<?php
/** @var mysqli $db */
if (isset($_POST['submit'])) {
    require_once "includes/database.php";


//get form data
    $email = mysqli_escape_string($db, $_POST['email']);
    $username = mysqli_escape_string($db, $_POST['name']);
    $password = $_POST['password'];

// Server-side validation
    $errors = [];
    if ($username == '') {
        $errors['username'] = 'Please fill in your name.';
    }
    if ($email == '') {
        $errors['email'] = 'Please fill in your email.';
    }
    if ($password == '') {
        $errors['password'] = 'Please fill in your password.';
    }

    if (empty($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `admin_login`(`username`, `email`, `password`) VALUES ('$username','$email','$password')";
        $result = mysqli_query($db, $query);

        if ($result) {
            header('location: login.php');
            exit;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
<form action="" method="post">
    <div>
        <label for="email">email</label>
        <input type="text" name="email" id="email">
    </div>
    <span><?= $errors['email'] ?? '' ?></span>
    <div>
        <label for="name">username</label>
        <input type="text" name="name" id="name">
    </div>
    <span><?= $errors['username'] ?? '' ?></span>
    <div>
        <label for="password">password</label>
        <input type="text" name="password" id="password">
    </div>
    <span><?= $errors['password'] ?? '' ?></span>
    <div>
        <input type="submit" name="submit">
    </div>

</form>
</body>
</html>
