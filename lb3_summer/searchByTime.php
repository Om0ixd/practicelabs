<!DOCTYPE HTML>
<html lang="ru">
<head>
    <title>Шукати фільми за актором</title>
    <meta charset="utf-8">
</head>
<script>
     async function searchByTime(e) {
         let url = "/sem2lb3/filmsByTime.php";
         let from = document.getElementById("from").value;
         let to = document.getElementById("to").value;
         let request = {
             method:"POST",
             headers : {"Content-type":"application/x-www-form-urlencoded"},
             body: 'from=' + encodeURIComponent(from) + "&to=" + encodeURIComponent(to)
         }
         let response = await fetch(url, request);
         let text = await response.text();
         let select = document.getElementById('content');
         select.innerHTML = text;
      }
</script>
<body>
    Виберіть часовий інтервал за яким хочете шукати фільми:<br><br>

    <div>
    <input type="date" id="from" name="from"
           value="2016-10-25">
   <input type="date" id="to" name="to"
          value="2022-05-22">
    <div><button onClick="searchByTime();">Пошук</button></div>
    </div>
    <div id="content"></div>
</body>
</html>

