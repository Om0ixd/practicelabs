<?php
    $db_driver="mysql"; $host = "localhost"; $database = "films";
    $dsn = "$db_driver:host=$host; dbname=$database";
    $username = "root"; $password = "";

    $dbh = new PDO ($dsn, $username, $password);
    $genre_id = $_POST['genreId'];
    $select_films_by_actor =  'SELECT * FROM `film_genre` WHERE FID_Genre = :genre_id;';
    $sth = $dbh->prepare($select_films_by_actor, array (PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':genre_id' => $genre_id));
    $films_by_genre = $sth->fetchAll();

    $film_ids = [];
    foreach ($films_by_genre as $row) {
        array_push($film_ids, $row[0]);
    }
    $films_by_id = "SELECT * FROM `film` WHERE ";
    $lastElement = end($film_ids);
    foreach ($film_ids as $film_id) {
        if ($film_id != $lastElement) {
            $films_by_id = $films_by_id . "ID_Film = $film_id OR ";
        } else {
            $films_by_id = $films_by_id . "ID_Film = $film_id;";
        }
    }

    $response = $dbh->query($films_by_id);
    header('Content-Type: text/xml');
    header("Cache-Control: no-cache, must-revalidate");
    echo '<?xml version="1.0" encoding="utf8" ?>';
    echo "<root>";
    foreach ($response as $row)
    {
        $name=$row[0]; $date=$row[1]; $country=$row[2]; $quality=$row[3]; $resolution=$row[4];
        $codec=$row[5];$producer=$row[6];$director=$row[7];$carrier=$row[8];
        print "<row><name>$name</name><date>$date</date>
        <country>$country</country> <quality>$quality</quality>
          <resolution>$resolution</resolution> <codec>$codec</codec>
           <producer>$producer</producer> <director>$director</director>
            <carrier>$carrier</carrier></row>";
    }
    echo "</root>";

?>

