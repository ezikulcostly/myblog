<?php
include_once('dbconnect.php');
$active = "info";
session_start();
   

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
<title>about us</title>
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
<a href="info.php"class = "<?php if($active=='info'){echo 'active';}?>">ABOUT </a> 
<a href="contact.php">CONTACT </a>

<button class ="btn"><a href="blogpost.php"> ADD POST </a></button>
<button class ="btn"><a href="logout.php"> LOGOUT </a></button>
</div>
</header>
<div style="padding-top:150px">

<h3>ABOUT ME</h3>
<p>I am Ezekiel Michael a <b>web developer</b> 
and one who loves seeing people achieving their goals inlife</p>
<p>I am <b> Not a graduate</b>.</p>
<p>My purpose to to encourage poeple who are emotionally down and depressed 
by cheering them up and putting smiles in thier faces.
</p>
<h3>ABOUT THE BLOG</h3>
We all know our primary purpose is to serve <b>GOD</b>,
<p>but this blog is going to help you know to know your other
puspose in life.</p>
<p>I will recomend you to check one of our books <b><i>LIFE OF MY DREAM (LOMD)</i></b></p>
<p><b>LOMD</b> planbook is your desired life defined in a book,
this planbook is for those striving towards achieving a life of
impact and fulfilment.</p>
<p>Although it is not a regular goal setting book but it's a guide to help
you leave the life you desire.

</p>

 </div>
<div style="padding:30px">
</div>
 <div class = "footer">
        <p>&copy; <?php echo date("Y")?> My Blog</p>
    </div>
</body>
</html>