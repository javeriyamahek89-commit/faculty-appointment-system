<?php
session_start();

if(isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(
        $_POST['username'] === 'mahek' &&
        $_POST['password'] === 'mahek@123'
    ) {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit;
    }

    $error = 'Invalid username or password';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Faculty/Admin Login</h2>

        <?php if($error): ?>
            <div class="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <label>Username</label>
            <input name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <p>Admin Username: mahek</p>
        <p>Admin Password: mahek@123</p>

        <a href="../index.php">Back</a>
    </div>
</div>

</body>
</html>