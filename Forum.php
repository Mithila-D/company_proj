<?php
    $servername="localhost";
    $username="root";
    $password="";
    $databasename="company_xyz";

    $conn=new mysqli($servername,$username,$password,$databasename);
    if($conn->connect_error)
    {
        die('connection error'.$conn->connect_error);
    }
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $name=$_POST['name'];
        $title=$_POST['title'];
        $body=$_POST['body'];
        $smst=$conn->prepare('INSERT INTO Forums (name,title,body) VALUES(?,?,?)');
        $smst->bind_param('sss',$name,$title,$body);
        $smst->execute();
        header("Location:Forum.php");
        exit();
    }
    $threads=$conn->query("SELECT * FROM Forums ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forums</title>
    <link rel="stylesheet" href="Forum.css">
    <link rel="icon" href="images\XYZ_logo.jpg">
</head>
<body>
<div class="nav">
        <a href="Index.html">Home</a>
        <a href="#">About</a>
        <a href="#">Page1</a>
        <a href="#">Forums</a>
    </div>
    <br>
    <h1>Forums</h1>
    <div id="FormDiv">
        <form action="Forum.php" method="POST">
            <input type="text" name="name" required placeholder=" Enter Your Name"><br>
            <input type="text" name="title" placeholder="Enter the Title" required><br><br><hr>
            <textarea name="body" required></textarea><br>
            <button type="submit" id="submit">post</button><br>
            <button type="reset" id="reset">Clear</button>
        </form>
    </div>

    <br><br><br><br>
    <?php foreach ($threads as $thread): ?>

        <div class="thread">
            <h4><?php echo htmlspecialchars($thread['title']); ?></h4>
            <p><?php echo htmlspecialchars($thread['body']); ?></p>
            <p>Posted by : <?php echo htmlspecialchars($thread['name']); ?> , on : <?php echo $thread['created_at']; ?></p>
        </div>
    <?php endforeach; ?>
    <br>
    <div id="footer">© 2024 JAMS Company. All rights reserved</div>
</body>
</html>