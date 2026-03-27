<?php
session_start();
if(!isset($_SESSION['username'])) header("Location:login.php");

require 'conn.php';
$stmt = $conn->query("SELECT title, author, genre, publish_year FROM books");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Inventory</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
<h1 class="mb-4">Book Inventory</h1>
<table class="table table-striped table-bordered">
<thead class="table-dark">
<tr>
<th>Title</th>
<th>Author</th>
<th>Genre</th>
<th>Publish Year</th>
</tr>
</thead>
<tbody>
<?php foreach($books as $book): ?>
<tr>
<td><?= $book['title']; ?></td>
<td><?= $book['author']; ?></td>
<td><?= $book['genre']; ?></td>
<td><?= $book['publish_year']; ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<a href="home.php" class="btn btn-secondary mt-3">Back to Homepage</a>
</div>
</body>
</html>