<header class="site-header">
    <div class="container">
        <nav class="navbar">
            <div class="nav-brand">
                <a href="index.php" class="logo">
                    <img src="<?php echo SITE_URL; ?>assets/images/logo/fumbo_logo.png" alt="FUMBO ERP Logo"
                        class="logo-image">
                    <span class="logo-text">FUMBO<span class="highlight">ERP</span></span>
                </a>
            </div>
            <button class="nav-toggle" aria-label="Toggle navigation">
                <span class="hamburger"></span>
            </button>

            <ul class="nav-menu">
                <li><a href="index.php" class="<?php echo $current_page == 'index' ? 'active' : ''; ?>">Home</a></li>
                <li><a href="modules.php" class="<?php echo $current_page == 'modules' ? 'active' : ''; ?>">Modules</a>
                </li>
                <li><a href="pricing.php" class="<?php echo $current_page == 'pricing' ? 'active' : ''; ?>">Pricing</a>
                </li>
                <li><a href="demo.php" class="<?php echo $current_page == 'demo' ? 'active' : ''; ?>">Demo</a></li>
                <li><a href="about.php" class="<?php echo $current_page == 'about' ? 'active' : ''; ?>">About</a></li>
                <li><a href="contact.php" class="<?php echo $current_page == 'contact' ? 'active' : ''; ?>">Contact</a>
                </li>
            </ul>

            <div class="nav-actions">
                <?php if ($is_logged_in): ?>
                <div class="user-dropdown">
                    <button class="user-btn">
                        <i class="fas fa-user-circle"></i>
                        <span><?php echo htmlspecialchars($user['full_name'] ?? 'User'); ?></span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
                <?php else: ?>
                <a href="login.php" class="btn btn-outline">Login</a>
                <a href="register.php" class="btn btn-primary">Start Free Trial</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>