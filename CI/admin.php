<?php
session_start();

// Demo accounts (hidden from display)
$valid_users = [
    'owner' => ['password' => 'owner123', 'role' => 'owner', 'name' => 'Cafe Owner'],
    'manager' => ['password' => 'manager123', 'role' => 'manager', 'name' => 'Cafe Manager'],
    'cashier' => ['password' => 'cashier123', 'role' => 'cashier', 'name' => 'Cashier Staff']
];

// Initialize menu items if not set
if (!isset($_SESSION['menu_items'])) {
    $_SESSION['menu_items'] = [
        [
            'id' => '1',
            'name' => 'Classic Espresso',
            'price' => 120,
            'category' => 'Espresso',
            'description' => 'Strong and rich espresso shot',
            'image' => '☕'
        ],
        [
            'id' => '2',
            'name' => 'Caramel Macchiato',
            'price' => 150,
            'category' => 'Espresso',
            'description' => 'Espresso with caramel and steamed milk',
            'image' => '☕'
        ],
        [
            'id' => '3',
            'name' => 'Chocolate Frappe',
            'price' => 140,
            'category' => 'Frappe',
            'description' => 'Iced blended chocolate drink',
            'image' => '🥤'
        ],
        [
            'id' => '4',
            'name' => 'Strawberry Frappe',
            'price' => 145,
            'category' => 'Frappe',
            'description' => 'Refreshing strawberry blended drink',
            'image' => '🥤'
        ],
        [
            'id' => '5',
            'name' => 'Classic Milk Tea',
            'price' => 110,
            'category' => 'Milk Tea',
            'description' => 'Traditional milk tea with pearls',
            'image' => '🧋'
        ],
        [
            'id' => '6',
            'name' => 'Wintermelon Milk Tea',
            'price' => 120,
            'category' => 'Milk Tea',
            'description' => 'Sweet wintermelon flavor with milk',
            'image' => '🧋'
        ],
        [
            'id' => '7',
            'name' => 'Strawberry Soda',
            'price' => 95,
            'category' => 'Fruit Soda',
            'description' => 'Sparkling strawberry soda',
            'image' => '🍹'
        ],
        [
            'id' => '8',
            'name' => 'Blue Lemonade',
            'price' => 90,
            'category' => 'Fruit Soda',
            'description' => 'Refreshing blue lemonade soda',
            'image' => '🍹'
        ],
        [
            'id' => '9',
            'name' => 'Chicken Rice Bowl',
            'price' => 180,
            'category' => 'Rice Meals',
            'description' => 'Grilled chicken with steamed rice',
            'image' => '🍛'
        ],
        [
            'id' => '10',
            'name' => 'Beef Caldereta',
            'price' => 220,
            'category' => 'Rice Meals',
            'description' => 'Traditional beef stew with rice',
            'image' => '🍛'
        ]
    ];
}

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle login
if ($_POST['action'] === 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (isset($valid_users[$username]) && $valid_users[$username]['password'] === $password) {
        $_SESSION['user'] = $valid_users[$username];
        $_SESSION['logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

// Handle logout
if ($_GET['action'] === 'logout') {
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Handle menu additions (Owner/Manager only)
if ($_POST['action'] === 'add_menu_item' && ($_SESSION['user']['role'] === 'owner' || $_SESSION['user']['role'] === 'manager')) {
    $new_item = [
        'id' => uniqid(),
        'name' => $_POST['item_name'],
        'price' => floatval($_POST['item_price']),
        'category' => $_POST['item_category'],
        'description' => $_POST['item_description'],
        'image' => $_POST['item_emoji']
    ];
    
    $_SESSION['menu_items'][] = $new_item;
    $success = "Menu item added successfully!";
}

// Handle design changes (Owner only)
if ($_POST['action'] === 'update_design' && $_SESSION['user']['role'] === 'owner') {
    $_SESSION['cafe_theme'] = [
        'primary_color' => $_POST['primary_color'],
        'secondary_color' => $_POST['secondary_color'],
        'cafe_name' => $_POST['cafe_name']
    ];
    $success = "Design updated successfully!";
}

// Initialize default theme if not set
if (!isset($_SESSION['cafe_theme'])) {
    $_SESSION['cafe_theme'] = [
        'primary_color' => '#8B4513',
        'secondary_color' => '#D2691E',
        'cafe_name' => 'Cafe Iyah'
    ];
}

// Check if user is logged in
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
$current_user = $logged_in ? $_SESSION['user'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['cafe_theme']['cafe_name']; ?> - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        :root {
            --primary-color: <?php echo $_SESSION['cafe_theme']['primary_color']; ?>;
            --secondary-color: <?php echo $_SESSION['cafe_theme']['secondary_color']; ?>;
            --accent-color: #f4a261;
            --light-color: #f8f9fa;
            --dark-color: #2d1b0e;
            --text-color: #5a3921;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .login-container {
            padding: 40px 35px;
        }

        .dashboard-container {
            padding: 35px 30px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo i {
            font-size: 48px;
            color: var(--primary-color);
            margin-bottom: 15px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo h1 {
            font-size: 28px;
            color: var(--dark-color);
            font-weight: 700;
            font-family: 'Georgia', serif;
        }

        .logo p {
            color: var(--text-color);
            font-size: 14px;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
            font-size: 14px;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
        }

        input, select, textarea {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e1e5ee;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
            background: #fafbfc;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            background: white;
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
        }

        button {
            width: 100%;
            padding: 14px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        button:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 69, 19, 0.3);
        }

        .error-message {
            background: #ffe6e6;
            color: #d63031;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
            border-left: 4px solid #d63031;
        }

        .success-message {
            background: #e6ffe6;
            color: #27ae60;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
            border-left: 4px solid #27ae60;
        }

        .role-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .owner-badge {
            background: linear-gradient(135deg, var(--primary-color), #654321);
            color: white;
        }

        .manager-badge {
            background: linear-gradient(135deg, var(--secondary-color), #a0522d);
            color: white;
        }

        .cashier-badge {
            background: linear-gradient(135deg, var(--accent-color), #e76f51);
            color: white;
        }

        .user-info {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: linear-gradient(135deg, #fffaf0, #fef5e7);
            border-radius: 15px;
            border: 2px dashed var(--primary-color);
        }

        .user-info h2 {
            color: var(--dark-color);
            margin-bottom: 8px;
        }

        .user-info p {
            color: var(--text-color);
            font-size: 15px;
        }

        .access-section {
            margin: 25px 0;
            padding: 20px;
            background: #fffaf0;
            border-radius: 15px;
            border-left: 5px solid var(--primary-color);
        }

        .access-section h3 {
            color: var(--dark-color);
            margin-bottom: 15px;
            font-family: 'Georgia', serif;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .access-item {
            display: flex;
            align-items: center;
            padding: 18px;
            background: white;
            border-radius: 12px;
            margin-bottom: 15px;
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s;
        }

        .access-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .access-icon {
            margin-right: 15px;
            font-size: 20px;
            color: var(--primary-color);
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .access-text {
            flex: 1;
        }

        .access-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--dark-color);
        }

        .access-desc {
            color: var(--text-color);
            font-size: 14px;
            line-height: 1.4;
        }

        .owner-access {
            border-left-color: #ff6b6b;
        }

        .owner-access .access-icon {
            color: #ff6b6b;
        }

        .manager-access {
            border-left-color: #4ecdc4;
        }

        .manager-access .access-icon {
            color: #4ecdc4;
        }

        .cashier-access {
            border-left-color: #45b7d1;
        }

        .cashier-access .access-icon {
            color: #45b7d1;
        }

        .logout-btn {
            background: #e74c3c;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: var(--text-color);
            font-size: 13px;
            opacity: 0.7;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!$logged_in): ?>
        <!-- Login Form -->
        <div class="login-container">
            <div class="logo">
                <i class="fas fa-coffee"></i>
                <h1><?php echo $_SESSION['cafe_theme']['cafe_name']; ?></h1>
                <p>Admin Portal</p>
            </div>
            
            <?php if (isset($error)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST">
                <input type="hidden" name="action" value="login">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                </div>
                <button type="submit">Sign In <i class="fas fa-sign-in-alt"></i></button>
            </form>
            
            <div class="footer">
                <p><?php echo $_SESSION['cafe_theme']['cafe_name']; ?> &copy; 2024</p>
            </div>
        </div>
        
        <?php else: ?>
        <!-- Dashboard -->
        <div class="dashboard-container">
            <div class="logo">
                <i class="fas fa-coffee"></i>
                <h1><?php echo $_SESSION['cafe_theme']['cafe_name']; ?></h1>
                <p>Management Dashboard</p>
            </div>
            
            <div class="user-info">
                <h2>Welcome, <?php echo $current_user['name']; ?>!</h2>
                <div class="role-badge <?php echo $current_user['role']; ?>-badge">
                    <?php echo ucfirst($current_user['role']); ?>
                </div>
                <p>You have successfully logged into the cafe management system</p>
            </div>

            <?php if (isset($success)): ?>
            <div class="success-message">
                <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            </div>
            <?php endif; ?>

            <!-- Menu Management Section (Owner & Manager) -->
            <?php if ($current_user['role'] === 'owner' || $current_user['role'] === 'manager'): ?>
            <div class="access-section">
                <h3><i class="fas fa-utensils"></i> Menu Management</h3>
                
                <form method="POST">
                    <input type="hidden" name="action" value="add_menu_item">
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="text" id="item_name" name="item_name" placeholder="Enter item name" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="item_price">Price (₱)</label>
                            <input type="number" id="item_price" name="item_price" step="1" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label for="item_category">Category</label>
                            <select id="item_category" name="item_category" required>
                                <option value="">Select Category</option>
                                <option value="Espresso">Espresso</option>
                                <option value="Frappe">Frappe</option>
                                <option value="Milk Tea">Milk Tea</option>
                                <option value="Fruit Soda">Fruit Soda</option>
                                <option value="Rice Meals">Rice Meals</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="item_emoji">Item Emoji</label>
                            <input type="text" id="item_emoji" name="item_emoji" placeholder="e.g., ☕" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="item_description">Description</label>
                        <textarea id="item_description" name="item_description" rows="2" placeholder="Enter item description"></textarea>
                    </div>
                    <button type="submit">Add Menu Item <i class="fas fa-plus"></i></button>
                </form>
            </div>
            <?php endif; ?>

            <!-- Design Customization Section (Owner Only) -->
            <?php if ($current_user['role'] === 'owner'): ?>
            <div class="access-section">
                <h3><i class="fas fa-palette"></i> Design Customization</h3>
                
                <form method="POST">
                    <input type="hidden" name="action" value="update_design">
                    <div class="form-group">
                        <label for="cafe_name">Cafe Name</label>
                        <input type="text" id="cafe_name" name="cafe_name" value="<?php echo $_SESSION['cafe_theme']['cafe_name']; ?>" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="primary_color">Primary Color</label>
                            <input type="color" id="primary_color" name="primary_color" value="<?php echo $_SESSION['cafe_theme']['primary_color']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="secondary_color">Secondary Color</label>
                            <input type="color" id="secondary_color" name="secondary_color" value="<?php echo $_SESSION['cafe_theme']['secondary_color']; ?>" required>
                        </div>
                    </div>
                    <button type="submit">Update Design <i class="fas fa-sync-alt"></i></button>
                </form>
            </div>
            <?php endif; ?>

            <!-- Access Levels Display -->
            <div class="access-section">
                <h3><i class="fas fa-user-shield"></i> Your Access Levels</h3>
                
                <?php
                $access_levels = [
                    'owner' => [
                        ['icon' => 'fas fa-cogs', 'title' => 'Full System Control', 'desc' => 'Complete administrative access to all system functions'],
                        ['icon' => 'fas fa-utensils', 'title' => 'Menu Management', 'desc' => 'Add, edit, and remove menu items and categories'],
                        ['icon' => 'fas fa-palette', 'title' => 'Design Customization', 'desc' => 'Change cafe theme, colors, and branding'],
                        ['icon' => 'fas fa-chart-line', 'title' => 'Business Analytics', 'desc' => 'View sales reports and business performance data'],
                        ['icon' => 'fas fa-users-cog', 'title' => 'Staff Management', 'desc' => 'Manage staff accounts and permissions']
                    ],
                    'manager' => [
                        ['icon' => 'fas fa-utensils', 'title' => 'Menu Management', 'desc' => 'Add and update menu items and pricing'],
                        ['icon' => 'fas fa-clipboard-list', 'title' => 'Inventory Control', 'desc' => 'Monitor stock levels and place orders'],
                        ['icon' => 'fas fa-chart-bar', 'title' => 'Sales Reports', 'desc' => 'View daily and weekly sales performance'],
                        ['icon' => 'fas fa-users', 'title' => 'Staff Scheduling', 'desc' => 'Manage staff shifts and assignments']
                    ],
                    'cashier' => [
                        ['icon' => 'fas fa-cash-register', 'title' => 'Order Processing', 'desc' => 'Take customer orders and process payments'],
                        ['icon' => 'fas fa-receipt', 'title' => 'Receipt Management', 'desc' => 'Generate and manage transaction receipts'],
                        ['icon' => 'fas fa-user-check', 'title' => 'Customer Service', 'desc' => 'Assist customers with orders and inquiries']
                    ]
                ];
                
                foreach ($access_levels[$current_user['role']] as $access):
                ?>
                <div class="access-item">
                    <div class="access-icon">
                        <i class="<?php echo $access['icon']; ?>"></i>
                    </div>
                    <div class="access-text">
                        <div class="access-title"><?php echo $access['title']; ?></div>
                        <div class="access-desc"><?php echo $access['desc']; ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <a href="admin.php?action=logout" class="logout-btn" style="display: block; text-decoration: none; text-align: center;">
                <button class="logout-btn">Logout <i class="fas fa-sign-out-alt"></i></button>
            </a>
            
            <div class="footer">
                <p>Logged in as <?php echo $current_user['name']; ?> &copy; <?php echo $_SESSION['cafe_theme']['cafe_name']; ?> 2024</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>