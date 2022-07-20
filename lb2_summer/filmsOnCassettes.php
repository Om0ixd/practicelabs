<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Фільми на відеокасетах</title>
    <meta charset="utf-8">
</head>
<body>
<?php
    require_once __DIR__ . "\\vendor\\autoload.php";
    echo "Фільми на відеокасетах:<br><br>";
    $db = (new MongoDB\Client)->films;

    $found_films = $db->film->find([
        'carrier' => ['$regex' => 'CASSETTES']
    ]);

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
    foreach ($found_films as $row) {
        printf("<tr>
                         <td>
                             %s
                         </td>
                         <td>
                             %s
                         </td>
                         <td>
                             %s
                         </td>
                         <td>
                             %s
                         </td>
                         <td>
                             %s
                         </td>
                         <td>
                             %s
                         </td>
                         <td>
                             %s
                         </td>
                         <td>
                             %s
                         </td>
                         <td>
                             %s
                         </td>
                     </tr>", $row['name'], $row['date'], $row['country'], $row['quality'], $row['resolution'], $row['codec'], $row['producer'], $row['director'], $row['carrier']);
    }
    echo "</tbody>
              </table>";
?>
</body>
</html>

