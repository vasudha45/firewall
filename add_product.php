<?php
// add_product.php

// Database connection details
// Database connection details
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP is an empty string
$dbname = "test"; // The name of your database, which appears to be 'test' in your image

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Get product details from the POST request
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_cost = $_POST['product_cost'];
$product_category = $_POST['product_category'];

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if product ID already exists
$checkQuery = $conn->prepare("SELECT COUNT(*) FROM products WHERE product_id = ?");
$checkQuery->bind_param("i", $product_id);
$checkQuery->execute();
$checkQuery->bind_result($count);
$checkQuery->fetch();
$checkQuery->close();

if ($count > 0) {
    echo "Product ID already exists in the database.";
} else {
    // Insert the product details if ID is not found
    $insertQuery = $conn->prepare("INSERT INTO products (product_id, product_name, product_cost, product_category) VALUES (?, ?, ?, ?)");
    $insertQuery->bind_param("isds", $product_id, $product_name, $product_cost, $product_category);
    if ($insertQuery->execute()) {
        echo "Product added successfully.";
    } else {
        echo "Failed to add the product.";
    }
    $insertQuery->close();
}

// Close the database connection
$conn->close();
?>
