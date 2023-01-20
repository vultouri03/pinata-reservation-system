<?php
session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: index.php');
    exit;
}

$name = $_SESSION['loggedInUser']['name'];

/** @var mysqli $db */
require_once "includes/database.php";

//get results form the database
//$query = "SELECT pinata_table.* ,tags.name as tags FROM pinata_table
//LEFT JOIN order_tags ON pinata_table.id = order_tags.order_id
//LEFT JOIN tags ON order_tags.tag_id	= tags.id";

$query = "select * from pinata_table";

$result = mysqli_query($db, $query)
or die('Error: ' . mysqli_connect_error());

$reserveringen = [];


while ($row = mysqli_fetch_assoc($result)) {
    $reserveringen[] = $row;
}
mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<nav>
    <a href="login.php">logout</a>
    <a href="delete.php">reservering verwijderen</a>
</nav>
<table class="overviewTable">
    <thead>
    <tr>
        <th>user id</th>
        <th>date</th>
        <th>pinata info</th>
        <th>tags</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($reserveringen as $product): ?>

        <tr>
            <td><?= $product['user_id'] ?></td>
            <td><?= htmlentities($product['date']) ?></td>
            <td><?= htmlentities($product['pinata']) ?></td>
    <td>//htmlentities($product['tags']) ?></td>
            <td><a href="detail.php?id=<?= $product['user_id']; ?>">Details</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
