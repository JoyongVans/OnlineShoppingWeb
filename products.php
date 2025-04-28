<!DOCTYPE html>
<html>
<head>
    <base href="." />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christmas Magic Decorations - Products & Cart</title>
    <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    :root {
        --primary: #c41e3a;
        --secondary: #165b33;
        --accent: #f8b229;
        --light: #f4f4f4;
    }
    
    body {
        font-family: 'Arial', sans-serif;
        background-color: var(--light);
    }
    
    nav {
        background-color: var(--primary);
        padding: 1rem;
        position: sticky;
        top: 0;
        z-index: 100;
    }
    
    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .logo {
        color: white;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
    }
    
    .logo svg {
        margin-right: 10px;
    }
    
    .nav-links {
        display: flex;
        gap: 2rem;
    }
    
    .nav-links a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s;
    }
    
    .nav-links a:hover {
        color: var(--accent);
    }
    
    .products-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 1rem;
    }
    
    .category-filters {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }
    
    .filter-btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 20px;
        background-color: white;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .filter-btn.active {
        background-color: var(--secondary);
        color: white;
    }
    
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
    }
    
    .product-card {
        background: white;
        border-radius: 8px;
        padding: 1rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: transform 0.3s;
        display: flex;
        flex-direction: column;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
    }
    
    .product-image {
        width: 100%;
        height: 200px;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--light);
        border-radius: 4px;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover; 
    }

    .price {
        color: var(--primary);
        font-size: 1.25rem;
        font-weight: bold;
        margin: 0.5rem 0;
    }

    .product-details,
    .search-price-range {
        max-width: 600px;
        margin: 2rem auto;
        padding: 1.5rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .product-details h2,
    .search-price-range h2 {
        font-size: 1.5rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .details-form,
    .range-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .details-form input,
    .range-form input {
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        width: 100%;
    }

    .range-inputs {
        display: flex;
        gap: 0.5rem;
        justify-content: space-between;
        align-items: center;
    }

    .range-inputs input {
        flex: 1;
        text-align: center;
    }

    .search-btn {
        background-color: var(--secondary);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .search-btn:hover {
        background-color: var(--primary);
    }

    .cart-icon {
        position: relative;
    }
    
    .cart-count {
        position: absolute;
        top: -8px;
        right: -8px;
        background: var(--accent);
        color: black;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
    }
    
    .add-to-cart-btn {
        background-color: var(--secondary);
        color: white;
        border: none;
        padding: 0.5rem;
        border-radius: 4px;
        cursor: pointer;
        margin-top: auto;
        transition: background-color 0.3s;
    }
    
    .add-to-cart-btn:hover {
        background-color: var(--primary);
    }
    
    .cart-section {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 1rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .cart-title {
        color: var(--primary);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--light);
    }
    
    .cart-empty {
        text-align: center;
        padding: 2rem;
        color: #666;
    }
    
    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .cart-item-image {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 4px;
        overflow: hidden;
    }

    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover; 
    }
    
    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .quantity-btn {
        background: white;
        border: 1px solid var(--secondary);
        border-radius: 4px;
        width: 30px;
        height: 30px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    
    .quantity-btn:hover {
        background: var(--secondary);
        color: white;
    }
    
    .remove-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.5rem;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .remove-btn:hover {
        background-color: darkred;
    }
    
    .cart-summary {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 2px solid var(--light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .checkout-btn {
        background: var(--secondary);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1.1rem;
        transition: background-color 0.3s;
    }
    
    .checkout-btn:hover {
        background-color: var(--primary);
    }
    </style>
</head>
<body>
    <nav>
        <div class="nav-container">
            <div class="logo">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                    <path d="M12 2L9 9H2L7 14L5 22L12 17L19 22L17 14L22 9H15L12 2Z"/>
                </svg>
                Christmas Magic
            </div>
            <div class="nav-links">
                <a href="index.html">Home</a>
                <a href="products.php">Products</a>
                <a href="internal.html">Internal Stuff</a>
                <a class="cart-icon">
                    🛒
                    <span class="cart-count">0</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="products-container">
        <h1>Our Christmas Collection</h1>

        
        <div class="category-filters">
            <button class="filter-btn active" data-category="all">All Products</button>
            <button class="filter-btn" data-category="tree">Tree Decorations</button>
            <button class="filter-btn" data-category="lights">Lights</button>
            <button class="filter-btn" data-category="outdoor">Outdoor</button>
            <button class="filter-btn" data-category="gifts">Gift Accessories</button>
        </div>

        
        <div class="product-grid" id="product-grid"></div>
    </div>

    <!-- product details + price range  -->
    <div id="product-details-section" class="product-details">
        <h2>Learn More about a Product</h2>
        <form action="product_details.php" method="POST" class="details-form">
            <input type="text" id="product_name" name="product_name" placeholder="Enter a Product Name" required>
            <button type="submit" class="search-btn">SEARCH</button>
        </form>
    </div>

    <div id="price-range-section" class="search-price-range">
        <h2>Search Products by Price Range</h2>
        <form action="price_search.php" method="POST" class="range-form">
            <div class="range-inputs">
                <input type="number" id="min_price" name="min_price" placeholder="Min Price" step="0.01" required>
                <span>to</span>
                <input type="number" id="max_price" name="max_price" placeholder="Max Price" step="0.01" required>
            </div>
            <button type="submit" class="search-btn">SEARCH</button>
        </form>
    </div>

    <div class="cart-section" id="shopping-cart">
        <h2 class="cart-title">Shopping Cart</h2>
        <div id="cart-items" class="cart-items">
            <div class="cart-empty">Your cart is empty</div>
        </div>
        <div class="cart-summary">
            <div class="total">
                <h3>Total: <span id="cart-total">$0.00</span></h3>
            </div>
            <button class="checkout-btn" onclick="checkout()">Proceed to Checkout</button>
        </div>
    </div>

    <script>
    // 1) global variables
    let cartCount = 0;    
    let cartItems = [];   
    let products = {};    

    // 2) Get product data (JSON) from the backend interface get_products.php
    fetch('./api/get_products.php') 
        .then(response => response.json())
        .then(data => {
            products = data;  
            renderProducts(products);  
        })
        .catch(err => console.error("Failed to load products:", err));

    // 3) Dynamically render products to .product-grid
    function renderProducts(products) {
        const productGrid = document.getElementById('product-grid');
        let html = '';

        // products is an object： { P01: {name, price, image, category...}, P02: {...}, ... }
        // each productId is looped and put into html
        for (let productId in products) {
            const p = products[productId];
            html += `
            <div class="product-card" data-category="${p.category || 'tree'}">
                <div class="product-image">
                    <img src="${p.image}" alt="${p.name}">
                </div>
                <h3>${p.name}</h3>
                <p class="price">$${p.price.toFixed(2)}</p>
                <button class="add-to-cart-btn" onclick="addToCart('${productId}')">
                    Add to Cart
                </button>
            </div>`;
        }
        productGrid.innerHTML = html;
    }

    
    function saveCartToServer(cart) {
        fetch('./api/save_cart.php', {
            method: 'POST',
            body: JSON.stringify(cart),
            headers: {
                'Content-Type': 'application/json'
            }
        }).catch(err => console.error('Failed to save cart:', err));
    }

    function addToCart(productId, event) {
        
        const product = products[productId];
        if (!product) {
            alert("Product not found: " + productId);
            return;
        }

        cartCount++;
        document.querySelector('.cart-count').textContent = cartCount;

        const existingItem = cartItems.find(item => item.id === productId);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cartItems.push({
                id: productId,
                name: product.name,
                price: product.price,
                quantity: 1
            });
        }

        
        const cartArr = cartItems.map(item => ({
            product_id: item.id,
            quantity: item.quantity,
            price: item.price
        }));
        saveCartToServer(cartArr);

        updateCartDisplay();

    
        if (event && event.target) {
            const button = event.target;
            button.style.transform = 'scale(0.95)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
            }, 100);
        }
    }

    function updateCartDisplay() {
        const cartContainer = document.getElementById('cart-items');
        if (cartItems.length === 0) {
            cartContainer.innerHTML = '<div class="cart-empty">Your cart is empty</div>';
            document.getElementById('cart-total').textContent = '$0.00';
            return;
        }

        
        let html = '';
        let totalPrice = 0;

        cartItems.forEach(item => {
            const subtotal = item.price * item.quantity;
            totalPrice += subtotal;

         
            html += `
            <div class="cart-item">
                <div class="cart-item-image">
                    <img src="${products[item.id].image}" alt="${item.name}">
                </div>
                <div>
                    <h3>${item.name}</h3>
                    <p>$${item.price.toFixed(2)}</p>
                </div>
                <div class="quantity-controls">
                    <button class="quantity-btn" onclick="updateQuantity('${item.id}', -1)">-</button>
                    <span>${item.quantity}</span>
                    <button class="quantity-btn" onclick="updateQuantity('${item.id}', 1)">+</button>
                </div>
                <div>$${subtotal.toFixed(2)}</div>
                <button class="remove-btn" onclick="removeItem('${item.id}')">Remove</button>
            </div>`;
        });

        cartContainer.innerHTML = html;
        document.getElementById('cart-total').textContent = `$${totalPrice.toFixed(2)}`;
    }

    function updateQuantity(productId, change) {
        const item = cartItems.find(x => x.id === productId);
        if (item) {
            item.quantity += change;
            if (item.quantity <= 0) {
                removeItem(productId);
            } else {
                cartCount += change;
                document.querySelector('.cart-count').textContent = cartCount;
                updateCartDisplay();
            }
        }
    }

    function removeItem(productId) {
        const item = cartItems.find(x => x.id === productId);
        if (item) {
            cartCount -= item.quantity;
            document.querySelector('.cart-count').textContent = cartCount;
            cartItems = cartItems.filter(x => x.id !== productId);
            updateCartDisplay();
        }
    }

    function checkout() {
        if (cartItems.length === 0) {
            alert('Your cart is empty!');
            return;
        }
        window.location.href = './checkout.html';
    }

   
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelector('.filter-btn.active').classList.remove('active');
            button.classList.add('active');

            const category = button.dataset.category;
            
           // Show/Hide
            document.querySelectorAll('.product-card').forEach(card => {
                const cat = card.getAttribute('data-category');
                if (category === 'all' || cat === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    </script>
</body>
</html>
