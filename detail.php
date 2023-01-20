<?php
session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: index.php');
    exit;
}

$name = $_SESSION['loggedInUser']['name'];
//Require database in this file
/** @var $db */
require_once "includes/database.php";

//If the ID isn't given, redirect to the homepage
if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: admin.php');
    exit;
}

//Retrieve the GET parameter from the 'Super global'
$pinataId = $_GET['id'];

//Get the record from the database result
$query = "SELECT orders.*, pinata_table.date ,pinata_table.pinata FROM orders 
LEFT JOIN pinata_table ON orders.id = pinata_table.user_id 
WHERE orders.id = " . $pinataId;

$result = mysqli_query($db, $query);

//If the order doesn't exist, redirect back to the homepage
if (mysqli_num_rows($result) == 0) {
    header('Location: admin.php');
    exit;
}

//Transform the row in the DB table to a PHP array
$users = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Reserveringen Details</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="">
</head>
<body>
<ul>
    <li><?= htmlentities($users['name']) ?></li>
    <li><?= htmlentities($users['email']) ?></li>
    <li><?= htmlentities($users['phone']) ?></li>
    <li><?= htmlentities($users['address']) ?></li>
    <li><?= htmlentities($users['date']) ?></li>
    <li><?= htmlentities($users['pinata']) ?></li>
    <li><a href="update.php?id=<?= $users['id']; ?>">update</a></li>
</ul>
<a href="admin.php">back to the main page</a>
</body>
</html>