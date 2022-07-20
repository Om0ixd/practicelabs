<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Шукати фільми за жанром</title>
    <meta charset="utf-8">
</head>
<body>
<?php
    $db_driver="mysql"; $host = "localhost"; $database = "films";
    $dsn = "$db_driver:host=$host; dbname=$database";
    $username = "root"; $password = "";

    try {
    $dbh = new PDO ($dsn, $username, $password);
    echo "Виберіть жанр за яким хочете шукати фільми:<br><br>";
    $sql = "SELECT * FROM `genre`";
    $response = $dbh->query($sql);
    echo '<form  method="post" action="filmsByGenre.php">
    <select name="genreId">';
    foreach ($response as $row) {
       echo "<option value='$row[0]'>$row[1]</option>";
    }
    echo '</select>
    <div><button type="submit">Пошук</button></div>
    <form/>';
    }
    catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>"; die();
    }

?>

</body>
</html>

