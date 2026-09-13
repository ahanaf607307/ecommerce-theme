<?php
/**
 * Customer Reviews & Testimonials Template Part
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$testimonials = [
    [
        'author'   => 'Marcus Vance',
        'role'     => 'Music Producer & Sound Designer, London',
        'avatar'   => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&h=150&q=80',
        'product'  => 'Apex Pro Wireless Headphones',
        'rating'   => 5,
        'headline' => '“The soundstage rivals $1,000 reference monitors.”',
        'review'   => 'I’ve tested dozens of high-end studio headphones in my career. The beryllium drivers in the Apex Pro deliver transient clarity that allows me to catch low-end mud instantly. ANC is uncanny, and the 60-hour battery means I charge it twice a month.'
    ],
    [
        'author'   => 'Elena Rostova',
        'role'     => 'Software Architect & Digital Nomad, Berlin',
        'avatar'   => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&h=150&q=80',
        'product'  => 'Chronos Ultra Smartwatch & Orbit Charger',
        'rating'   => 5,
        'headline' => '“Indestructible titanium build with sublime aesthetics.”',
        'review'   => 'The Chronos Gen 4 has survived mountaineering in the Alps and intense open-water swims. The battery consistently hits 14 days, and the magnetic Orbit dock makes charging effortless. Truly heirloom-grade hardware.'
    ],
    [
        'author'   => 'David Sterling',
        'role'     => 'Industrial Designer, San Francisco',
        'avatar'   => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&h=150&q=80',
        'product'  => 'Veloce Mechanical Keyboard & Lumbar Lamp',
        'rating'   => 5,
        'headline' => '“Transformed my desk into a sanctuary of focus.”',
        'review'   => 'The tactile acoustic dampening on the keyboard feels creamy and satisfying without disturbing colleagues. Paired with the zero-glare Lumbar desk lamp, eye fatigue is completely gone. 10/10 recommendation.'
    ]
];

$faqs = [
    [
        'q' => 'How long does worldwide express shipping take?',
        'a' => 'All orders placed before 2 PM EST are dispatched same day via DHL Express or FedEx Priority. Delivery typically takes 2–3 business days across the US, Canada, EU, and UK.'
    ],
    [
        'q' => 'What is your 30-day trial and return policy?',
        'a' => 'We want you to test our products in your everyday life. If you are not completely blown away, simply initiate a return within 30 days for a 100% full refund. Prepaid return shipping labels are included.'
    ],
    [
        'q' => 'Are all products covered by the 2-year warranty?',
        'a' => 'Yes! Every purchase is automatically registered for our 2-Year Full Hardware Warranty covering driver degradation, internal components, battery life, and manufacturing craftsmanship.'
    ],
    [
        'q' => 'Can I use the coupon code with bundle discounts?',
        'a' => 'Yes! Our flash coupon code LUXE50 stacks with our already discounted bundle packs for an extra 15% off at checkout.'
    ]
];
?>
<section id="reviews" class="section-reviews">
    <div class="container">
        <!-- Section Header -->
        <div class="section-heading-centered">
            <span class="section-badge"><i class="fa-solid fa-star"></i> VERIFIED COMMUNITY REVIEWS</span>
            <h2 class="section-title">Trusted By 50,000+ Creators</h2>
            <p class="section-subtitle">Real feedback from producers, designers, engineers, and everyday tech enthusiasts.</p>
        </div>

        <!-- Aggregate Score Bar -->
        <div class="reviews-stats-bar">
            <div class="stat-col">
                <span class="stat-large">4.92<span class="stat-out-of">/5</span></span>
                <div class="stat-stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <span class="stat-sub">Based on 18,400+ Verified Reviews</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-col">
                <span class="stat-large">98.4%</span>
                <span class="stat-highlight">Recommendation Rate</span>
                <span class="stat-sub">Customers who would buy again</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-col">
                <span class="stat-large">&lt; 0.2%</span>
                <span class="stat-highlight">Defect Rate</span>
                <span class="stat-sub">Grade-A aerospace QA standards</span>
            </div>
        </div>

        <!-- Testimonials Grid -->
        <div class="testimonials-grid">
            <?php foreach ($testimonials as $item) : ?>
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <?php for ($i = 0; $i < $item['rating']; $i++) : ?>
                            <i class="fa-solid fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <h3 class="testimonial-headline"><?php echo esc_html($item['headline']); ?></h3>
                    <p class="testimonial-body"><?php echo esc_html($item['review']); ?></p>
                    <div class="testimonial-footer">
                        <img src="<?php echo esc_url($item['avatar']); ?>" alt="<?php echo esc_attr($item['author']); ?>" class="reviewer-avatar">
                        <div class="reviewer-meta">
                            <span class="reviewer-name"><?php echo esc_html($item['author']); ?> <i class="fa-solid fa-circle-check verified-icon" title="Verified Buyer"></i></span>
                            <span class="reviewer-role"><?php echo esc_html($item['role']); ?></span>
                            <span class="reviewer-product">Purchased: <?php echo esc_html($item['product']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Conversion FAQ Section -->
        <div class="faq-section">
            <div class="faq-header">
                <span class="section-badge"><i class="fa-solid fa-circle-question"></i> COMMON QUESTIONS</span>
                <h3 class="faq-title">Frequently Asked Questions</h3>
            </div>
            <div class="faq-accordion" id="faq-accordion">
                <?php foreach ($faqs as $index => $faq) : ?>
                    <div class="faq-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <button type="button" class="faq-question">
                            <span><?php echo esc_html($faq['q']); ?></span>
                            <i class="fa-solid fa-chevron-down faq-chevron"></i>
                        </button>
                        <div class="faq-answer" <?php echo $index === 0 ? 'style="display: block;"' : ''; ?>>
                            <p><?php echo esc_html($faq['a']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
