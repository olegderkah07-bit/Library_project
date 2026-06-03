<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/x-icon" href="depositphotos_54615585-stock-photo-old-books-on-wooden-table.jpg">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Your library</title>
  <link rel="stylesheet" href="BookRStyle.css">
  <script type="text/javascript" src=button.js></script>
</head>
<body>
  <header>
    <h1 class="main">Рекомендації до книг</h1>
  </header>
  <input type="text" id="search" placeholder="Пошук книги..." onkeyup="searchBooks()">
  <div>

    <?php
    require_once "conection.php";
    $sql1 = "SELECT Name FROM books";
    $sql2 = "SELECT Recommendation FROM recommendation";
    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    echo "<table border='1' id='booksTable'>
      <tr>
        <th>Назва книги</th>
        <th>Рекомендація</th>
      </tr>";

    if ($result1->num_rows > 0 && $result2->num_rows > 0) {
      $books = [];
      $recommendations = [];

      while ($row1 = $result1->fetch_assoc()) {
        $books[] = $row1["Name"];
      }

      while ($row2 = $result2->fetch_assoc()) {
        $recommendations[] = $row2["Recommendation"];
      }

      for ($i = 0; $i < count($books); $i++) {
        echo '<tr>
        <td class="tdc">' . $books[$i] . '</td>
        <td class="tdc2"><p id="rec_' . $i . '" class="text_rec">' . (isset($recommendations[$i]) ? $recommendations[$i] : 'Немає рекомендації') . 
        '</p><button onclick="showText(\'rec_' . $i . '\')">Read More…</button></td>
        </tr>';
      }
    } else {
      echo "<tr><td colspan='2'>0 results</td></tr>";
    }

    echo "</table>";
    ?>
    <script>
      function searchBooks() {
        const input = document.getElementById('search').value.toLowerCase();
        const rows = document.querySelectorAll('#booksTable tr');

        rows.forEach((row, index) => {
          if (index === 0) return; // пропустити заголовок
          const cells = row.getElementsByTagName('td');
          const bookName = cells[0].textContent.toLowerCase();
          row.style.display = bookName.includes(input) ? '' : 'none';
        });
      }
    </script>
  </div>
</body>

</html>