<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../index.php");
    exit;
}
$username = $_SESSION['username'];
$role     = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhoneHub</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
 
<header class="site-header">
    <a href="index.php" class="header-logo">Phone<span>Hub</span> 📱</a>
    <ul class="header-nav">
        <li><span class="header-welcome">👋 <?php echo htmlspecialchars($username); ?></span></li>
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php#products">Products</a></li>
        <?php if ($role == 1): ?>
        <li><a href="admin/index.php" class="nav-admin">⚙ Admin</a></li>
        <?php endif; ?>
        <li><a href="../functions/logout.php" class="nav-logout">Log Out</a></li>
    </ul>
</header>