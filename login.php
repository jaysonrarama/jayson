<?php
session_start();
require 'conn.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['username'] = $username;
        $_SESSION['is_admin'] = $user['is_admin'];
        header("Location: home.php");
    } else {
        $error = "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-5">
<div class="card shadow">
<div class="card-body">
<h3 class="card-title mb-4 text-center">Login</h3>
<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
<form method="post">
<div class="mb-3"><label class="form-label">Username</label><input type="text" class="form-control" name="username" required></div>
<div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password" required></div>
<button type="submit" class="btn btn-primary w-100">Login</button>
</form>
<p class="mt-3 text-center">Don't have an account? <a href="register.php">Register</a></p>
</div>
</div>
</div>
</div>
</div>
</body>
</html>