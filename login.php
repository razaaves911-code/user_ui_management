<?php
session_start();
// UI-only demo: replace this block with a password_verify() database check.
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    if ($email && $password !== '') {
        // Demo navigation only. Do not use this as real authentication.
        $_SESSION['demo_user'] = $email;
        header('Location: home.php');
        exit;
    }
    $error = 'Enter a valid email and password.';
}
?>
<!doctype html>
<html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign in | UserHub</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/style.css" rel="stylesheet"></head>
<body class="auth-bg">
<nav class="navbar navbar-expand-lg navbar-dark"><div class="container"><a class="navbar-brand fw-bold" href="login.php">UserHub</a><a class="nav-link text-white" href="register.php">Create account</a></div></nav>
<main class="container auth-wrap"><div class="row justify-content-center"><div class="col-sm-10 col-md-7 col-lg-5">
<div class="card auth-card"><div class="card-body p-4 p-md-5">
<div class="brand-mark mb-3">UH</div><h1 class="h3 fw-bold mb-2">Welcome back</h1><p class="text-secondary mb-4">Sign in to manage your users.</p>
<?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" id="loginForm">
<div class="mb-3"><label class="form-label" for="email">Email address</label><input class="form-control form-control-lg" id="email" name="email" type="email" placeholder="name@example.com" required></div>
<div class="mb-3"><div class="d-flex justify-content-between"><label class="form-label" for="password">Password</label><a class="small" href="#">Forgot password?</a></div><input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Enter password" required minlength="6"></div>
<div class="form-check mb-4"><input class="form-check-input" type="checkbox" id="remember"><label class="form-check-label" for="remember">Remember me</label></div>
<button class="btn btn-primary btn-lg w-100" type="submit">Sign in</button>
</form><p class="text-center text-secondary mt-4 mb-0">Don't have an account? <a href="register.php">Register</a></p>
</div></div></div></div></main>
<script src="assets/app.js"></script></body></html>
