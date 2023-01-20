<?php
// standaard is er geen error
/** @var mysqli $db */
require_once "includes/database.php";

//Get the tags from the database with a SQL query
//$query = "SELECT * FROM tags";
//$result = mysqli_query($db, $query) or die ('Error: ' . $query);

//Loop through the result to create a custom array
//$tags = [];
//while ($row = mysqli_fetch_assoc($result)) {
    //$tags[] = $row;
//}

// check op Postback
if (isset($_POST['submit'])) {



    $name = mysqli_escape_string($db, $_POST['name']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $address = mysqli_escape_string($db, $_POST['address']);
    $pinata = mysqli_escape_string($db, $_POST['pinata']);
   // $tagIds = isset($_POST['tag-ids']) ? array_map(fn($value) => mysqli_escape_string($db, $value), $_POST['tag-ids']) : [];

    require_once "includes/form-validation.php";


    if (empty($errors)) {
        $userQuery = "INSERT INTO `orders`(`name`, `email`, `phone`, `address`) 
                    VALUES ('$name','$email','$phone','$address')";
        $userResult = mysqli_query($db, $userQuery) or die('Error: ' . mysqli_error($db) . ' with query ' . $userQuery);
        $userid = mysqli_insert_id($db);
        $query = "INSERT INTO `pinata_table` (`user_id`,`date`,`pinata`) VALUES ('$userid','$date', '$pinata')";
        $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);
        //$orderId = mysqli_insert_id($db);
        //add many to many relations to the db
        //foreach($tagIds as $tagId) {
          //  $query = "INSERT INTO order_tags (order_id, tag_id)
            //            VALUES ('$orderId', '$tagId')";
            //$result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);
        //}

        //Close connection
        mysqli_close($db);

        // Redirect to index.php
        header('Location: index.php');
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
    <title>maak een reservering</title>
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
            <textarea name="pinata" id="pinata" cols="22" rows="10"
                      placeholder="plaats hier hoe uw pinata er uit moet zien en of er speciale wensen, zoals alergieen meespelen die de inhoud van de pinata veranderen."></textarea>
        </div>
        <span><?= $errors['pinata'] ?? '' ?></span>
        <div class="control select is-multiple">
            <label class="label" for="tag-ids">Tags</label>
            <select id="tag-ids" name="tag-ids[]" multiple>
                //<?php // foreach ($tags as $tag) { ?>
                  //  <option value="<?php  //$tag['id'] ?>"><?php // $tag['name'] ?></option>

            </select>
        </div>
        <span>// $errors['tags'] ?? ''?></span>
        <input type="submit" name="submit" value="doorsturen">
    </form>
</section>
<p><a href="index.php">ga terug</a></p>
</body>
</html>