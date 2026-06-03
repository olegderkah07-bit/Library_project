<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/x-icon" href="depositphotos_54615585-stock-photo-old-books-on-wooden-table.jpg">
  <link rel="stylesheet" href="AuthorsStyle.css">   
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Your library</title>
</head>
<body>
  <header>
    <h1>Перелік авторів</h1>
    <h3>На цьому сайті ви можете побачити усіх авторів чиї книги в нас є</h3>
  </header>
  <input type="text" id="search" placeholder="Пошук автора..." onkeyup="searchAuthor()">
  <div>
<?php
require_once "conection.php";
$sql = "SELECT Author FROM author";
$result = $conn->query($sql);
$authors = array();

echo "<table border='1' id='authorsTable'>
<tr>
<th>Автори</th>
</tr>";
if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {
    $authors[]= $row["Author"];
  }
} else {
  echo "0 results";
}
    
foreach ($authors as $i){
    echo "<tr>
        <td>" . $i. "</td>
        </tr>";
}
echo "</table>";
?>
</div>
  <footer>
  <script>
      function searchAuthor() {
      const input = document.getElementById('search').value.toLowerCase();
      const table = document.getElementById('authorsTable');
      const rows = table.getElementsByTagName('tr');

      for (let i = 1; i < rows.length; i++) {
        const cell = rows[i].getElementsByTagName('td')[0];
        if (cell) {
          const textValue = cell.textContent || cell.innerText;
          rows[i].style.display = textValue.toLowerCase().indexOf(input) > -1 ? "" : "none";
        }       
      }
    }
  </script>
  </footer>
</body>
</html>