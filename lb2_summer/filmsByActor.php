<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Фільми за актором</title>
    <meta charset="utf-8">
</head>
<style>
    .hidden {
        visibility: hidden;
    }
</style>
<body>
<?php
    require_once __DIR__ . "\\vendor\\autoload.php";
    echo "Фільми за актором:<br><br>";
    $actor_id = $_POST['actorId'];
    $db = (new MongoDB\Client)->films;

    $film_actors = $db->film_actor;
    $films_by_film_actor = $film_actors->find([
        'FID_Actor' => intval($actor_id)
    ]);
    $film_ids = [];
    foreach ($films_by_film_actor as $document) {
        array_push($film_ids, intval($document['FID_Film']));
    }
    $films = $db->film;
    $found_films = $films->find([
        'ID_Film' => ['$in' => $film_ids]
    ]);
    $films = [];

    foreach ($found_films as $row) {
            array_push($films, "<tr>
                            <td>
                                 $row->name
                             </td>
                             <td>
                                 $row->date
                             </td>
                             <td>
                                 $row->country
                             </td>
                             <td>
                                 $row->quality
                             </td>
                             <td>
                                 $row->resolution
                             </td>
                             <td>
                                 $row->codec
                             </td>
                             <td>
                                 $row->producer
                             </td>
                             <td>
                                 $row->director
                             </td>
                             <td>
                                  $row->carrier
                             </td>
                         </tr>");
    }

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
    foreach ($films as $row) {
        printf($row);
    }
    echo "</tbody>
              </table>";
?>
    <div id="savedData"></div>
</body>
<script>
       const actor_id = '<?php echo $actor_id; ?>';
       let savedFilms = localStorage.getItem(`filmsByActor_${actor_id}`);
       const element = document.getElementById("savedData");
       const onClick = function() {
           const element = document.getElementById('savedData_table');
           element.classList.remove('hidden');
       }
       if(savedFilms) {
          savedFilms = savedFilms.replace(/\[|\]/g, '').trim().split(';').join('');
          let innerHtmlData = `<h4>Ви вже переглядали цю сторінку, можете <button onClick="onClick()">подивитись дані з кешу</button></h4>`;
          innerHtmlData += `<table id="savedData_table" class="hidden">
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
              </thead><tbody>
                ${savedFilms}
              </tbody>
                                           </table>`;
          element.innerHTML = innerHtmlData;
       } else {
          element.innerHTML = `<h4>Це ваш перший візит на цю сторінку. Дані пошуку було закешовано.</h4>`;
          const data = '<?php echo json_encode($films); ?>';
          localStorage.setItem(`filmsByActor_${actor_id}`, data);
       }
</script>
</html>

