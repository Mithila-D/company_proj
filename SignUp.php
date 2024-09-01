<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "company_xyz";


$conn = mysqli_connect($servername, $username, $password, $database_name);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_Id = trim($_POST['employee_Id']);
    $f_name = trim($_POST['f_name']);
    $l_name = trim($_POST['l_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);
    $dob=trim($_POST['dob']);
    $gender = trim($_POST['gender']);
    $phone = trim($_POST['phone']);
    $phone = trim($_POST['phone']);
    $country = trim($_POST['country']);
    $state = trim($_POST['state']);
    $city = trim($_POST['city']);
    $pincode = trim($_POST['pincode']);
    //
    $date_of_signUp = trim($_POST['date_of_signUp']);
    $acceptPolicies = isset($_POST['accept-policies']);


    // if (empty($username) || empty($email) || empty($password) || !$acceptPolicies) {
    //     die("Please fill all fields and accept the policies.");
    // }

    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     die("Invalid email format.");
    // }


    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $sql_query = "INSERT INTO users (employee_Id, f_name, l_name, email, password, dob, gender, phone, country, state, city, pincode, date_of_signUp) VALUES ('$employee_Id', '$f_name', '$l_name', '$email', '$password', '$dob', '$gender', '$phone', '$country', '$state', '$city', '$pincode', '$date_of_signUp')";

    // if (mysqli_query($conn, $sql_query)) {
    //     echo "Account created successfully!";
    //     header("Location: SignIn.html");
    // } else {
    //     echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
    // }
// -----------------------++++
    // if (mysqli_query($conn, $sql_query)) {
    //     header("Location: SignIn.html");
    //     exit(); 
    // } else {
    //     echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
    // }

    if (mysqli_query($conn, $sql_query)) {
        echo "<script type='text/javascript'>
                alert('Account created successfully!');
                setTimeout(function() {
                    window.location.href = 'SignIn.html';
                }, 2000); // 2-second delay before redirecting
              </script>";
    } else {
        echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>
</body>
</html>


