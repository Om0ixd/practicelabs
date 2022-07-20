<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Шукати фільми за жанром</title>
    <meta charset="utf-8">
</head>
<script>
     let ajax = new XMLHttpRequest();

     function searchByGenre(e) {
        if (!ajax) {
            alert("Ajax не инициализирован"); return;
        }
        var value = document.getElementById("genreId").value;
        ajax.onreadystatechange = updateContent;
        const params = "genreId=" + encodeURIComponent(value);

        ajax.open("POST", "/sem2lb3/filmsByGenre.php", true);
        ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        ajax.send(params);
     }

     function updateContent() {
        if(ajax.readyState == 4) {
            if(ajax.status == 200) {
                let innerHtml = `<table>
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
              </thead><tbody>`;
                let content = document.getElementById("content");
                var rows = ajax.responseXML.firstChild.children;
                for (var i = 0; i < rows.length; i++) {
                    innerHtml += "<tr>";
                    innerHtml += "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>";
                    innerHtml += "<td>" + rows[i].children[1].textContent + "</td>";
                    innerHtml += "<td>" + rows[i].children[2].textContent + "</td>";
                    innerHtml += "<td>" + rows[i].children[4].textContent + "</td>";
                    innerHtml += "<td>" + rows[i].children[5].textContent + "</td>";
                    innerHtml += "<td>" + rows[i].children[6].textContent + "</td>";
                    innerHtml += "<td>" + rows[i].children[7].textContent + "</td>";
                    innerHtml += "<td>" + rows[i].children[8].textContent + "</td>";
                    innerHtml += "</tr>";
                }
                innerHtml += "</tbody></table>";
                content.innerHTML = innerHtml;
            }
        }
    }
</script>
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
    echo '<div>
    <select id="genreId" name="genreId">';
    foreach ($response as $row) {
       echo "<option value='$row[0]'>$row[1]</option>";
    }
    echo '</select>
    <div><button onClick="searchByGenre();">Пошук</button></div>';
    }
    catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>"; die();
    }
?>
<div id="content" style="margin-top: 20px"></div>
</body>
</html>

