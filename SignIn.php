<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "company_xyz";

// Create connection
$conn = new mysqli($servername, $username, $password, $database_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$employee_id = $_POST['employee_Id'];
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT * FROM users WHERE employee_Id = ? AND email = ?");
$stmt->bind_param("is", $employee_id, $email);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the user data
    $user = $result->fetch_assoc();
    
    // Verify the password (assuming it's stored as plain text for this example)
    if ($password === $user['password']) {
        // Password is correct, redirect to page1.html
        header("Location: page1.html");
        exit();
    } else {
        // Password is incorrect
        echo "<script>alert('Incorrect password. Please try again.'); window.location.href='SignIn.html';</script>";
    }
} else {
    // User not found
    echo "<script>alert('User not found or incorrect credentials. Please try again.'); window.location.href='SignIn.html';</script>";
}

$stmt->close();
$conn->close();
?>
