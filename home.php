<?php
session_start();
if(!isset($_SESSION['username'])) header("Location: auth/login.php");

require 'conn.php';
$stmt = $conn->query("SELECT title, summary FROM books");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Library Homepage</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
<a class="navbar-brand" href="#">Library System</a>
<div class="collapse navbar-collapse">
<ul class="navbar-nav ms-auto">
<li class="nav-item"><a class="nav-link" href="inventory.php">Inventory</a></li>
<?php if($_SESSION['is_admin']) echo '<li class="nav-item"><a class="nav-link" href="admin/add_book.php">Add Book</a></li>'; ?>
<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
</ul>
</div>
</div>
</nav>

<div class="container mt-4">
<h1 class="mb-4">Welcome, <?= $_SESSION['username']; ?></h1>
<div class="row">
<?php foreach($books as $book): ?>
<div class="col-md-6 mb-4">
<div class="card h-100 shadow-sm">
<div class="card-body">
<h5 class="card-title"><?= $book['title']; ?></h5>
<p class="card-text"><?= $book['summary']; ?></p>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
</div>
</body>
</html>