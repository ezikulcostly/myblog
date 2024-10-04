<?php
include_once('dbconnect.php');
$active = "home";
session_start();
   
//check if logged in
if(!isset($_SESSION['Username'])) {
		 header('location:login.php');
}	
	//number of rows per page
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = 1;
	}
  	$start = ($page-1)*3;
	$row_per_page = 3;
  $sql = "SELECT * FROM blogpost ORDER BY CreatedAt DESC LIMIT $start, $row_per_page";	
   $result = mysqli_query($conn, $sql);
   
   //login timeout duration
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
<a href="myweb.php"class = "<?php if($active=='home'){echo 'active';}?>">HOME</a>
<a href="info.php">ABOUT </a> 
<a href="contact.php">CONTACT </a>

<button class ="btn"><a href="blogpost.php"> ADD POST </a></button>
<button class ="btn"><a href="logout.php"> LOGOUT </a></button>
</div>
</header>
<div style="padding-top:150px">
<div class = "row">
  
<div class = "column">

 <?php foreach($result AS $post){?>
   <div class = "column left">
    <?php echo "<img src = 'uploads/".$post['picture']."'>"; ?>
	</div>
	<div class = "column right">
	<p><?php echo $post['CreatedAt']; ?></p>
        <h3><?php echo  $post['Title']; ?> </h3>
        <p class="hide" id ="showText"><?php echo $post['Content']; ?></p>
		
		</div>
		<a href ="showmore.php?id=<?php echo $post['id']?>"><button class = "more-btn">Read More</button></a>

</div>
 <hr>
 <?php } ?>
 </div>
 </div>
 <?php
 $pr_query = "SELECT * FROM blogpost";
 $pr_result = mysqli_query($conn, $pr_query);
 $total_record = mysqli_num_rows($pr_result);
 
 $total_page = ceil($total_record / $row_per_page );
 
 //create pagination
echo "<div class = 'pagination'>";

if($page>1){
echo "<a href = 'myweb.php?page=".($page-1)."'> &laquo Prev </a>";
}
 for($i=1;$i<$total_page;$i++){
	 echo "<a href='myweb.php?page=".$i."' >$i<a/>";
 }
 
 if($i >$page){
echo "<a href = 'myweb.php?page=".($page+1)."'> Next &raquo </a>";
}
echo"</div>";
 ?>
<div style="padding:40px">
</div>
 <div class = "footer">
        <p>&copy; <?php echo date("Y")?> My Blog</p>
    </div>
	

</body>
</html>