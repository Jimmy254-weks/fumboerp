<?php require_once __DIR__ . '/layouts/header.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content fade-in-up">
            <h1>Manage your entire business, <span class="highlight">all in one place</span></h1>
            <p>Solving the business management puzzle to yield proper results.</p>
            <div class="hero-buttons">
                <a href="register.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-rocket"></i> Start Free Trial
                </a>
                <a href="demo.php" class="btn btn-outline btn-lg">
                    <i class="fas fa-play-circle"></i> Watch Demo
                </a>
            </div>
            <div class="hero-stats mt-5">
                <div class="d-flex gap-5 justify-center">
                    <div class="text-center">
                        <h3 class="text-light">100+</h3>
                        <p class="text-light">Businesses Empowered</p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-light">24/7</h3>
                        <p class="text-light">Support Available</p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-light">99.9%</h3>
                        <p class="text-light">Uptime Guarantee</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Everything You Need to Succeed</h2>
            <p class="text-muted">Comprehensive modules that work seamlessly together</p>
        </div>

        <div class="feature-grid">
            <?php 
            $modules = getModules(6);
            foreach ($modules as $module): 
            ?>
            <div class="feature-card card fade-in-up">
                <div class="feature-icon">
                    <span><?php echo htmlspecialchars($module['icon']); ?></span>
                </div>
                <h3><?php echo htmlspecialchars($module['name']); ?></h3>
                <p><?php echo htmlspecialchars($module['short_desc']); ?></p>
                <a href="modules.php#<?php echo htmlspecialchars($module['slug']); ?>" class="btn btn-outline mt-3">
                    Learn More <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="section section-light">
    <div class="container">
        <div class="section-title">
            <h2>Simple Integration, Powerful Results</h2>
            <p class="text-muted">Get started in minutes, see results in days</p>
        </div>

        <div class="grid grid-3">
            <div class="text-center fade-in-up">
                <div class="step-number">1</div>
                <h3>Sign Up</h3>
                <p>Start your 14-day free trial with no credit card required</p>
            </div>
            <div class="text-center fade-in-up" style="animation-delay: 0.2s">
                <div class="step-number">2</div>
                <h3>Configure</h3>
                <p>Set up your company profile and import your data</p>
            </div>
            <div class="text-center fade-in-up" style="animation-delay: 0.4s">
                <div class="step-number">3</div>
                <h3>Grow</h3>
                <p>Use insights to optimize operations and drive growth</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Trusted by Businesses Worldwide</h2>
            <p class="text-muted">See what our customers have to say</p>
        </div>

        <div class="testimonial-slider">
            <?php 
            $testimonials = getTestimonials(true, 3);
            foreach ($testimonials as $testimonial): 
            ?>
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <?php echo htmlspecialchars($testimonial['content']); ?>
                </div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">
                        <?php if ($testimonial['avatar']): ?>
                        <img src="<?php echo htmlspecialchars($testimonial['avatar']); ?>"
                            alt="<?php echo htmlspecialchars($testimonial['client_name']); ?>"
                            class="w-100 rounded-circle">
                        <?php else: ?>
                        <div class="w-100 h-100 bg-primary d-flex align-center justify-center rounded-circle">
                            <span
                                class="text-light"><?php echo strtoupper(substr($testimonial['client_name'], 0, 1)); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="testimonial-info">
                        <h4><?php echo htmlspecialchars($testimonial['client_name']); ?></h4>
                        <p class="text-muted"><?php echo htmlspecialchars($testimonial['position']); ?> at
                            <?php echo htmlspecialchars($testimonial['company']); ?></p>
                        <div class="testimonial-rating">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                            <?php if ($i < $testimonial['rating']): ?>
                            <i class="fas fa-star"></i>
                            <?php else: ?>
                            <i class="far fa-star"></i>
                            <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section section-dark">
    <div class="container">
        <div class="text-center">
            <h2>Ready to Transform Your Business?</h2>
            <p class="mb-4">Join other businesses already using FUMBO ERP</p>
            <div class="d-flex gap-3 justify-center">
                <a href="register.php" class="btn btn-secondary btn-lg">
                    <i class="fas fa-play"></i> Start Free Trial
                </a>
                <a href="contact.php" class="btn btn-outline-light btn-lg">
                    <!-- Changed class here -->
                    <i class="fas fa-question-circle"></i> Ask Questions
                </a>
            </div>
            <p class="mt-4 text-light">No credit card required • 14-day free trial • Cancel anytime</p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>