<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="main.css">
        <!-- font awesome -->
        <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
    </head>

    
<header>
    <h1 style='color:white'>NutriPath</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>
    <body>

        <?php 
        include 'database/product.php';
        $model = new Product();
        $model->addProduct();
        $products = $model->getProducts();
        ?>
        <div class = "products">
            <div class = "container">
                <h1 class = "lg-title">Special Creatine With Offers</h1>
                <p class = "text-light">Increase Your Performance with the Best Creatines
                    If you want to add power, strength and muscle mass, creatines are the most reliable assistants you can have in your training routine. With the highest quality ingredients and advanced formulas, our creatine products are designed to deliver fast and visible results. 
                    
                    Whether you are a professional athlete or just looking to improve your performance, our creatines are the ideal choice to help you achieve your goals.
                    
                    - **Main benefits:**
                      - Increasing strength and energy.
                      - Improving performance in the gym.
                      - Support for increasing muscle mass.
                      - Faster recovery after training.
                    
                    Choose from a wide range of tested and trusted products to give your body the best!</p>
                <div class = "product-items">

                <?php foreach ($products as $product): ?>
                <!-- Single Product -->
                <div class="product">
                    <div class="product-content">
                        <div class="product-img">
                        <a href="EditProduct.php?product=<?= $product['id']; ?>" class="product-link">
                            <img src="uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        </div>
                        <div class="product-btns">
                            <button type="button" class="btn-cart">
                                add to cart <span><i class="fas fa-plus"></i></span>
                            </button>
                            <button type="button" class="btn-buy">
                                <a href="buy.php?product=<?= $product['id']; ?>">buy now</a>
                                <span><i class="fas fa-shopping-cart"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-info-top">
                            <h2 class="sm-title"></h2>
                            <div class="rating">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                        </div>
                        <a href="#" class="product-name"><?php echo $product['name']; ?></a>
                        <p class="product-price">$<?php echo $product['price'] * 1.4; ?> </p>
                        <p class="product-price">$<?php echo $product['price']; ?></p>
                    </div>
                    <div class="off-info">
                        <h2 class="sm-title">30% off</h2>
                    </div>
                </div>
                </a>
    <!-- End of Single Product -->
    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <div class = "product-collection">
            <div class = "container">
                <div class = "product-collection-wrapper">
                    <!-- product col left -->
                    <div class = "product-col-left flex">
                        <div class = "product-col-content">
                            <h2 class = "sm-title">Gym</h2>
                            <h2 class = "md-title">Your second home </h2>
                            <p class = "text-light">Fitness is essential for the health of body and mind. Regular exercise improves strength, endurance and cardiovascular health, while helping to reduce stress and improve mood. Physical activity is an investment in the quality of life, increasing energy and helping to prevent diseases.</p>
                            <button type = "button" class = "btn-dark">Shop now</button>
                        </div>
                    </div>
                    <!-- product col right -->
                    <div class = "product-col-right">
                        <div class = "product-col-r-top flex">
                            <div class = "product-col-content">
                                <h2 class = "sm-title">Gym</h2>
                                <h2 class = "md-title">Fitness Equipments </h2>
                                <p class = "text-light">Fitness equipment is essential for improving performance and achieving training goals. From weights and muscle-strengthening machines to cardio machines such as the Treadmill or Stationary Bike, they help optimize exercise and increase efficiency. Using the right equipment can speed up results and ensure safe training.</p>
                                <button type = "button" class = "btn-dark">Shop now</button>
                            </div>
                        </div>
                        <div class = "product-col-r-bottom">
                            <!-- left -->
                            <div class = "flex">
                                <div class = "product-col-content">
                                    <h2 class = "sm-title">summer sale </h2>
                                    <h2 class = "md-title">Extra 50% Off </h2>
                                    <p class = "text-light">Get 50% off now! Get your favorite products and enjoy the results without spending too much. Don't miss this opportunity - the offer is limited!</p>
                                    <button type = "button" class = "btn-dark">Shop now</button>
                                </div>
                            </div>
                            <!-- right -->
                            <div class = "flex">
                                <div class = "product-col-content">
                                    <h2 class = "sm-title">Creatine </h2>
                                    <h2 class = "md-title">best sellers </h2>
                                    <p class = "text-light">Discover our best selling products! See what the most popular picks are and why they're in such demand. Add them to your collection and experience the quality and performance that made these products market leaders.</p>
                                    <button type = "button" class = "btn-dark">Shop now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-container">
         <form action="#" method="POST" enctype="multipart/form-data">
        <h1>Add a New Product</h1>
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="5" required></textarea><br><br>

        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" step="0.01" required><br><br>

        <label for="image">Product Image:</label><br>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg" required><br><br>

        <button type="submit">Add Product</button>
        </form>
        </div>

        
    </body>
</html>