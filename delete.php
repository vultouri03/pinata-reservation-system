<?php
session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: index.php');
    exit;
}

$name = $_SESSION['loggedInUser']['name'];

// check op Postback
if (isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "includes/database.php";

    $email = mysqli_escape_string($db, $_POST['email']);
    $phone = $_POST['phone'];
    $id = $_POST['id'];

    require_once "includes/delete-validation.php";

    if (empty($errors)) {


        $deleteMain = "DELETE FROM `pinata_table` WHERE user_id = '$id' ";

        $query = "DELETE FROM `orders` WHERE id ='$id'";
        $result = mysqli_query($db, $deleteMain) or die('Error: ' . mysqli_error($db) . ' with query ' . $deleteMain);
        $userResult = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);




        //Close connection
        mysqli_close($db);

        // Redirect to index.php
        header('Location: admin.php');
        exit;
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
    <title>Delete a file</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
<section>
<form action="" method="post">
    <div class="textform">
        <label for="email">vul uw email adderess in</label>
        <input type="email" id="email" name="email">
    </div>
    <?= $errors['email'] ?? '' ?>
    <div class="textform">
        <label for="phone">vul uw telefoonnummer in</label>
        <input type="text" name="phone" id="phone">
    </div>
    <?= $errors['phone'] ?? '' ?>
    <div class="textform">
        <label for="id">vul uw user id in</label>
        <input type="text" name="id" id="id">
    </div>
    <?= $errors['id'] ?? '' ?>
    <div>
        <input type="submit" id="submit" name="submit" value="submit">
    </div>
    <a href="admin.php">back to the main page</a>
</form>
</section>
</body>
</html>
