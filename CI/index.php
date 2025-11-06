<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Iyah - Welcome</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: #8B4513;
            --secondary-color: #D2691E;
            --accent-color: #f4a261;
            --light-color: #fef5e7;
            --dark-color: #2d1b0e;
            --text-color: #5a3921;
        }

        body {
            background: linear-gradient(135deg, #fef5e7 0%, #f8d8b0 100%);
            color: var(--text-color);
            min-height: 100vh;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }

        .logo {
            font-size: 4rem;
            margin-bottom: 20px;
            color: var(--light-color);
        }

        h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: 300;
            font-family: 'Georgia', serif;
        }

        .tagline {
            font-size: 1.3rem;
            margin-bottom: 40px;
            opacity: 0.9;
            font-weight: 300;
        }

        .cta-button {
            display: inline-block;
            background: var(--accent-color);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .cta-button:hover {
            background: transparent;
            border-color: var(--accent-color);
            color: var(--accent-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* Features Section */
        .features {
            padding: 100px 0;
            background: white;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 60px;
            color: var(--dark-color);
            font-family: 'Georgia', serif;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-top: 60px;
        }

        .feature-card {
            text-align: center;
            padding: 40px 30px;
            background: var(--light-color);
            border-radius: 20px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-color);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 25px;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--dark-color);
            font-family: 'Georgia', serif;
        }

        .feature-card p {
            color: var(--text-color);
            font-size: 1rem;
            line-height: 1.7;
        }

        /* Menu Preview */
        .menu-preview {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8f4f0 0%, #e8dfd6 100%);
        }

        .category-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }

        .category-btn {
            padding: 12px 25px;
            background: white;
            border: 2px solid var(--primary-color);
            border-radius: 25px;
            color: var(--primary-color);
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .category-btn.active,
        .category-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        .menu-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .menu-item {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .menu-emoji {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .menu-item h4 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: var(--dark-color);
        }

        .menu-item .price {
            font-size: 1.2rem;
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 10px;
        }

        .menu-item .category {
            display: inline-block;
            padding: 5px 15px;
            background: var(--light-color);
            color: var(--text-color);
            border-radius: 15px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        /* Footer */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 60px 0 30px;
            text-align: center;
        }

        .footer-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .footer-logo {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--accent-color);
        }

        .footer-tagline {
            font-size: 1.1rem;
            margin-bottom: 30px;
            opacity: 0.8;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--accent-color);
        }

        .copyright {
            opacity: 0.6;
            font-size: 0.9rem;
            margin-top: 30px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            
            .tagline {
                font-size: 1.1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <div class="hero-content">
                <div class="logo">
                    <i class="fas fa-coffee"></i>
                </div>
                <h1>Welcome to Cafe Iyah</h1>
                <p class="tagline">Experience the finest beverages and meals in town</p>
                <a href="menu.php" class="cta-button">
                    <i class="fas fa-utensils"></i> VIEW MENU
                </a>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">Why Choose Cafe Iyah?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <h3>Premium Beverages</h3>
                    <p>We craft the finest espresso, frappe, milk tea, and fruit soda using quality ingredients and traditional recipes.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3>Delicious Rice Meals</h3>
                    <p>Our rice meals are prepared fresh daily with authentic flavors that will satisfy your cravings.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Made with Love</h3>
                    <p>Every item is prepared with care and attention to ensure the best experience. Your satisfaction is our priority.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Preview Section -->
    <section class="menu-preview">
        <div class="container">
            <h2 class="section-title">Our Specialties</h2>
            <div class="category-buttons">
                <button class="category-btn active" onclick="filterMenu('all')">All Items</button>
                <button class="category-btn" onclick="filterMenu('Espresso')">Espresso</button>
                <button class="category-btn" onclick="filterMenu('Frappe')">Frappe</button>
                <button class="category-btn" onclick="filterMenu('Milk Tea')">Milk Tea</button>
                <button class="category-btn" onclick="filterMenu('Fruit Soda')">Fruit Soda</button>
                <button class="category-btn" onclick="filterMenu('Rice Meals')">Rice Meals</button>
            </div>
            <div class="menu-items">
                <div class="menu-item" data-category="Espresso">
                    <div class="menu-emoji">☕</div>
                    <h4>Classic Espresso</h4>
                    <div class="price">₱120</div>
                    <div class="category">Espresso</div>
                    <p>Strong and rich espresso shot</p>
                </div>
                <div class="menu-item" data-category="Espresso">
                    <div class="menu-emoji">☕</div>
                    <h4>Caramel Macchiato</h4>
                    <div class="price">₱150</div>
                    <div class="category">Espresso</div>
                    <p>Espresso with caramel and steamed milk</p>
                </div>
                <div class="menu-item" data-category="Frappe">
                    <div class="menu-emoji">🥤</div>
                    <h4>Chocolate Frappe</h4>
                    <div class="price">₱140</div>
                    <div class="category">Frappe</div>
                    <p>Iced blended chocolate drink</p>
                </div>
                <div class="menu-item" data-category="Milk Tea">
                    <div class="menu-emoji">🧋</div>
                    <h4>Classic Milk Tea</h4>
                    <div class="price">₱110</div>
                    <div class="category">Milk Tea</div>
                    <p>Traditional milk tea with pearls</p>
                </div>
                <div class="menu-item" data-category="Fruit Soda">
                    <div class="menu-emoji">🍹</div>
                    <h4>Strawberry Soda</h4>
                    <div class="price">₱95</div>
                    <div class="category">Fruit Soda</div>
                    <p>Sparkling strawberry soda</p>
                </div>
                <div class="menu-item" data-category="Rice Meals">
                    <div class="menu-emoji">🍛</div>
                    <h4>Chicken Rice Bowl</h4>
                    <div class="price">₱180</div>
                    <div class="category">Rice Meals</div>
                    <p>Grilled chicken with steamed rice</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <i class="fas fa-coffee"></i>
                </div>
                <h3>Cafe Iyah</h3>
                <p class="footer-tagline">Serving quality beverages and meals with a touch of home</p>
                <div class="footer-links">
                    <a href="menu.php">Order Now</a>
                    <a href="admin.php">Admin Login</a>
                </div>
                <p class="copyright">&copy; 2024 Cafe Iyah. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Menu filtering functionality
        function filterMenu(category) {
            const items = document.querySelectorAll('.menu-item');
            const buttons = document.querySelectorAll('.category-btn');
            
            // Update active button
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Filter items
            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>