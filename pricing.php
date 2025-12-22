<?php require_once __DIR__ . '/layouts/header.php'; ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Simple, Transparent Pricing</h1>
        <p>Choose the plan that fits your business needs. All plans include our core modules.</p>
    </div>
</section>

<!-- Pricing -->
<section class="section">
    <div class="container">
        <div class="pricing-grid">
            <!-- Free Trial -->
            <div class="pricing-card card fade-in-up">
                <div class="pricing-header">
                    <h3>Free Trial</h3>
                    <div class="pricing-price">$0<span>/14 days</span></div>
                    <p>Experience full platform capabilities</p>
                </div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> All Core Modules</li>
                    <li><i class="fas fa-check"></i> Up to 10 Users</li>
                    <li><i class="fas fa-check"></i> 5GB Storage</li>
                    <li><i class="fas fa-check"></i> Basic Support</li>
                    <li><i class="fas fa-check"></i> Email & Chat</li>
                </ul>
                <div class="pricing-footer">
                    <a href="register.php" class="btn btn-outline btn-block">Start Free Trial</a>
                </div>
            </div>

            <!-- Basic Plan -->
            <div class="pricing-card card fade-in-up" style="animation-delay: 0.1s">
                <div class="pricing-header">
                    <h3>Basic</h3>
                    <div class="pricing-price">$49<span>/month</span></div>
                    <p>Perfect for small businesses</p>
                </div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> All Core Modules</li>
                    <li><i class="fas fa-check"></i> Up to 25 Users</li>
                    <li><i class="fas fa-check"></i> 50GB Storage</li>
                    <li><i class="fas fa-check"></i> Priority Support</li>
                    <li><i class="fas fa-check"></i> Email, Chat & Phone</li>
                    <li><i class="fas fa-check"></i> Basic Reports</li>
                </ul>
                <div class="pricing-footer">
                    <a href="register.php" class="btn btn-primary btn-block">Get Started</a>
                </div>
            </div>

            <!-- Premium Plan -->
            <div class="pricing-card card featured fade-in-up" style="animation-delay: 0.2s">
                <div class="pricing-badge">MOST POPULAR</div>
                <div class="pricing-header">
                    <h3>Premium</h3>
                    <div class="pricing-price">$99<span>/month</span></div>
                    <p>For growing businesses</p>
                </div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> All Core Modules</li>
                    <li><i class="fas fa-check"></i> Up to 100 Users</li>
                    <li><i class="fas fa-check"></i> 200GB Storage</li>
                    <li><i class="fas fa-check"></i> 24/7 Premium Support</li>
                    <li><i class="fas fa-check"></i> All Support Channels</li>
                    <li><i class="fas fa-check"></i> Advanced Reports</li>
                    <li><i class="fas fa-check"></i> API Access</li>
                    <li><i class="fas fa-check"></i> Custom Workflows</li>
                </ul>
                <div class="pricing-footer">
                    <a href="register.php" class="btn btn-primary btn-block">Get Started</a>
                </div>
            </div>

            <!-- Enterprise Plan -->
            <div class="pricing-card card fade-in-up" style="animation-delay: 0.3s">
                <div class="pricing-header">
                    <h3>Enterprise</h3>
                    <div class="pricing-price">Custom</div>
                    <p>For large organizations</p>
                </div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> All Core Modules</li>
                    <li><i class="fas fa-check"></i> Unlimited Users</li>
                    <li><i class="fas fa-check"></i> 1TB+ Storage</li>
                    <li><i class="fas fa-check"></i> Dedicated Support</li>
                    <li><i class="fas fa-check"></i> All Support Channels</li>
                    <li><i class="fas fa-check"></i> Custom Reports</li>
                    <li><i class="fas fa-check"></i> Full API Access</li>
                    <li><i class="fas fa-check"></i> Custom Development</li>
                    <li><i class="fas fa-check"></i> On-premise Option</li>
                </ul>
                <div class="pricing-footer">
                    <a href="contact.php" class="btn btn-outline btn-block">Contact Sales</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Comparison -->
<section class="section section-light">
    <div class="container">
        <div class="section-title">
            <h2>Plan Comparison</h2>
            <p class="text-muted">See how our plans stack up</p>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="w-100">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>Free Trial</th>
                            <th>Basic</th>
                            <th>Premium</th>
                            <th>Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Users</td>
                            <td>Up to 10</td>
                            <td>Up to 25</td>
                            <td>Up to 100</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Storage</td>
                            <td>5GB</td>
                            <td>50GB</td>
                            <td>200GB</td>
                            <td>1TB+</td>
                        </tr>
                        <tr>
                            <td>Core Modules</td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td><i class="fas fa-check text-success"></i></td>
                        </tr>
                        <tr>
                            <td>Advanced Reports</td>
                            <td><i class="fas fa-times text-danger"></i></td>
                            <td>Basic</td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td><i class="fas fa-check text-success"></i></td>
                        </tr>
                        <tr>
                            <td>API Access</td>
                            <td><i class="fas fa-times text-danger"></i></td>
                            <td><i class="fas fa-times text-danger"></i></td>
                            <td>Limited</td>
                            <td>Full</td>
                        </tr>
                        <tr>
                            <td>Support</td>
                            <td>Email</td>
                            <td>Email & Chat</td>
                            <td>24/7 Priority</td>
                            <td>Dedicated</td>
                        </tr>
                        <tr>
                            <td>Custom Workflows</td>
                            <td><i class="fas fa-times text-danger"></i></td>
                            <td><i class="fas fa-times text-danger"></i></td>
                            <td>5 Workflows</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>SLA Guarantee</td>
                            <td>-</td>
                            <td>99%</td>
                            <td>99.9%</td>
                            <td>99.99%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Frequently Asked Questions</h2>
            <p class="text-muted">Common questions about pricing and plans</p>
        </div>

        <div class="grid grid-2 gap-4">
            <div class="card">
                <h4>Can I change plans later?</h4>
                <p>Yes! You can upgrade or downgrade your plan at any time. Changes take effect immediately, and we'll
                    prorate any differences.</p>
            </div>
            <div class="card">
                <h4>Is there a setup fee?</h4>
                <p>No setup fees for any of our plans. You only pay the monthly subscription fee. Enterprise plans may
                    have implementation fees for custom requirements.</p>
            </div>
            <div class="card">
                <h4>What payment methods do you accept?</h4>
                <p>We accept all major credit cards (Visa, MasterCard, American Express), PayPal, and bank transfers for
                    enterprise customers.</p>
            </div>
            <div class="card">
                <h4>Can I cancel anytime?</h4>
                <p>Yes, you can cancel your subscription at any time. There are no long-term contracts or cancellation
                    fees.</p>
            </div>
            <div class="card">
                <h4>Is my data secure?</h4>
                <p>We use enterprise-grade security with encryption at rest and in transit. Regular backups and SOC 2
                    compliance ensure your data is always protected.</p>
            </div>
            <div class="card">
                <h4>Do you offer discounts for non-profits?</h4>
                <p>Yes! We offer special pricing for registered non-profit organizations. Contact our sales team for
                    more information.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section section-dark">
    <div class="container">
        <div class="text-center">
            <h2>Start Your Free Trial Today</h2>
            <p class="mb-4">No credit card required • Full access to all features • 14 days free</p>
            <a href="register.php" class="btn btn-secondary btn-lg">
                <i class="fas fa-rocket"></i> Get Started Now
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>