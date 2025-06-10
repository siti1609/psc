<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "BookStore"; // No space

$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and validate form data
$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$address = trim($_POST['address']);
$email = trim($_POST['email']);
$card_number = trim($_POST['card_number']);
$expiry_month = trim($_POST['expiry_month']);
$expiry_year = trim($_POST['expiry_year']);

// Check required fields
if (empty($name) || empty($phone) || empty($address) || empty($email) ||
    empty($card_number) || empty($expiry_month) || empty($expiry_year)) {
    echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
    exit();
}

// Email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format.'); window.history.back();</script>";
    exit();
}

// Phone validation (digits only, 10-15 digits)
if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
    echo "<script>alert('Invalid phone number. Use only digits, 10-15 characters.'); window.history.back();</script>";
    exit();
}

// Save only last 4 digits of card
$card_last4 = substr($card_number, -4);

// Insert into database (NO CVV)
$stmt = $conn->prepare("INSERT INTO payments (name, phone, email, address, card_number, expiry_month, expiry_year) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $phone, $email, $address, $card_last4, $expiry_month, $expiry_year);

if ($stmt->execute()) {
    echo "<script>alert('Your order has been placed successfully!');</script>";
    echo "<script>setTimeout(function(){ window.location.href = 'index.html'; }, 1000);</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
