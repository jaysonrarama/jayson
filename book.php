<?php
session_start();
if(!isset($_SESSION['username']) || !$_SESSION['is_admin']) header("Location: ../index.php");

require 'conn.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $year = $_POST['publish_year'];
    $summary = $_POST['summary'];

    $stmt = $conn->prepare("INSERT INTO books (title, author, genre, publish_year, summary) VALUES (?, ?, ?, ?, ?)");
    if($stmt->execute([$title, $author, $genre, $year, $summary])){
        header("Location: ../index.php");
    } else {
        $error = "Failed to add book!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Book</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card shadow">
<div class="card-body">
<h3 class="card-title mb-4 text-center">Add New Book</h3>
<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
<form method="post">
<div class="mb-3"><label class="form-label">Title</label><input type="text" class="form-control" name="title" required></div>
<div class="mb-3"><label class="form-label">Author</label><input type="text" class="form-control" name="author" required></div>
<div class="mb-3"><label class="form-label">Genre</label><input type="text" class="form-control" name="genre" required></div>
<div class="mb-3"><label class="form-label">Publish Year</label><input type="number" class="form-control" name="publish_year" required></div>
<div class="mb-3"><label class="form-label">Summary</label><textarea class="form-control" name="summary" required></textarea></div>
<button type="submit" class="btn btn-primary w-100">Add Book</button>
</form>
<a href="../index.php" class="btn btn-secondary w-100 mt-2">Back to Homepage</a>
</div>
</div>
</div>
</div>
</div>
</body>
</html>