<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Шукати фільми за актором</title>
    <meta charset="utf-8">
</head>
<body>
<?php
    require_once __DIR__ . "\\vendor\\autoload.php";
    $collection = (new MongoDB\Client)->films->actor;
    $cursor = $collection->find([]);

    echo '<form  method="post" action="filmsByActor.php">
        <select name="actorId">';
    foreach ($cursor as $document) {
        printf("<option value='%s'>%s</option>", $document['ID_Actor'], $document['name']);
    }
    echo '</select>
    <div><button type="submit">Пошук</button></div>
    <form/>';

?>

</body>
</html>

