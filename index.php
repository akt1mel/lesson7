<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once ('db.php');

$isbn = !empty($_GET['isbn']) ? $_GET['isbn'] : "";
$name = !empty($_GET['name']) ? $_GET['name'] : "";
$author = !empty($_GET['author']) ? $_GET['author'] : "";
$fetch = $pdo->prepare("SELECT * FROM books WHERE (isbn LIKE ?) AND (name LIKE ?) AND (author LIKE ?)");
$params = array("%$isbn%","%$name%","%$author%");
$fetch->execute($params);

?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Книги</title>
</head>
<body>
    <form method="GET">
        <input type="text" name="isbn" placeholder="ISBN" value="<?= $isbn ?>" />
        <input type="text" name="name" placeholder="Название книги" value="<?= $name ?>" />
        <input type="text" name="author" placeholder="Автор книги" value="<?= $author ?>" />
        <input type="submit" value="Поиск" />
    </form>
    <table border="1">
        <tr>
            <th>Название</th>
            <th>Автор</th>
            <th>Год выпуска</th>
            <th>Жанр</th>
            <th>ISBN</th>
        </tr>
        <br>
        <?php foreach ($fetch as $book):?>
        <tr>
            <td><?= $book['name']?></td>
            <td><?= $book['author']?></td>
            <td><?= $book['year']?></td>
            <td><?= $book['genre']?></td>
            <td><?= $book['isbn']?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
