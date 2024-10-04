<?php

include_once('dbconnect.php');

//check if already logged in
session_start();
if (!isset($_SESSION['Username'])) {
	echo $errormsg = "<script> alert( ' please login to add post! ')</script>";
	 header('Location: addlogin.php');
 
}
//upload file
$err = "";
if(isset($_POST['post'])){
    $title = $_POST['title']; 
    $content = $_POST['content'];
	$image = $_FILES['image']['name'];
	$tempname = $_FILES['image']['tmp_name'];
	
	$target = "uploads/".basename($image);
//check if file exists	
	if(file_exists($target)){
		 echo "<script> alert('image already exists')</script>";
		 $uploadOk = 0;
	}
  if(move_uploaded_file($tempname, $target)){
	  echo "<script> alert('image uploaded')</script>";
  }else{
	  echo "<script> alert('image not uploaded')</script>";
  }
     $sql = "INSERT INTO blogpost (Title, Content, picture)
	   VALUES ('$title','$content','$image')";
    if (mysqli_query($conn, $sql)) {
      header('Location:myweb.php');
	}else{
      echo "error:". $sql . "<br"> mysqli_error($conn);
  }

  mysqli_close($conn);
   }

//check session timeout
 $timeout = 100;
	
	if (isset($_SESSION['timestamp'])){
	$duration = time() - $_SESSION['timestamp'];
	if ($duration > $timeout) {
        session_unset();
        session_destroy();
        header("Location: myweb.php");
        exit();
	}
	}
$_SESSION['timestamp'] = time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name ="viewport" content = "width = device-width ,initial-scale = 1">
    <meta charset="UTF-8">
    <title>Create Post</title>
</head>
<style>
body{font-family : Arial, Helvetica, sans-serif;
font-weight:bold;
}
*{box-sizing : border-box;}

nput[type=file], input[type=text], textarea{
    width:100%;
    padding:15px;
    border:none;
	border:1px solid lightgrey;
	border-radius:5px;
	background-color:#grey;
	margin:5px;
	display:inline-block;
	font-weight:bold;
	transition:1s ease;
}
input[type=text]:focus, textarea:focus{
  background-color: aliceblue;
  outline: none;
}	
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius:5px;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}
.cancel a{
	position:fixed;
	top:2;
	right:10;
	font-size:40px;
	color:black;
	text-decoration:none;
}
.cancel a:hover{
	color:red;
}
</style>
<body>
  <div style="text-align:center">
  <span class = "cancel"><a href = "myweb.php" title = "close"> &times </a></span>
    <h2> New Post </h2>
	<p> <?php echo strtoupper(($_SESSION['Username'])); ?> what is on your mind?</p>
	</div>
    <form method="post" enctype="multipart/form-data">    
	<label for="image">Add Image</label>
        <input type="file" id="image" name="image" title ="choose a photo" required>
        <br><br>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder ="Topic of what you are sharing" required>
        <br><br>
        <label for="content">Content</label>
        <textarea id="content" name="content" placeholder = "Content of what you are sharing " required></textarea>
        <br><br>
        <button type="submit" name = "post">SHARE</button>
    </form>
</body>
</html>
