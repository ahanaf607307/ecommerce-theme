/**
 * VELOX ECOMMERCE THEME - MAIN JAVASCRIPT
 * Version: 1.0.0
 * Pure Vanilla JavaScript: Cart State, Quick View, Search, Countdown, Filters & Toasts
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    // Global Theme Configuration (Fallback if not localized by WP)
    const config = window.ecommerceConfig || {
        currencySymbol: '$',
        freeShippingThreshold: 99,
        discountCode: 'LUXE50',
        discountRate: 0.15
    };

    // ==========================================================================
    // 1. STATE MANAGEMENT (LOCAL STORAGE)
    // ==========================================================================
    const STORAGE_KEY_CART = 'velox_ecommerce_cart_v1';
    const STORAGE_KEY_WISHLIST = 'velox_ecommerce_wishlist_v1';
    const STORAGE_KEY_PROMO = 'velox_ecommerce_promo_v1';

    let cartState = JSON.parse(localStorage.getItem(STORAGE_KEY_CART) || '[]');
    let wishlistState = JSON.parse(localStorage.getItem(STORAGE_KEY_WISHLIST) || '[]');
    let activePromo = JSON.parse(localStorage.getItem(STORAGE_KEY_PROMO) || 'null');

    function saveCart() {
        localStorage.setItem(STORAGE_KEY_CART, JSON.stringify(cartState));
        renderCartUI();
    }

    function saveWishlist() {
        localStorage.setItem(STORAGE_KEY_WISHLIST, JSON.stringify(wishlistState));
        updateWishlistBadge();
    }

    function savePromo(promo) {
        activePromo = promo;
        if (promo) {
            localStorage.setItem(STORAGE_KEY_PROMO, JSON.stringify(promo));
        } else {
            localStorage.removeItem(STORAGE_KEY_PROMO);
        }
        renderCartUI();
    }

    // ==========================================================================
    // 2. DOM CACHE
    // ==========================================================================
    const header = document.getElementById('main-header');
    const backToTopBtn = document.getElementById('back-to-top-btn');
    const announcementBar = document.getElementById('announcement-bar');
    const announcementClose = document.getElementById('announcement-close');
    const promoCopyBtn = document.getElementById('promo-copy-btn');

    // Cart Drawer Elements
    const cartDrawer = document.getElementById('cart-drawer');
    const cartTrigger = document.getElementById('cart-drawer-trigger');
    const cartCloseBtn = document.getElementById('cart-drawer-close');
    const cartBackdrop = document.getElementById('cart-backdrop');
    const cartItemsContainer = document.getElementById('cart-items-container');
    const cartPanelFooter = document.getElementById('cart-panel-footer');
    const cartBadgeCount = document.getElementById('cart-badge-count');
    const headerCartTotal = document.getElementById('header-cart-total');
    const cartDrawerCount = document.getElementById('cart-drawer-count');
    const cartSubtotalVal = document.getElementById('cart-subtotal-val');
    const cartTotalVal = document.getElementById('cart-total-val');
    const checkoutBtnAmount = document.getElementById('checkout-btn-amount');
    const shippingBarMessage = document.getElementById('shipping-bar-message');
    const shippingProgressFill = document.getElementById('shipping-progress-fill');
    const cartPromoForm = document.getElementById('cart-promo-form');
    const cartPromoInput = document.getElementById('cart-promo-input');
    const cartPromoFeedback = document.getElementById('cart-promo-feedback');
    const cartDiscountRow = document.getElementById('cart-discount-row');
    const cartDiscountVal = document.getElementById('cart-discount-val');
    const cartShippingVal = document.getElementById('cart-shipping-val');
    const cartCheckoutBtn = document.getElementById('cart-checkout-btn');

    // Wishlist Badge
    const wishlistBadgeCount = document.getElementById('wishlist-badge-count');

    // Quick View Elements
    const quickviewModal = document.getElementById('quickview-modal');
    const quickviewBackdrop = document.getElementById('quickview-backdrop');
    const quickviewClose = document.getElementById('quickview-close');
    const qvMainImg = document.getElementById('quickview-main-img');
    const qvBadge = document.getElementById('quickview-badge');
    const qvThumbs = document.getElementById('quickview-thumbs');
    const qvCategory = document.getElementById('quickview-category');
    const qvStock = document.getElementById('quickview-stock');
    const qvTitle = document.getElementById('quickview-title');
    const qvRating = document.getElementById('quickview-rating');
    const qvReviews = document.getElementById('quickview-reviews');
    const qvPrice = document.getElementById('quickview-price');
    const qvRegularPrice = document.getElementById('quickview-regular-price');
    const qvDiscountPill = document.getElementById('quickview-discount-pill');
    const qvDesc = document.getElementById('quickview-desc');
    const qvSwatches = document.getElementById('quickview-swatches');
    const qvSelectedColor = document.getElementById('quickview-selected-color');
    const qvFeaturesList = document.getElementById('quickview-features-list');
    const qvQtyInput = document.getElementById('qv-qty-input');
    const qvQtyMinus = document.getElementById('qv-qty-minus');
    const qvQtyPlus = document.getElementById('qv-qty-plus');
    const qvAddToCartBtn = document.getElementById('quickview-add-to-cart-btn');
    const qvButtonPrice = document.getElementById('qv-button-price');

    // Search Modal Elements
    const searchModal = document.getElementById('search-modal');
    const searchTriggerBtn = document.getElementById('search-trigger-btn');
    const closeSearchModal = document.getElementById('close-search-modal');
    const searchModalBackdrop = document.getElementById('search-modal-backdrop');
    const liveSearchInput = document.getElementById('live-search-input');
    const clearSearchBtn = document.getElementById('clear-search-btn');
    const searchResultsContainer = document.getElementById('search-results-container');
    const searchTags = document.querySelectorAll('.search-tag');

    // Mobile Menu
    const mobileDrawer = document.getElementById('mobile-drawer');
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileDrawerClose = document.getElementById('mobile-drawer-close');
    const mobileDrawerOverlay = document.getElementById('mobile-drawer-overlay');

    // Product Cards Cache
    const productCards = Array.from(document.querySelectorAll('.product-card'));
    let activeQuickViewProduct = null;

    // ==========================================================================
    // 3. TOAST NOTIFICATION SYSTEM
    // ==========================================================================
    const toastContainer = document.getElementById('ecommerce-toast-container');

    function showToast(title, subtitle, image = '') {
        const toast = document.createElement('div');
        toast.className = 'ecommerce-toast';
        toast.innerHTML = `
            ${image ? `<img src="${image}" alt="${title}" class="toast-thumb">` : `<i class="fa-solid fa-circle-check text-accent" style="font-size: 1.5rem;"></i>`}
            <div class="toast-info">
                <div class="toast-title">${title}</div>
                <div class="toast-status"><i class="fa-solid fa-check"></i> ${subtitle}</div>
            </div>
            <button type="button" class="toast-close-btn" aria-label="Dismiss">&times;</button>
        `;

        toast.querySelector('.toast-close-btn').addEventListener('click', () => {
            removeToast(toast);
        });

        toastContainer.appendChild(toast);

        setTimeout(() => {
            removeToast(toast);
        }, 4000);
    }

    function removeToast(toast) {
        if (!toast || toast.classList.contains('fade-out')) return;
        toast.classList.add('fade-out');
        setTimeout(() => {
            if (toast.parentElement) {
                toast.parentElement.removeChild(toast);
            }
        }, 300);
    }

    // ==========================================================================
    // 4. HEADER & SCROLL BEHAVIOR
    // ==========================================================================
    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        if (scrollY > 40) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        if (scrollY > 500) {
            backToTopBtn.classList.add('visible');
        } else {
            backToTopBtn.classList.remove('visible');
        }
    }, { passive: true });

    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Announcement Bar Close & Promo Copy
    if (announcementClose) {
        announcementClose.addEventListener('click', () => {
            announcementBar.style.display = 'none';
        });
    }

    if (promoCopyBtn) {
        promoCopyBtn.addEventListener('click', () => {
            navigator.clipboard.writeText('LUXE50').then(() => {
                showToast('Coupon Copied!', 'Use LUXE50 for 15% off at checkout');
            });
        });
    }

    // Mobile Navigation Drawer
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', () => {
            mobileDrawer.classList.add('open');
            document.body.style.overflow = 'hidden';
        });
    }
    const closeMobileNav = () => {
        mobileDrawer.classList.remove('open');
        document.body.style.overflow = '';
    };
    if (mobileDrawerClose) mobileDrawerClose.addEventListener('click', closeMobileNav);
    if (mobileDrawerOverlay) mobileDrawerOverlay.addEventListener('click', closeMobileNav);
    document.querySelectorAll('.mobile-nav-link').forEach(link => {
        link.addEventListener('click', closeMobileNav);
    });

    // ==========================================================================
    // 5. SHOPPING CART SYSTEM
    // ==========================================================================
    function openCartDrawer() {
        cartDrawer.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeCartDrawer() {
        cartDrawer.classList.remove('open');
        document.body.style.overflow = '';
    }

    if (cartTrigger) cartTrigger.addEventListener('click', openCartDrawer);
    if (cartCloseBtn) cartCloseBtn.addEventListener('click', closeCartDrawer);
    if (cartBackdrop) cartBackdrop.addEventListener('click', closeCartDrawer);

    function addToCart(productData, qty = 1, chosenColor = '') {
        const id = productData.id;
        const color = chosenColor || (productData.colorNames ? productData.colorNames[0] : 'Default');
        const cartItemId = `${id}_${color.toLowerCase().replace(/\s+/g, '-')}`;

        const existingItem = cartState.find(item => item.cartItemId === cartItemId);
        if (existingItem) {
            existingItem.qty += qty;
        } else {
            cartState.push({
                cartItemId,
                id: productData.id,
                title: productData.title,
                price: parseFloat(productData.price),
                image: productData.image,
                color: color,
                qty: qty
            });
        }

        saveCart();
        showToast(productData.title, `Added ${qty > 1 ? qty + ' units' : ''} to your bag`, productData.image);
        openCartDrawer();
    }

    function updateCartItemQty(cartItemId, delta) {
        const item = cartState.find(i => i.cartItemId === cartItemId);
        if (!item) return;

        item.qty += delta;
        if (item.qty <= 0) {
            cartState = cartState.filter(i => i.cartItemId !== cartItemId);
        }
        saveCart();
    }

    function removeCartItem(cartItemId) {
        cartState = cartState.filter(i => i.cartItemId !== cartItemId);
        saveCart();
    }

    function renderCartUI() {
        const totalCount = cartState.reduce((sum, item) => sum + item.qty, 0);
        const subtotal = cartState.reduce((sum, item) => sum + (item.price * item.qty), 0);

        // Update badges
        if (cartBadgeCount) cartBadgeCount.textContent = totalCount;
        if (cartDrawerCount) cartDrawerCount.textContent = `${totalCount} ${totalCount === 1 ? 'item' : 'items'}`;
        if (headerCartTotal) headerCartTotal.textContent = `${config.currencySymbol}${subtotal.toFixed(2)}`;

        // Check if empty
        if (cartState.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="cart-empty-state">
                    <div class="empty-icon-wrap">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <h4>Your Bag Is Empty</h4>
                    <p>Explore our flagship headphones, smart wearables, and EDC gear to get started.</p>
                    <a href="#products" class="btn btn-primary btn-sm" id="cart-start-shopping">
                        <span>Explore Products</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            `;
            const startShopBtn = document.getElementById('cart-start-shopping');
            if (startShopBtn) {
                startShopBtn.addEventListener('click', closeCartDrawer);
            }
            if (cartPanelFooter) cartPanelFooter.style.display = 'none';

            // Free shipping bar reset
            shippingProgressFill.style.width = '0%';
            shippingBarMessage.innerHTML = `<i class="fa-solid fa-truck-fast"></i> <span>Add <strong>${config.currencySymbol}${config.freeShippingThreshold.toFixed(2)}</strong> more for <strong>Free Express Shipping</strong></span>`;
            return;
        }

        // Has items: show footer
        if (cartPanelFooter) cartPanelFooter.style.display = 'block';

        // Render Item List
        let itemsHtml = '';
        cartState.forEach(item => {
            itemsHtml += `
                <div class="cart-item-row" data-cart-id="${item.cartItemId}">
                    <img src="${item.image}" alt="${item.title}" class="cart-item-img">
                    <div class="cart-item-info">
                        <h4 class="cart-item-title">${item.title}</h4>
                        <span class="cart-item-color">Variant: ${item.color}</span>
                        <div class="cart-item-bottom">
                            <div class="cart-item-qty">
                                <button type="button" class="qty-mini-btn btn-cart-minus" data-cart-id="${item.cartItemId}"><i class="fa-solid fa-minus"></i></button>
                                <span class="qty-mini-num">${item.qty}</span>
                                <button type="button" class="qty-mini-btn btn-cart-plus" data-cart-id="${item.cartItemId}"><i class="fa-solid fa-plus"></i></button>
                            </div>
                            <span class="cart-item-price">${config.currencySymbol}${(item.price * item.qty).toFixed(2)}</span>
                        </div>
                    </div>
                    <button type="button" class="cart-item-remove btn-cart-remove" data-cart-id="${item.cartItemId}" aria-label="Remove item">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </div>
            `;
        });
        cartItemsContainer.innerHTML = itemsHtml;

        // Attach item event listeners
        cartItemsContainer.querySelectorAll('.btn-cart-minus').forEach(btn => {
            btn.addEventListener('click', () => updateCartItemQty(btn.dataset.cartId, -1));
        });
        cartItemsContainer.querySelectorAll('.btn-cart-plus').forEach(btn => {
            btn.addEventListener('click', () => updateCartItemQty(btn.dataset.cartId, 1));
        });
        cartItemsContainer.querySelectorAll('.btn-cart-remove').forEach(btn => {
            btn.addEventListener('click', () => removeCartItem(btn.dataset.cartId));
        });

        // Shipping Bar Calculation
        const threshold = config.freeShippingThreshold;
        if (subtotal >= threshold) {
            shippingProgressFill.style.width = '100%';
            shippingBarMessage.innerHTML = `<i class="fa-solid fa-circle-check text-accent"></i> <span><strong>Free Express Shipping Unlocked!</strong></span>`;
            if (cartShippingVal) cartShippingVal.innerHTML = `<span style="color:#10b981;font-weight:700;">FREE</span>`;
        } else {
            const diff = threshold - subtotal;
            const pct = Math.min(100, Math.round((subtotal / threshold) * 100));
            shippingProgressFill.style.width = `${pct}%`;
            shippingBarMessage.innerHTML = `<i class="fa-solid fa-truck-fast"></i> <span>Add <strong>${config.currencySymbol}${diff.toFixed(2)}</strong> more for <strong>Free Express Shipping</strong></span>`;
            if (cartShippingVal) cartShippingVal.textContent = `${config.currencySymbol}9.99`;
        }

        // Subtotal & Discount Calculation
        let discountAmt = 0;
        if (activePromo) {
            discountAmt = subtotal * activePromo.rate;
            if (cartDiscountRow) cartDiscountRow.style.display = 'flex';
            if (cartDiscountVal) cartDiscountVal.textContent = `-${config.currencySymbol}${discountAmt.toFixed(2)}`;
        } else {
            if (cartDiscountRow) cartDiscountRow.style.display = 'none';
        }

        const shippingCost = subtotal >= threshold ? 0 : 9.99;
        const total = Math.max(0, subtotal - discountAmt + shippingCost);

        if (cartSubtotalVal) cartSubtotalVal.textContent = `${config.currencySymbol}${subtotal.toFixed(2)}`;
        if (cartTotalVal) cartTotalVal.textContent = `${config.currencySymbol}${total.toFixed(2)}`;
        if (checkoutBtnAmount) checkoutBtnAmount.textContent = `${config.currencySymbol}${total.toFixed(2)}`;
    }

    // Promo Code Form
    if (cartPromoForm) {
        cartPromoForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const inputVal = cartPromoInput.value.trim().toUpperCase();
            if (inputVal === config.discountCode) {
                savePromo({ code: inputVal, rate: config.discountRate });
                cartPromoFeedback.className = 'promo-feedback success';
                cartPromoFeedback.textContent = `Coupon ${inputVal} applied! 15% off order.`;
                showToast('Promo Code Applied', '15% discount has been deducted from your order.');
            } else {
                cartPromoFeedback.className = 'promo-feedback error';
                cartPromoFeedback.textContent = 'Invalid promo code. Try LUXE50';
            }
        });
    }

    // Checkout Button
    if (cartCheckoutBtn) {
        cartCheckoutBtn.addEventListener('click', () => {
            showToast('Initiating Checkout', 'Connecting to 256-Bit SSL Secure Gateway...');
            setTimeout(() => {
                alert('Thank you for testing the VELOX Ecommerce Theme! In a live WooCommerce setup, this redirects to the WooCommerce checkout page.');
            }, 1000);
        });
    }

    // ==========================================================================
    // 6. WISHLIST SYSTEM
    // ==========================================================================
    function updateWishlistBadge() {
        if (wishlistBadgeCount) {
            wishlistBadgeCount.textContent = wishlistState.length;
        }
        document.querySelectorAll('.btn-wishlist-toggle').forEach(btn => {
            const id = btn.dataset.id;
            if (wishlistState.includes(id)) {
                btn.classList.add('active');
                btn.innerHTML = '<i class="fa-solid fa-heart"></i>';
            } else {
                btn.classList.remove('active');
                btn.innerHTML = '<i class="fa-regular fa-heart"></i>';
            }
        });
    }

    function toggleWishlist(productId, productTitle) {
        const idx = wishlistState.indexOf(productId);
        if (idx > -1) {
            wishlistState.splice(idx, 1);
            showToast(productTitle || 'Item', 'Removed from your wishlist');
        } else {
            wishlistState.push(productId);
            showToast(productTitle || 'Item', 'Saved to your wishlist');
        }
        saveWishlist();
    }

    document.querySelectorAll('.btn-wishlist-toggle').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const id = btn.dataset.id;
            const card = btn.closest('.product-card');
            const title = card ? card.dataset.title : '';
            toggleWishlist(id, title);
        });
    });

    const wishlistTriggerBtn = document.getElementById('wishlist-trigger-btn');
    if (wishlistTriggerBtn) {
        wishlistTriggerBtn.addEventListener('click', () => {
            if (wishlistState.length === 0) {
                showToast('Wishlist is empty', 'Click the heart icon on any product to save items.');
            } else {
                showToast('Wishlist Active', `You have ${wishlistState.length} saved item(s).`);
            }
        });
    }

    // ==========================================================================
    // 7. PRODUCT QUICK VIEW MODAL
    // ==========================================================================
    function openQuickView(productData) {
        activeQuickViewProduct = productData;
        qvTitle.textContent = productData.title;
        qvCategory.textContent = productData.categoryName || 'Flagship';
        qvRating.textContent = productData.rating;
        qvReviews.textContent = `(${productData.reviews} reviews)`;
        qvPrice.textContent = `${config.currencySymbol}${productData.price}`;
        qvRegularPrice.textContent = `${config.currencySymbol}${productData.regularPrice}`;
        qvDesc.textContent = productData.desc;
        qvQtyInput.value = '1';
        qvButtonPrice.textContent = `${config.currencySymbol}${productData.price}`;

        // Stock
        if (productData.stock <= 5) {
            qvStock.textContent = `Only ${productData.stock} left in stock!`;
            qvStock.style.color = '#f59e0b';
        } else {
            qvStock.textContent = 'In Stock - Ready to Ship';
            qvStock.style.color = '#10b981';
        }

        // Gallery
        const gallery = productData.gallery || [productData.image];
        qvMainImg.src = gallery[0];
        let thumbsHtml = '';
        gallery.forEach((url, i) => {
            thumbsHtml += `<img src="${url}" alt="Thumb" class="qv-thumb ${i === 0 ? 'active' : ''}" data-src="${url}">`;
        });
        qvThumbs.innerHTML = thumbsHtml;

        qvThumbs.querySelectorAll('.qv-thumb').forEach(thumb => {
            thumb.addEventListener('click', () => {
                qvThumbs.querySelectorAll('.qv-thumb').forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');
                qvMainImg.src = thumb.dataset.src;
            });
        });

        // Colors
        const colors = productData.colors || ['#000000'];
        const colorNames = productData.colorNames || ['Default'];
        qvSelectedColor.textContent = colorNames[0];

        let swatchesHtml = '';
        colors.forEach((hex, i) => {
            swatchesHtml += `
                <button type="button" class="qv-swatch-btn ${i === 0 ? 'active' : ''}" 
                    style="background-color: ${hex};" 
                    data-color="${colorNames[i]}" 
                    title="${colorNames[i]}"
                    aria-label="Select color ${colorNames[i]}"></button>
            `;
        });
        qvSwatches.innerHTML = swatchesHtml;

        qvSwatches.querySelectorAll('.qv-swatch-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                qvSwatches.querySelectorAll('.qv-swatch-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                qvSelectedColor.textContent = btn.dataset.color;
            });
        });

        // Features
        const features = productData.features || ['Studio Performance', 'Fast Shipping', '2-Year Warranty'];
        let featsHtml = '';
        features.forEach(f => {
            featsHtml += `<li><i class="fa-solid fa-check"></i> ${f}</li>`;
        });
        qvFeaturesList.innerHTML = featsHtml;

        quickviewModal.classList.add('open');
        quickviewModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeQuickView() {
        quickviewModal.classList.remove('open');
        quickviewModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        activeQuickViewProduct = null;
    }

    if (quickviewClose) quickviewClose.addEventListener('click', closeQuickView);
    if (quickviewBackdrop) quickviewBackdrop.addEventListener('click', closeQuickView);

    // Quantity Picker in Quick View
    if (qvQtyMinus) {
        qvQtyMinus.addEventListener('click', () => {
            let val = parseInt(qvQtyInput.value, 10) || 1;
            if (val > 1) {
                qvQtyInput.value = val - 1;
                updateQvPrice();
            }
        });
    }
    if (qvQtyPlus) {
        qvQtyPlus.addEventListener('click', () => {
            let val = parseInt(qvQtyInput.value, 10) || 1;
            qvQtyInput.value = val + 1;
            updateQvPrice();
        });
    }

    function updateQvPrice() {
        if (!activeQuickViewProduct) return;
        const qty = parseInt(qvQtyInput.value, 10) || 1;
        const total = (parseFloat(activeQuickViewProduct.price) * qty).toFixed(2);
        qvButtonPrice.textContent = `${config.currencySymbol}${total}`;
    }

    if (qvAddToCartBtn) {
        qvAddToCartBtn.addEventListener('click', () => {
            if (!activeQuickViewProduct) return;
            const qty = parseInt(qvQtyInput.value, 10) || 1;
            const chosenColor = qvSelectedColor.textContent;
            addToCart(activeQuickViewProduct, qty, chosenColor);
            closeQuickView();
        });
    }

    // Quick View triggers from Cards
    function extractCardData(card) {
        return {
            id: card.dataset.id,
            title: card.dataset.title,
            category: card.dataset.category,
            categoryName: card.querySelector('.card-category') ? card.querySelector('.card-category').textContent : '',
            price: parseFloat(card.dataset.price),
            regularPrice: parseFloat(card.dataset.regularPrice || card.dataset.price),
            image: card.dataset.image,
            rating: card.dataset.rating || '4.9',
            reviews: card.dataset.reviews || '100',
            desc: card.dataset.desc || '',
            stock: parseInt(card.dataset.stock, 10) || 10,
            colors: JSON.parse(card.dataset.colors || '[]'),
            colorNames: JSON.parse(card.dataset.colorNames || '[]'),
            gallery: JSON.parse(card.dataset.gallery || '[]'),
            features: JSON.parse(card.dataset.features || '[]')
        };
    }

    document.querySelectorAll('.btn-quickview, .quickview-link').forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            const id = trigger.dataset.id;
            const card = document.querySelector(`.product-card[data-id="${id}"]`);
            if (card) {
                openQuickView(extractCardData(card));
            }
        });
    });

    // Add to Cart from Product Cards
    document.querySelectorAll('.btn-add-cart').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const card = document.querySelector(`.product-card[data-id="${id}"]`);
            if (card) {
                const data = extractCardData(card);
                const activeColor = card.querySelector('.swatch-label') ? card.querySelector('.swatch-label').textContent : '';
                addToCart(data, 1, activeColor);
            }
        });
    });

    // Swatches on Cards
    document.querySelectorAll('.product-card').forEach(card => {
        const swatches = card.querySelectorAll('.swatch-circle');
        const label = card.querySelector('.swatch-label');
        swatches.forEach(swatch => {
            swatch.addEventListener('click', (e) => {
                e.stopPropagation();
                swatches.forEach(s => s.classList.remove('active'));
                swatch.classList.add('active');
                if (label && swatch.dataset.colorName) {
                    label.textContent = swatch.dataset.colorName;
                }
            });
        });
    });

    // ==========================================================================
    // 8. BUNDLE DEALS ACTIONS
    // ==========================================================================
    document.querySelectorAll('.btn-add-bundle').forEach(btn => {
        btn.addEventListener('click', () => {
            const itemIds = (btn.dataset.items || '').split(',');
            const bundleTitle = btn.dataset.bundleTitle || 'Hardware Bundle';
            const bundlePrice = parseFloat(btn.dataset.bundlePrice || '299');

            // Add bundle as a special discounted package
            cartState.push({
                cartItemId: `bundle_${Date.now()}`,
                id: `bundle-${Date.now()}`,
                title: `${bundleTitle} (Bundle Offer)`,
                price: bundlePrice,
                image: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=400&q=80',
                color: 'Curated Duo',
                qty: 1
            });
            saveCart();
            showToast(bundleTitle, 'Bundle offer added to bag with instant savings!');
            openCartDrawer();
        });
    });

    // ==========================================================================
    // 9. DYNAMIC CATEGORY & FILTER TABS
    // ==========================================================================
    const filterTabs = document.querySelectorAll('.filter-tab-btn');
    const categoryActionBtns = document.querySelectorAll('.cat-action-btn, .category-card');

    function applyFilter(categorySlug) {
        // Update tab buttons
        filterTabs.forEach(tab => {
            if (tab.dataset.filter === categorySlug) {
                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');
            } else {
                tab.classList.remove('active');
                tab.setAttribute('aria-selected', 'false');
            }
        });

        // Filter cards
        productCards.forEach(card => {
            const cardCat = card.dataset.category;
            if (categorySlug === 'all' || cardCat === categorySlug) {
                card.classList.remove('hidden');
                card.style.opacity = '0';
                setTimeout(() => {
                    card.style.transition = 'opacity 0.35s ease';
                    card.style.opacity = '1';
                }, 50);
            } else {
                card.classList.add('hidden');
            }
        });
    }

    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            applyFilter(tab.dataset.filter);
        });
    });

    categoryActionBtns.forEach(el => {
        el.addEventListener('click', () => {
            const filter = el.dataset.filter || el.dataset.categoryFilter;
            if (filter) {
                applyFilter(filter);
                const productsSection = document.getElementById('products');
                if (productsSection) {
                    productsSection.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });

    // ==========================================================================
    // 10. LIVE SEARCH OVERLAY
    // ==========================================================================
    function openSearch() {
        searchModal.classList.add('open');
        document.body.style.overflow = 'hidden';
        setTimeout(() => liveSearchInput.focus(), 150);
        renderSearchResults('');
    }

    function closeSearch() {
        searchModal.classList.remove('open');
        document.body.style.overflow = '';
        liveSearchInput.value = '';
    }

    if (searchTriggerBtn) searchTriggerBtn.addEventListener('click', openSearch);
    if (closeSearchModal) closeSearchModal.addEventListener('click', closeSearch);
    if (searchModalBackdrop) searchModalBackdrop.addEventListener('click', closeSearch);

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeSearch();
            closeQuickView();
            closeCartDrawer();
            closeMobileNav();
        }
        if (e.key === '/' && !['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
            e.preventDefault();
            openSearch();
        }
    });

    if (clearSearchBtn) {
        clearSearchBtn.addEventListener('click', () => {
            liveSearchInput.value = '';
            renderSearchResults('');
            liveSearchInput.focus();
        });
    }

    searchTags.forEach(tag => {
        tag.addEventListener('click', () => {
            liveSearchInput.value = tag.dataset.query;
            renderSearchResults(tag.dataset.query);
        });
    });

    if (liveSearchInput) {
        liveSearchInput.addEventListener('input', () => {
            renderSearchResults(liveSearchInput.value.trim().toLowerCase());
        });
    }

    function renderSearchResults(query) {
        const matches = productCards.filter(card => {
            if (!query) return true;
            const title = (card.dataset.title || '').toLowerCase();
            const desc = (card.dataset.desc || '').toLowerCase();
            const cat = (card.dataset.category || '').toLowerCase();
            return title.includes(query) || desc.includes(query) || cat.includes(query);
        });

        if (matches.length === 0) {
            searchResultsContainer.innerHTML = `
                <div style="text-align: center; padding: 2rem 0; color: var(--text-muted);">
                    <i class="fa-solid fa-magnifying-glass" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                    <p>No products found matching "${query}".</p>
                </div>
            `;
            return;
        }

        let html = '';
        matches.slice(0, 5).forEach(card => {
            const data = extractCardData(card);
            html += `
                <div class="search-result-item" data-id="${data.id}">
                    <img src="${data.image}" alt="${data.title}" class="search-result-thumb">
                    <div class="search-result-info">
                        <div class="search-result-title">${data.title}</div>
                        <div class="search-result-cat">${data.categoryName || 'Gear'} &bull; ★ ${data.rating}</div>
                    </div>
                    <div class="search-result-price">${config.currencySymbol}${data.price}</div>
                </div>
            `;
        });
        searchResultsContainer.innerHTML = html;

        searchResultsContainer.querySelectorAll('.search-result-item').forEach(item => {
            item.addEventListener('click', () => {
                const card = document.querySelector(`.product-card[data-id="${item.dataset.id}"]`);
                if (card) {
                    closeSearch();
                    openQuickView(extractCardData(card));
                }
            });
        });
    }

    // ==========================================================================
    // 11. FLASH SALE COUNTDOWN TIMER
    // ==========================================================================
    const timerDays = document.getElementById('timer-days');
    const timerHours = document.getElementById('timer-hours');
    const timerMins = document.getElementById('timer-mins');
    const timerSecs = document.getElementById('timer-secs');
    const announcementCountdown = document.getElementById('announcement-countdown');

    // Set countdown target to 48 hours from now
    let countdownTarget = Date.now() + (2 * 24 * 60 * 60 * 1000) + (14 * 60 * 60 * 1000);

    function updateCountdown() {
        const now = Date.now();
        const diff = Math.max(0, countdownTarget - now);

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
        const mins = Math.floor((diff / 1000 / 60) % 60);
        const secs = Math.floor((diff / 1000) % 60);

        const pad = (n) => String(n).padStart(2, '0');

        if (timerDays) timerDays.textContent = pad(days);
        if (timerHours) timerHours.textContent = pad(hours);
        if (timerMins) timerMins.textContent = pad(mins);
        if (timerSecs) timerSecs.textContent = pad(secs);

        if (announcementCountdown) {
            announcementCountdown.textContent = `Ends in ${pad(hours)}:${pad(mins)}:${pad(secs)}`;
        }
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();

    // ==========================================================================
    // 12. FAQ ACCORDION
    // ==========================================================================
    document.querySelectorAll('.faq-item').forEach(item => {
        const questionBtn = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        questionBtn.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            // Close all
            document.querySelectorAll('.faq-item').forEach(other => {
                other.classList.remove('active');
                const otherAns = other.querySelector('.faq-answer');
                if (otherAns) otherAns.style.display = 'none';
            });
            // Toggle current
            if (!isActive) {
                item.classList.add('active');
                if (answer) answer.style.display = 'block';
            }
        });
    });

    // ==========================================================================
    // 13. VIP NEWSLETTER FORM
    // ==========================================================================
    const newsletterForm = document.getElementById('newsletter-signup-form');
    const newsletterSuccess = document.getElementById('newsletter-success-msg');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const emailInput = document.getElementById('newsletter-email');
            if (emailInput && emailInput.value) {
                newsletterForm.style.display = 'none';
                newsletterSuccess.style.display = 'inline-flex';
                navigator.clipboard.writeText('LUXE50');
                showToast('Welcome to the VIP Club!', 'Code LUXE50 copied to your clipboard.');
            }
        });
    }

    // ==========================================================================
    // 14. INITIALIZE ON LOAD
    // ==========================================================================
    renderCartUI();
    updateWishlistBadge();
});
