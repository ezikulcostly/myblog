<?php
include_once ('dbconnect.php');
//check if already logged in
  session_start();
  if(isset($_SESSION['$Username'])){
	header("location:myweb.php");
} 
//validate email

if(isset($_POST['register'])){
	$error_msg = "";
	
	$firstname = mysqli_real_escape_string($conn, $_POST['fname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['uname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pswd1']);
	
	$select = "SELECT * FROM register WHERE Email='$email' OR Password ='$password'";
    $result = mysqli_query($conn, $select);
     
     
	 //check if useer already exist
	if (mysqli_num_rows($result) > 0) {
		  $error_msg ='user already exist try again!';
	}else{
	  // Insert data into users table
    $sql = "INSERT INTO register (Firstname, Lastname, Username, Email, Password,)
	   VALUES ('$firstname','$lastname','$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo $error_msg = "Registration successful!";
		header('Location: login.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
}
mysqli_close($conn);

?>
<!DOCTYPEhtml>
<html>
<head>
<title> signup form </title>
<meta name ="viewport" content = "width = device-width ,initial-scale = 1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.container{
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
<div>
 
 <div class="container">
  <form action="" onsubmit = "return Validate()" method = "POST" >
  <h1> SIGN UP</h1><br>
  <?php
  if(isset($error_msg)){
		  echo
		  '<div class = "error-msg">' .$error_msg. '</div>';
	  }
   echo"<br>"
  ?>
  <i class="fa fa-user"></i>
  <label for="fname"> FIRSTNAME </label>
  <input type= "text" name="fname" id="fname" placeholder="Firstname"><br>
  <span id="fname-msg" style="color:red"> </span><br><br>
  
  <i class="fa fa-user"></i>
   <label for="lname"> LASTNAME </label>
  <input type= "text" name="lname" id="lname" placeholder="Lastname"><br>
  <span id="lname-msg" style="color:red"> </span><br><br>
  
  <i class="fa fa-user"></i>
  <label for="uname"> USERNAME </label>
  <input type= "text" name="uname" id="uname" placeholder="Username"><br>
  <span id="uname-msg" style="color:red"> </span><br><br>
  
  <i class="fa fa-envelope"></i>
   <label for="email"> EMAIL </label>
  <input type= "email" name="email" id="email" placeholder="Email" required><br>
  <span id="email-msg" style="color:red"> </span><br><br>
  
  <i class="fa fa-key"></i>
   <label for="pswd1"> PASSWORD </label>
  <input type= "password" name="pswd1" id="pswd1" placeholder="Password"><br>
  <span id="pswd1-msg" style="color:red"> </span><br><br>
  
  <i class="fa fa-key"></i>
   <label for="pswd2"> REPEAT PASSWORD </label>
  <input type= "password" name="pswd2" id="pswd2" placeholder="Comfirm Password"><br>
  <span id="pswd2-msg" style="color:red"> </span><br>
  
  <button type ="submit" name="register">REGISTER</button>
  <input type="checkbox">i agree to the <a href ="#">
  terms&conditions </a>
  </form> 
  <p>Already have an account ? <a href="login.php">login</a>
  </div>
  </div>
  
  <script>
  function Validate(){
   let fname = document.getElementById("fname").value; 
   let lname = document.getElementById("lname").value; 
   let uname = document.getElementById("uname").value; 
   let email = document.getElementById("email").value; 
   let pswd1 = document.getElementById("pswd1").value; 
   let pswd2 = document.getElementById("pswd2").value; 
   
   if(fname ==""){
   document.getElementById("fname-msg").innerHTML = "please input your first name";
   return false;
   }
      if(lname ==""){
   document.getElementById("lname-msg").innerHTML = "please input your last name";
   return false;
   }
      if(uname ==""){
   document.getElementById("uname-msg").innerHTML = "please input your username";
   return false;
   }
      if(email==""){
   document.getElementById("email-msg").innerHTML = "please input your email";
   return false;
   }
      if(pswd1 == "" ) {
   document.getElementById("pswd1-msg").innerHTML = " please input password";
   return false;
   }
         if(pswd1.length < 8  ) {
   document.getElementById("pswd1-msg").innerHTML = " password must be at least 8 characters";
   return false;
   }
       if(pswd2 != pswd1){
   document.getElementById("pswd2-msg").innerHTML = "comfirm password does not match";
   return false;
   }
   }
  </script>
  </body>
  </html>
  
  

