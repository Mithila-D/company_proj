<?php

$servername = "localhost";
$username = "root";
$password = "";
$database_name = "company_xyz";

$conn = new mysqli($servername, $username, $password, $database_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $body = $_POST['body'];

    $stmt = $conn->prepare("INSERT INTO forums (name, title, body) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $title, $body);
    $stmt->execute();

    header("Location: index.php");
    exit();
}


$threads = $conn->query("SELECT * FROM forums ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Forum</h2>
    <form action="index.php" method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="body" placeholder="Body" required></textarea>
        <button type="submit">Post</button>
    </form>
    <br><br><br><br>
    <?php foreach ($threads as $thread): ?>
        <div class="thread">
            <h4><?php echo htmlspecialchars($thread['title']); ?></h4>
            <p><?php echo htmlspecialchars($thread['body']); ?></p>
            <p>Posted by : <?php echo htmlspecialchars($thread['name']); ?> , on : <?php echo $thread['created_at']; ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>


