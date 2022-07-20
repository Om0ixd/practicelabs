<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Шукати фільми за актором</title>
    <meta charset="utf-8">
</head>
<script>
     async function searchByActor(e) {
         let url = "/sem2lb3/filmsByActor.php";
         var value = document.getElementById("actorId").value;

         let request = {
             method:"POST",
             headers : {"Content-type":"application/x-www-form-urlencoded"},
             body: 'actorId=' + encodeURIComponent(value)
         }
         let response = await fetch(url, request);
         let text = await response.text();
         let select = document.getElementById('content');
         select.innerHTML = text;
      }
</script>
<body>
<?php
    $db_driver="mysql"; $host = "localhost"; $database = "films";
    $dsn = "$db_driver:host=$host; dbname=$database";
    $username = "root"; $password = "";

    try {
    $dbh = new PDO ($dsn, $username, $password);
    echo "Виберіть актора за яким хочете шукати фільми:<br><br>";
    $sql = "SELECT * FROM `actor`";
    $response = $dbh->query($sql);
    echo '<div>
    <select id="actorId">';
    foreach ($response as $row) {
       echo "<option value='$row[0]'>$row[1]</option>";
    }
    echo '</select>
    <div><button onClick="searchByActor();">Пошук</button></div>
    <form/>';
    }
    catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>"; die();
    }

?>
<div id="content"></div>
</body>
</html>

