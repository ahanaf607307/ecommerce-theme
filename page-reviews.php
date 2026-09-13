<?php
/**
 * Template Name: Customer Reviews & Community
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$community_reviews = [
    [
        'name'     => 'Marcus Vance',
        'role'     => 'Lead Sound Designer, London',
        'avatar'   => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&h=150&q=80',
        'product'  => 'Apex Pro Wireless Studio Headphones',
        'rating'   => 5,
        'title'    => '“The low-end clarity is unmatched at this price.”',
        'content'  => 'I mix orchestral scores and electronic music daily. The transient response on these beryllium drivers lets me detect phase issues immediately. Incredible passive and active noise cancellation.',
        'date'     => '2 days ago'
    ],
    [
        'name'     => 'Elena Rostova',
        'role'     => 'Software Architect, Berlin',
        'avatar'   => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&h=150&q=80',
        'product'  => 'Chronos Ultra Smartwatch Gen 4',
        'rating'   => 5,
        'title'    => '“Finally a smartwatch that looks like high horology.”',
        'content'  => 'The brushed Grade 5 titanium case paired with the sapphire screen is breathtaking. The 14-day battery life means I don’t stress about chargers during week-long summit hikes.',
        'date'     => '1 week ago'
    ],
    [
        'name'     => 'David Sterling',
        'role'     => 'Industrial Designer, San Francisco',
        'avatar'   => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&h=150&q=80',
        'product'  => 'Veloce Mechanical Keyboard & Lumbar Lamp',
        'rating'   => 5,
        'title'    => '“Transformed my desk into a sanctuary of focus.”',
        'content'  => 'The acoustic gasket mount delivers that deep, marble-like sound signature. Accompanied by the zero-glare desk bar, my productivity has surged. High-craft manufacturing.',
        'date'     => '2 weeks ago'
    ],
    [
        'name'     => 'Samantha Chen',
        'role'     => 'Creative Director, Tokyo',
        'avatar'   => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=150&h=150&q=80',
        'product'  => 'SonicAir True Wireless Earbuds',
        'rating'   => 5,
        'title'    => '“Transparency mode feels 100% natural.”',
        'content'  => 'I’ve had trouble with ear fatigue with other flagship earbuds. These fit like a custom molded IEM. Mic quality for Zoom calls on the Shinkansen is flawless.',
        'date'     => '3 weeks ago'
    ],
    [
        'name'     => 'Julian Miller',
        'role'     => 'Full Stack Engineer, Austin',
        'avatar'   => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=150&h=150&q=80',
        'product'  => 'Orbit Magnetic Wireless Desk Charger',
        'rating'   => 5,
        'title'    => '“Machined from a single slab of aluminum. Perfection.”',
        'content'  => 'Heavy enough that it doesn’t lift off the desk when grabbing your iPhone. Fast 15W charging speed and charges all 3 devices simultaneously without heating up.',
        'date'     => '1 month ago'
    ],
    [
        'name'     => 'Aria Montclaire',
        'role'     => 'Photographer, Paris',
        'avatar'   => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=150&h=150&q=80',
        'product'  => 'Nomad Weatherproof Tech Sling Bag',
        'rating'   => 5,
        'title'    => '“Survived torrential rains in Iceland with gear bone dry.”',
        'content'  => 'The Fidlock magnetic buckle snaps into place with satisfying precision. Fits my mirrorless body and two lenses comfortably. Beautiful minimalist silhouette.',
        'date'     => '1 month ago'
    ]
];
?>

<div class="page-header-banner">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-house"></i> Home</a>
            <span class="bc-sep"><i class="fa-solid fa-chevron-right"></i></span>
            <span class="bc-current">Community Reviews &amp; Feedback</span>
        </div>
        <h1 class="page-banner-title">Verified Customer Reviews</h1>
        <p class="page-banner-desc">Real stories and unedited impressions from 50,000+ creators and everyday tech connoisseurs.</p>
    </div>
</div>

<main class="site-main py-8">
    <div class="container">
        <!-- Big Stat Scoreboard -->
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
                <span class="stat-sub">Customers who would purchase again</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-col">
                <span class="stat-large">&lt; 0.2%</span>
                <span class="stat-highlight">Defect Rate</span>
                <span class="stat-sub">Aerospace Grade-A QA standards</span>
            </div>
        </div>

        <!-- Write Review Callout -->
        <div class="write-review-bar">
            <div>
                <h3>Own a piece of VELOX hardware?</h3>
                <p>Share your experience with our engineering team and get 15% off your next purchase.</p>
            </div>
            <button type="button" class="btn btn-primary" id="open-review-form-btn">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Write a Review</span>
            </button>
        </div>

        <!-- Interactive Review Submission Modal / Form Container -->
        <div class="review-form-box" id="review-submission-box" style="display: none;">
            <div class="review-form-card">
                <h3>Submit Your Hardware Review</h3>
                <form id="community-review-form">
                    <div class="form-row-2">
                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" placeholder="e.g. Marcus Vance" required>
                        </div>
                        <div class="form-group">
                            <label>Your Profession / Location</label>
                            <input type="text" placeholder="e.g. Sound Engineer, London">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Hardware Model</label>
                        <select required>
                            <option value="Apex Pro Wireless Headphones">Apex Pro Wireless Studio Headphones</option>
                            <option value="Chronos Ultra Smartwatch Gen 4">Chronos Ultra Smartwatch Gen 4</option>
                            <option value="SonicAir True Wireless ANC Earbuds">SonicAir True Wireless ANC Earbuds</option>
                            <option value="Orbit Magnetic Wireless Desk Charger">Orbit Magnetic Wireless Desk Charger</option>
                            <option value="Veloce Minimalist Mechanical Keyboard">Veloce Minimalist Mechanical Keyboard</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Review Headline</label>
                        <input type="text" placeholder="e.g. The soundstage rivals reference monitors" required>
                    </div>
                    <div class="form-group">
                        <label>Detailed Feedback</label>
                        <textarea rows="4" placeholder="Tell us how the hardware performed in your daily work..." required></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Submit Verified Review</button>
                        <button type="button" class="btn btn-secondary" id="close-review-form-btn">Cancel</button>
                    </div>
                </form>
                <div id="review-form-success" class="newsletter-success-toast" style="display:none; margin-top: 1rem;">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Thank you! Your verified review has been submitted for moderation.</span>
                </div>
            </div>
        </div>

        <!-- Reviews Grid -->
        <div class="testimonials-grid">
            <?php foreach ($community_reviews as $rev) : ?>
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <?php for ($i = 0; $i < $rev['rating']; $i++) : ?>
                            <i class="fa-solid fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <h3 class="testimonial-headline"><?php echo esc_html($rev['title']); ?></h3>
                    <p class="testimonial-body"><?php echo esc_html($rev['content']); ?></p>
                    <div class="testimonial-footer">
                        <img src="<?php echo esc_url($rev['avatar']); ?>" alt="<?php echo esc_attr($rev['name']); ?>" class="reviewer-avatar">
                        <div class="reviewer-meta">
                            <span class="reviewer-name"><?php echo esc_html($rev['name']); ?> <i class="fa-solid fa-circle-check verified-icon" title="Verified Buyer"></i></span>
                            <span class="reviewer-role"><?php echo esc_html($rev['role']); ?></span>
                            <span class="reviewer-product"><?php echo esc_html($rev['product']); ?> &bull; <?php echo esc_html($rev['date']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('open-review-form-btn');
    const closeBtn = document.getElementById('close-review-form-btn');
    const formBox = document.getElementById('review-submission-box');
    const form = document.getElementById('community-review-form');
    const successMsg = document.getElementById('review-form-success');

    if (openBtn && formBox) {
        openBtn.addEventListener('click', () => {
            formBox.style.display = formBox.style.display === 'none' ? 'block' : 'none';
            if (formBox.style.display === 'block') {
                formBox.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }
    if (closeBtn && formBox) {
        closeBtn.addEventListener('click', () => {
            formBox.style.display = 'none';
        });
    }
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            form.style.display = 'none';
            if (successMsg) successMsg.style.display = 'inline-flex';
        });
    }
});
</script>

<?php get_footer(); ?>
