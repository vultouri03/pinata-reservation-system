<?php
session_start();

$login = false;
if (isset($_SESSION['loggedInUser'])) {
    $login = true;
}

if (isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "includes/database.php";

    //get form data
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];

    //server side validation
    $errors = [];
    if ($email == '') {
        $errors['email'] = 'Please fill in your email.';
    }
    if ($password == '') {
        $errors['password'] = 'Please fill in your password.';
    }

    if (empty($errors)) {
        $query = "SELECT * FROM admin_login WHERE email='$email'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $login = true;

                $_SESSION['loggedInUser'] = [
                    'id' => $user['id'],
                    'name' => $user['username'],
                    'email' => $user['email'],
                ];
            } else {
                $errors['loginFailed'] = 'the username and password combination does not exist in the system.';
            }
        } else {
            $errors['loginFailed'] = 'the username and password combination does not exist in the system.';
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
<div>
    <?php if ($login) {?>
    <p>je bent ingelogd</p>
    <p><a href="logout.php">uitloggen</a> <a href="admin.php">naar admin site</a> <a href="index.php">back to home</a></p>
    <?php } else { ?>
</div>
<section>
<form action="" method="post">
    <div class="textform">
        <label for="email">email</label>
        <input type="text" name="email" id="email">
    </div>
    <span><?= $errors['email'] ?? '' ?></span>
    <div class="textform">
        <label for="password">password</label>
        <input type="text" name="password" id="password">
    </div>
    <span><?= $errors['password'] ?? '' ?></span>

        <span><?=$errors['loginFailed'] ?? ''?></span>
    <div class="textform">
        <input type="submit" name="submit">
    </div>

</form>
<?php } ?>
    <a href="index.php">back to home</a>
</section>
</body>
</html>
