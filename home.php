<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Chumt Blog</title>
</head>
<body>
    <div class="blog-container">
        <?php
            $conn=mysqli_connect('localhost','root','password','%dbname%');
            if(!mysqli_connect_errno()){
                $sql = "SELECT * FROM blogs";
                $result = mysqli_query($conn,$sql);
                $blogs = mysqli_fetch_all($result,MYSQLI_ASSOC);
            }
            foreach($blogs as $blog):
        ?>
        <div class="blog">
            <div class="blog__title"><?php echo $blog["title"]; ?></div>
            <div class="inner-container">
                <img src="<?php echo $blog["img"]; ?>" alt="blog_img" class="blog__img">
                <div class="blog__text"><?php echo $blog["content"]; ?></div>
            </div>
        </div>
            <?php endforeach; ?>
    </div>
</body>
</html>


