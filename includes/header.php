<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>E-Welfare Bangladesh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <?php if (isset($additionalCSS)): ?>
        <?php foreach ($additionalCSS as $css): ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <div class="mobile-menu-overlay"></div>
    <header>
        <div class="logo">E-Welfare <span>Bangladesh</span></div>
        <nav>
            <a href="index.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'class="active"' : ''; ?>>Home</a>
            <a href="about.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'class="active"' : ''; ?>>About</a>
            <a href="services.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'services.php') ? 'class="active"' : ''; ?>>Services</a>
            <a href="#contact">Contact</a>
            <?php if (isLoggedIn()): 
                $currentUser = getCurrentUser();
            ?>
                <a href="dashboard.php" id="dashboardBtn">Dashboard</a>
                <a href="logout.php" id="logoutBtn">Logout (<?php echo htmlspecialchars($currentUser['username']); ?>)</a>
            <?php else: ?>
                <a href="login.php" id="loginBtn">Login</a>
                <button id="joinBtn">Join Us</button>
            <?php endif; ?>
        </nav>
        <div class="hamburger">
            <i class="fas fa-bars"></i>
        </div>
        <div class="mobile-menu-overlay"></div>
    </header>
