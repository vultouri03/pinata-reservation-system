<?php
session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: index.php');
    exit;
}

$name = $_SESSION['loggedInUser']['name'];
/** @var mysqli $db */


require_once 'includes/database.php';

//If the ID isn't given, redirect to the homepage
if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: admin.php');
    exit;
}

$id = $_GET['id'];

// check op Postback
if (isset($_POST['submit'])) {
    require_once "includes/database.php";

    $name = mysqli_escape_string($db, $_POST['name']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $address = mysqli_escape_string($db, $_POST['address']);
    $pinata = mysqli_escape_string($db, $_POST['pinata']);
    require_once "includes/update-validation.php";

    if (empty($errors)) {
        $userQuery = "UPDATE `orders` SET `name`='$name',`email`='$email',`phone`='$phone',`address`='$address' WHERE id ='$id'";
        $userResult = mysqli_query($db, $userQuery) or die('Error: ' . mysqli_error($db) . ' with query ' . $userQuery);
        $userid = mysqli_insert_id($db);
        $query = "UPDATE `pinata_table` SET `date`='$date', `pinata`='$pinata' WHERE `user_id` ='$id'";
        $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);


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
    <title>change files</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
<section>
<form action="" method="post">
    <div class="textform">
        <label for="name">Naam:</label>
        <input type="text" name="name" id="name">
    </div>
    <span><?= $errors['name'] ?? '' ?></span>
    <div class="textform">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
    </div>
    <span><?= $errors['email'] ?? '' ?></span>
    <div class="textform">
        <label for="phone">Telefoon nummer:</label>
        <input type="tel" id="phone" name="phone">
    </div>
    <span><?= $errors['phone'] ?? '' ?></span>
    <div class="textform">
        <label for="date">Datum:</label>
        <input type="date" name="date" id="date">
    </div>
    <span><?= $errors['date'] ?? '' ?></span>
    <div class="textform">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address">
    </div>
    <span><?= $errors['address'] ?? '' ?></span>
    <div class="textform">
        <label for="pinata">Eisen voor uw Pinata</label>
        <textarea name="pinata" id="pinata" cols="28" rows="10"
                  placeholder="plaats hier hoe uw pinata er uit moet zien en of er speciale wensen, zoals alergieen meespelen die de inhoud van de pinata veranderen."></textarea>
    </div>
    <span><?= $errors['pinata'] ?? '' ?></span>
    <input type="submit" name="submit" value="doorsturen">
</form>
</section>
<p><a href="admin.php">ga terug</a></p>
</body>
</html>
