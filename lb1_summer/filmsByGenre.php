<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Фільми за жанром</title>
    <meta charset="utf-8">
</head>
<body>
<?php
    $db_driver="mysql"; $host = "localhost"; $database = "films";
    $dsn = "$db_driver:host=$host; dbname=$database";
    $username = "root"; $password = "";

    try {
    $dbh = new PDO ($dsn, $username, $password);
    echo "Фільми за жанром:<br><br>";
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
    echo "<table>
                  <thead>
                      <tr>
                          <th>
                              Назва
                          </th>
                          <th>
                              Дата виходу
                          </th>
                          <th>
                              Країна
                          </th>
                          <th>
                              Якість
                          </th>
                          <th>
                              Роздільна здатність
                          </th>
                          <th>
                              Кодек
                          </th>
                          <th>
                              Продюсер
                          </th>
                          <th>
                              Режисер
                          </th>
                          <th>
                              Носій
                          </th>
                      </tr>
                  </thead><tbody>";
    foreach ($response as $row) {
       echo "<tr>
                 <td>
                     $row[0]
                 </td>
                 <td>
                     $row[1]
                 </td>
                 <td>
                     $row[2]
                 </td>
                 <td>
                     $row[3]
                 </td>
                 <td>
                     $row[4]
                 </td>
                 <td>
                     $row[5]
                 </td>
                 <td>
                     $row[6]
                 </td>
                 <td>
                     $row[7]
                 </td>
                 <td>
                     $row[8]
                 </td>
             </tr>";
    }
    echo "</tbody>
              </table>";

    }
    catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>"; die();
    }

?>

</body>
</html>

