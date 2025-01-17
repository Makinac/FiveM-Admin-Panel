<?php
require_once 'app/models/Auth.php';
$auth = new Auth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= 'Admin Panel | ' . ($title ?? '') ?></title>
    
    <!-- Společné CSS -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="brand">
                <i class="fas fa-rocket"></i>
                <span>Fivem Admin Panel</span>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="#"><i class="fas fa-chart-pie"></i>Dashboard</a>
                </li>
                <?php if ($auth->hasPermission('view_profile')): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fas fa-user"></i>Profile
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if ($auth->hasPermission('view_profile_details')): ?>
                        <li><a href="#"><i class="fas fa-eye"></i>View Profile</a></li>
                        <?php endif; ?>
                        <?php if ($auth->hasPermission('edit_profile')): ?>
                        <li><a href="#"><i class="fas fa-edit"></i>Edit Profile</a></li>
                        <?php endif; ?>
                        <?php if ($auth->hasPermission('privacy_settings')): ?>
                        <li><a href="#"><i class="fas fa-shield-alt"></i>Privacy Settings</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if ($auth->hasPermission('view_settings')): ?>
                <li>
                    <a href="#"><i class="fas fa-cogs"></i>Settings</a>
                </li>
                <?php endif; ?>
                <?php if ($auth->hasPermission('view_help')): ?>
                <li>
                    <a href="#"><i class="fas fa-question-circle"></i>Help</a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- Content Area -->
        <div class="content">
            <!-- Header -->
            <header class="header">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <div class="header-tools">
                    <a href="/moderators" class="text-button" title="Moderators">Moderators</a>
                    <a href="/modules" class="text-button" title="Modules">Modules</a>
                </div>
                <div class="header-buttons">
                    <a href="notifications.html" class="icon-button" title="Notifications"><i class="fas fa-bell"></i></a>
                    <button class="icon-button" id="change-password-button" title="Change Password">
                        <i class="fas fa-cogs"></i>
                    </button>
                    <a href="/logout" class="icon-button" title="Logout"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </header>

            <div id="change-password-modal" class="modal hidden">
                <div class="modal-content">
                    <h2>Change Password</h2>
                    <form id="change-password-form">
                        <div class="password-wrapper">
                            <input type="password" id="old-password" name="old-password" placeholder="Current password" required>
                            <button type="button" class="toggle-password">👁️</button>
                        </div>

                        <div class="password-wrapper">
                            <input type="password" id="new-password" name="new-password" placeholder="New password" required>
                            <button type="button" class="toggle-password">👁️</button>
                        </div>

                        <div class="password-wrapper">
                            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm password" required>
                            <button type="button" class="toggle-password">👁️</button>
                        </div>

                        <button class="modal-content-submit" type="submit">Submit</button>
                    </form>
                    <button id="close-modal" class="close-button">&times;</button>
                </div>
            </div>

            <!-- Main Content -->
            <main class="main-content">
                <?= $content ?>
            </main>
        </div>
    </div>

    <script src="/assets/js/main.js"></script>
    <?php if (isset($script)): ?>
        <script src="<?= $script ?>"></script>
    <?php endif; ?>
</body>
</html>
