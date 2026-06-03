<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/x-icon" href="depositphotos_54615585-stock-photo-old-books-on-wooden-table.jpg">
  <link rel="stylesheet" href="GenreStyle.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Your library</title>
</head>
<body>
  <header>
    <h1 class="main">Жанри</h1>
  </header>
  <input type="text" id="search" placeholder="Пошук жанру..." onkeyup="searchBooks()">
  <div id="book-list">

<?php
require_once "conection.php";

$sql1 = "SELECT Name, Genre_code FROM books";
$sql2 = "SELECT Genre_code, Genre FROM genre";
$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);

$genres = [];
if ($result2->num_rows > 0) {
  while($row2 = $result2->fetch_assoc()) {
    $genres[$row2['Genre_code']] = $row2['Genre'];
  }
}

if ($result1->num_rows > 0) {
  while($row1 = $result1->fetch_assoc()) {
    $Genre = isset($genres[$row1["Genre_code"]]) ? $genres[$row1["Genre_code"]] : "Невідомий жанр";

    echo "<div class='divelem1' data-name='" . htmlspecialchars($row1["Name"]) . "' data-author='" . htmlspecialchars($Genre) . "'>";
    echo "<div>Назва книги: " . htmlspecialchars($row1["Name"]) . "</div>";
    echo "<div>Жанр: " . htmlspecialchars($Genre) . "</div>";
    echo "<hr>";
    echo "</div>";
  }
} 
else {
  echo "<div>0 результатів</div>";
}
?>

  </div>

  <script>
    function searchBooks() {
      const input = document.getElementById('search').value.toLowerCase();
      const books = document.querySelectorAll('#book-list .divelem1');

      books.forEach(book => {
        const name = book.getAttribute('data-name').toLowerCase();
        const author = book.getAttribute('data-author').toLowerCase();
        
        if (name.includes(input) || author.includes(input)) {
          book.style.display = '';
        } else {
          book.style.display = 'none';
        }
      });
    }
  </script>
</body>
</html>
