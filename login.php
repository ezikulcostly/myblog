<?php
session_start();
//database connection
include_once ('dbconnect.php');

if(isset($_POST['login'])){
$username = $_POST['uname'];
$password = $_POST['pswd1'];

    // Fetch user data from database
   $sql = "SELECT * FROM register WHERE Username='$username' AND Password='$password'";
    $result = mysqli_query($conn, $sql);
	
  $row = mysqli_fetch_assoc($result);
 //check if use exist
    if (mysqli_num_rows($result) > 0 ) {
		$_SESSION['login'] = true;	
      $_SESSION['Username'] = $row['Username'];
         header('Location: myweb.php');
        
        }else{
            $errormsg = " Incorrect username or password Try again! ";
        }/*else{
         $errormsg = "User not found" . "<a href ='register.php'>"."<strong>Please Register!</strong>"."</a>";
		}*/
}

mysqli_close($conn);
?>

<!DOCTYPEhtml>
<html>
<head>
<title> login form </title>
<meta name ="viewport" content = "width = device-width ,initial-scale = 1">
<link rel="stylesheet" href="loginStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.login-form{
	display:flex;
	justify-content:center;
	align-items:center;
	padding:16px;
   margin:auto;
   width:50%;
}
input[type=text], input[type=password], input[type=email]{
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
input[type=text]:focus, input[type=password]:focus, input[type=email]:focus {
  background-color: #ddd;
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
  opacity: 0.8;
}

button:hover {
  opacity:1;
}

p{
	text-align:center;
}
h1{
	text-align:center;
	
}
.error-msg{
	text-align:center;
	background-color:lightgrey;
	padding:15px;
	font-size:15px;
	margin:10px;
	border-radius:6px;
	color:red;
}
</style>
</head>
<body>
<div class="login-form">

  <form  onsubmit = "return formValidation()" method = "POST" name="ourform">
   <h1> LOGIN </h1>
   <?php
   if(isset($errormsg)){
		  echo
		  '<div class = "error-msg">'.$errormsg.'</div>';
	  }
   echo"<br>"
   ?>
  <i class="fa fa-user"></i>
  <label for="uname"> USERNAME </label>
  <input type= "text" name="uname" id="uname" placeholder="Username"><br>
  <span id="uname-msg" style="color:red"> </span><br><br>
  
  <i class="fa fa-key"></i>
  <label for="pswd"> PASSWORD </label>
  <input type= "password" name="pswd1" id="pswd1" placeholder="Password"><br>
  <span id="pswd1-msg" style="color:red"> </span><br>
  
    <button type ="submit" class = "login-btn" name="login">LOGIN</button> 
	
	<p>Forgotten <a href="#">password ?</a>
  <p>Don't have an account ? <a href="register.php">signup</a>
  </form> 

  </div>

    <script >
	//src = "logform.js"
	function formValidation(){
   let uname = document.getElementById("uname").value; 
   let pswd1 = document.getElementById("pswd1").value; 
   
      if(uname ==""){
   document.getElementById("uname-msg").innerHTML = "username required to login";
   return false;
   }
      if(pswd1 ==""){
   document.getElementById("pswd1-msg").innerHTML = "password required to login";
   return false;
   }
}   
  </script>
  </body>
  </html>