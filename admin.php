<?php 
    if(isset($_POST["submit"])){
        $blogTitle = $_POST["title"];
        $blogContent = $_POST["content"];

        $file = $_FILES["image"];
        $fileOriginalName = $file["name"];
        $explodedName = explode('.',$fileOriginalName);
        $fileExtension = strtolower(end($explodedName));
        $fileTempLoc = $file["tmp_name"];

        if(!$file["error"]){
            $fileName = "blogImg".uniqid("",true).".".$fileExtension;
            $filePath = "uploads/".$fileName;
            
            if(explode('/',$file["type"])[0]==="image"){
                move_uploaded_file($fileTempLoc,$filePath);

                $conn=mysqli_connect('localhost','root','password','%dbname%');
                if(!mysqli_connect_errno()){

                    $sql = "INSERT INTO blogs (title,content,img) VALUES ('$blogTitle','$blogContent','$filePath')";
                    
                    if(mysqli_query($conn,$sql)){
                        $message = "Blog posted Successfully";
                    }
                    else{
                        $message = "Error try again". mysqli_error($conn);
                    }
                    
                }else{
                    $message = "Error try again";
                }
                
            }
            else{
                $message = "Invalid File Type";
            }
        }
        else{
            $message = "There was an error uploading file";
        }
        header('Location: admin.php?message='.$message);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>

<style> 
    .admin-form{
        margin:3rem auto;
    }
    .input__block{
        margin-bottom: 1.5rem;
        width:60%;
        padding:1rem;
        display: flex;
        align-items: center;
    }
    input:not(input[type=submit]),textarea{
        padding:1rem 0.5rem;
        width:80%;
        margin-left: auto;
        font-size: 1.3rem;
    }
    label{
        text-transform: capitalize;
        font-size: 1.5rem;
    }
    input:focus{
        outline: none;
    }
    input[type=submit]{
        padding:0.5rem 2rem;
        display:block;
        margin:0 auto;
    }
    
</style>

<body>
    <form method="POST" enctype="multipart/form-data" class="admin-form">
        <div class="input__block">
            <label for="title">Title </label>
            <input type="text" name="title" id="title">
        </div>

        <div class="input__block">
            <label for="content">content </label>
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
        </div>

        <div class="input__block">
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>

        <div class="input__block">
            <input type="submit" name="submit" value="POST">
        </div>
    </form>
</body>
<?php 
    if(isset($_GET["message"])){
        $message = $_GET["message"];
        echo "<script>alert('$message')</script>";
    }
?>
</html>

