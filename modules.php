<?php require_once __DIR__ . '/layouts/header.php'; ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Powerful Modules</h1>
        <p>Comprehensive tools designed to streamline every aspect of your business</p>
    </div>
</section>

<!-- Module Filter -->
<section class="section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="modules-filter">
                <button class="filter-btn active" data-filter="all">All Modules</button>
                <button class="filter-btn" data-filter="financial">Accounting & Finances</button>
                <button class="filter-btn" data-filter="operations">Operations</button>
                <button class="filter-btn" data-filter="people">People</button>
                <button class="filter-btn" data-filter="sales">Sales & CRM</button>
            </div>
        </div>

        <div class="modules-grid">
            <?php 
            $modules = getModules();
            foreach ($modules as $module): 
                // Categorize modules (simplified for demo)
                $category = 'operations';
                $moduleName = strtolower($module['name']);

                if (strpos($moduleName, 'financial') !== false || strpos($moduleName, 'finance') !== false || strpos($moduleName, 'accounting') !== false) {
                    $category = 'financial';
                } elseif (strpos($moduleName, 'hr') !== false || strpos($moduleName, 'human') !== false) {
                    $category = 'people';
                } elseif (strpos($moduleName, 'crm') !== false || strpos($moduleName, 'customer') !== false) {
                    $category = 'sales';
                }
            ?>
            <div class="module-card card fade-in-up" data-category="<?php echo $category; ?>">
                <div class="module-header">
                    <div class="module-icon">
                        <span><?php echo htmlspecialchars($module['icon']); ?></span>
                    </div>
                    <div>
                        <h3><?php echo htmlspecialchars($module['name']); ?></h3>
                        <p class="text-muted"><?php echo htmlspecialchars($module['short_desc']); ?></p>
                    </div>
                </div>

                <p><?php echo htmlspecialchars($module['full_desc']); ?></p>

                <?php 
                $features = json_decode($module['features'] ?? '[]', true);
                if ($features): 
                ?>
                <ul class="module-features">
                    <?php foreach ($features as $feature): ?>
                    <li><i class="fas fa-check-circle text-success"></i> <?php echo htmlspecialchars($feature); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <div class="module-footer">
                    <div class="d-flex justify-between align-center">
                        <span class="text-primary"><i class="fas fa-star"></i> Included in all plans</span>
                        <a href="#module-<?php echo $module['id']; ?>" class="btn btn-outline btn-sm">
                            Details <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Integration -->
<section class="section section-light">
    <div class="container">
        <div class="grid grid-2 align-center gap-5">
            <div class="fade-in-up">
                <h2>Seamless Integration</h2>
                <p>All FUMBO ERP modules are designed to work together seamlessly. Share data across departments,
                    eliminate duplicate entries, and get a unified view of your business.</p>

                <div class="mt-4">
                    <h4><i class="fas fa-link text-primary"></i> Connected Workflows</h4>
                    <p>Sales orders automatically update inventory, which triggers procurement when stock is low, and
                        updates financial records in real-time.</p>

                    <h4 class="mt-3"><i class="fas fa-database text-primary"></i> Single Source of Truth</h4>
                    <p>One database powers all modules, ensuring data consistency and eliminating information silos.</p>
                </div>
            </div>
            <div class="fade-in-up">
                <div class="card">
                    <div class="text-center">
                        <i class="fas fa-sync-alt text-primary" style="font-size: 4rem;"></i>
                        <h3 class="mt-3">How Modules Connect</h3>
                        <div class="mt-4">
                            <div class="d-flex align-center justify-between mb-3">
                                <span>CRM</span>
                                <i class="fas fa-arrow-right text-muted"></i>
                                <span>Sales</span>
                                <i class="fas fa-arrow-right text-muted"></i>
                                <span>Inventory</span>
                            </div>
                            <div class="d-flex align-center justify-between mb-3">
                                <span>Inventory</span>
                                <i class="fas fa-arrow-right text-muted"></i>
                                <span>Finance</span>
                                <i class="fas fa-arrow-right text-muted"></i>
                                <span>Reporting</span>
                            </div>
                            <div class="d-flex align-center justify-between">
                                <span>HR</span>
                                <i class="fas fa-arrow-right text-muted"></i>
                                <span>Projects</span>
                                <i class="fas fa-arrow-right text-muted"></i>
                                <span>All Modules</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section">
    <div class="container">
        <div class="text-center">
            <h2>Ready to See All Modules in Action?</h2>
            <p class="mb-4">Experience how our modules work together to transform your business</p>
            <a href="demo.php" class="btn btn-primary btn-lg">
                <i class="fas fa-calendar-check"></i> Schedule a Live Demo
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>