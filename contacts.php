<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $pdo->prepare('INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)');
    $stmt->execute([$name, $email, $message]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriPath - Contact</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>NutriPath</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<div class="contact-form">
    <h2>Contact Us</h2>
    <form method="POST">
        <label for="name">Your Name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Your Email</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Your Message</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>

<footer>
    <p>&copy; 2025 NutriPath. All rights reserved.</p>
</footer>

</body>
</html>
