<?php
include_once('dbconnect.php');
session_start();
   
   $active = "contact";

if(!isset($_SESSION['Username'])) {
		 header('location:login.php');
}
 $timeout = 200;
	
	if (isset($_SESSION['timestamp'])){
	$duration = time() - $_SESSION['timestamp'];
	if ($duration > $timeout) {
        session_unset();
        session_destroy();
        header("Location: logout.php");
        exit();
	}
	}
$_SESSION['timestamp'] = time();
?>


<!DOCTYPEhtml> 
<html>
 
<head> 
<title>my website</title>
<meta name ="viewport" content = "width = device-width ,initial-scale = 1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel= "stylesheet" type="text/css" href="mywebstyle.css">
</head>
<body>
<header>
<h1> EZIKUL BLOG</h1>
<h3> HI <?php echo strtoupper($_SESSION['Username']); ?>
 welcome to purpose statement</h3> 
<div class ="topnav">
<a href="myweb.php">HOME</a>
<a href="info.php">ABOUT </a> 
<a href="contact.php"class = "<?php if($active=='contact'){echo 'active';}?>">CONTACT </a>

<button class ="btn"><a href="blogpost.php"> ADD POST </a></button>
<button class ="btn"><a href="logout.php"> LOGOUT </a></button>
</div>
</header>
<div style="padding-top:150px">
<div class = "contact">
<h2> CONTACT ME ON THE FOLLOWING</h2>
<br><br>
 <i class="fa fa-home"></i> No 8 Duke close, Eagle cement junction, Iwofe Road, PH, Nigeria<br>
  <i class="fa fa-phone"></i> 07062349404<br>
   <i class="fa fa-facebook"></i> Ezikul Costly<br>
    <i class="fa fa-envelope"></i> ezikulcostly@gmail.com<br>
	<br>
sponsored by <a style = "color:blue; text-decoration:underline" 
href = "https://www.ntesat.com">LIFE OF MY DREAM</a>
 </div>
  </div>
 <div class = "footer">
        <p>&copy; <?php echo date("Y")?> My Blog</p>
    </div>
</body>
</html>