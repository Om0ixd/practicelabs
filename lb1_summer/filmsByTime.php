<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Фільми за проміжок часу</title>
    <meta charset="utf-8">
</head>
<body>
<?php
    $db_driver="mysql"; $host = "localhost"; $database = "films";
    $dsn = "$db_driver:host=$host; dbname=$database";
    $username = "root"; $password = "";

    try {
    $dbh = new PDO ($dsn, $username, $password);
    $from_time = $_POST['from'];
    $to_time = $_POST['to'];
    echo "Фільми з $from_time до $to_time:<br><br>";
    $films_by_time = "SELECT * FROM `film` WHERE `date` BETWEEN '$from_time' AND '$to_time';";

    $response = $dbh->query($films_by_time);
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

