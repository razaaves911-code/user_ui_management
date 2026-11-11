<?php
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    if ($name && $email && strlen($password) >= 8 && $password === $confirm) {
        // UI-only demo. Save users with password_hash() in MySQL for production.
        $_SESSION['demo_user'] = $email;
        header('Location: home.php');
        exit;
    }
    $error = 'Check your details. Passwords must match and contain at least 8 characters.';
}
?>
<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Create account | UserHub</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="assets/style.css" rel="stylesheet"></head>
<body class="auth-bg"><nav class="navbar navbar-expand-lg navbar-dark"><div class="container"><a class="navbar-brand fw-bold" href="login.php">UserHub</a><a class="nav-link text-white" href="login.php">Sign in</a></div></nav>
<main class="container auth-wrap"><div class="row justify-content-center"><div class="col-sm-10 col-md-8 col-lg-6"><div class="card auth-card"><div class="card-body p-4 p-md-5">
<div class="brand-mark mb-3">UH</div><h1 class="h3 fw-bold mb-2">Create your account</h1><p class="text-secondary mb-4">Get started with your user management workspace.</p>
<?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" id="registerForm">
<div class="mb-3"><label class="form-label" for="name">Full name</label><input class="form-control form-control-lg" id="name" name="name" placeholder="Your full name" required></div>
<div class="mb-3"><label class="form-label" for="email">Email address</label><input class="form-control form-control-lg" id="email" name="email" type="email" placeholder="name@example.com" required></div>
<div class="row"><div class="col-md-6 mb-3"><label class="form-label" for="password">Password</label><input class="form-control form-control-lg" id="password" name="password" type="password" minlength="8" required></div><div class="col-md-6 mb-3"><label class="form-label" for="confirm_password">Confirm password</label><input class="form-control form-control-lg" id="confirm_password" name="confirm_password" type="password" minlength="8" required></div></div>
<div class="form-check mb-4"><input class="form-check-input" id="terms" type="checkbox" required><label class="form-check-label" for="terms">I agree to the terms and privacy policy.</label></div>
<button class="btn btn-primary btn-lg w-100" type="submit">Create account</button>
</form><p class="text-center text-secondary mt-4 mb-0">Already registered? <a href="login.php">Sign in</a></p>
</div></div></div></div></main><script src="assets/app.js"></script></body></html>
