<?php
session_start();
		$_SESSION['email']="";
		$_SESSION['password']="";
		$_SESSION['uid']="";
		$_SESSION['status']=0;
?>
<?php
$msg="";
$user="";
$pass="";
?>

<!DOCTYPE html>
<html>
<head>
<title>Online Editor</title>
<script type="text/javascript"  src="script/jquery-3.1.1.min.js"></script>
<link rel="StyleSheet" type="text/css" href="design/sheetIndex.css">
<script type="text/javascript" src="script/scriptIndex.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<div id="page1">
	<div class="header">
	<div id="headName">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<span id="titleWebsite"><b>Online Editor</b></span>
		<span><button id="btnLoginForm">login</button></span>
		<span><button id="btnSignupForm">Signup</button></span>

	</div>
	<div></div>
	</div>
	<script>
	/*for toggling the fodiv
Username	￼
rm*/
	$(document).ready(function(){
	$("#btnLoginForm").click(function(){
		$("#loginForm").show();
		$('#btnSignupForm').show();
		$('#btnLoginForm').hide();
		$('#signupForm').hide();});
	$("#btnSignupForm").click(function(){
		$('#signupForm').show();
		$('#btnLoginForm').show();
		$('#btnSignupForm').hide();
		$('#loginForm').hide();});	
});

	</script>
	<div class="forms">
	<div id="loginForm">
    <form  name="login" method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="afterLogin()">
	<table id="loginTable">
	<tr>
		<td id="tc"></td>
		<td id="tc"></td>
	</tr>	
	<tr>
		<td id="tc">Username</td>
		<td id="tc"><input type="text" name="username"></td>
	</tr>
	<tr>
		<td id="tc">Password</td>
		<td id="tc"><input type="password" name="password"></td>
	</tr>
	<tr>
		<td id="tcerr" style="padding:5px 10px 5px 10px"><?php echo $msg; ?></td>
		<td id="tc"><button id="#btnLogin" name="submit" value="1">Login</button></td>
	</tr>
	</table>
    </form>
</div>


	<div id="signupForm">
    <form name="signup" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> ">
	<table id="loginTable">
	<tr id="tr1">

		<td id="tc"></td>
		<td id="tc"></td>
	</tr>	
	<tr>
		<td id="tc">FirstName</td>
		<td id="tc"><input type="text" name="firstName"></td>
	</tr>
	<tr>
		<td id="tc">LastName</td>
		<td id="tc"><input type="text" name="lastName"></td>
	</tr>
	<tr>
		<td id="tc">Email/Username</td>
		<td id="tc"><input type="text" name="email"></td>
	</tr>
	<tr>
		<td id="tc">Contact Number</td>
		<td id="tc"><input type="text" name="number"></td>
	</tr>
	<tr>
		<td id="tc">Password</td>
		<td id="tc"><input type="password" name="password"></td>
	</tr>
	<tr id="trn">
		<td id="tc"><?php echo $msg; ?></td>
		<td id="tc"><button id="btnSignup" name="submit" value="2" onclick="">Signup</button></td>
	</tr>
	</table>
    </form>
</div>
</div>
<script>

$('document').ready(function(){
$('button').click(function(){
$('.welcome').hide();
});
});
</script>
<div class="welcome">
	<div id="welcome1">
		<span>Welcome to Online Editor</span>
		<span></span>
		<br>
	</div>
</div>
<div class="footer">
<p id="test"><?php echo $msg;?></p>
<div id="snackbar">


<?php
if($_SERVER["REQUEST_METHOD"]=="POST") 
{
	if($_POST['submit']=="1")
{
	$user=$_POST['username'];
	$pass=$_POST['password'];
	if(strlen($user)==0 || strlen($pass)==0)
	{
		$msg="Please ,complete the form";
		echo "<script>loginClick()</script>";
		echo $msg;
	}
	else
	{
	$msg=login($user,$pass);
	echo $msg;
	echo "<script>loginClick();</script>";
	}
}
else if($_POST['submit']=="2")
{
	$fn=$_POST['firstName'];
	$ln=$_POST['lastName'];
	$user=$_POST['email'];
	$num=$_POST['number'];
	$pass=$_POST['password'];
	if(strlen($fn)==0 || strlen($ln)==0 || strlen($user)==0 || strlen($num)==0 || strlen($pass)==0)
	{

		$msg="Please ,fill the form correctly";
		echo $msg;
		echo "<script>signupClick();</script>";
	}
	else
	{
	$msg=signup($fn,$ln,$user,$num,$pass);
	echo $msg;
	echo "<script>signupClick();</script>";
	}
}
else if($_POST['submit']=="3")
{
$msg="Thanks for Login";
$_SESSION['status']=0;
$_SESSION['username']="";
$_SESSION['password']="";
$_SESSION['uid']="";
$_SESSION['username']="";	
session_destroy();
echo $msg;
echo "<script>loginClick();</script>";
}
}
function login($user,$pass)
{
$conn=new mysqli("localhost:3306","admin","12345678","mydb");
if($conn->connect_error)
{
    die("Connection failed :");
    return "server not working";
}
$sql="select * from account where email='".$user."';" ;
$result=$conn->query($sql);
if($result->num_rows>0)
{

	$p='';
	$id='';
	while($row =$result->fetch_assoc())
    {
      	$p=$row["passward"];
        $id=$row["uid"];
    }
    
  
    if($pass==$p)
    {
		$_SESSION['email']=$user;
		$_SESSION['password']=$pass;
		$_SESSION['uid']=$id;
		$_SESSION['status']=1;
		$sql="select firstName,lastName from profile where id='".$id."';";
		$row=null;
		$result1=$conn->query($sql);

		
		if($result1->num_rows>0)
		{
		while($row=$result1->fetch_assoc()){
		$fname=$row['firstName'];
		$lname=$row['lastName'];
		$_SESSION['username']=$fname." ".$lname;}
		}
		return "login successfull";
	}
    else
    {
    	return "username or password does not match";
    }
   } 

}
function signup($fn,$ln,$user,$num,$pass)
{
$conn=new mysqli("localhost:3306","alpha","1234","website");
if($conn->connect_error)
{
    die("Connection failed :");
    return "server not working";
}
$sql="select * from account where email='".$user."';" ;
$result=$conn->query($sql);
if($result->num_rows==0)
{
$sql1="insert into profile (firstName,lastName,phone,email) values('".$fn."','".$ln."','".$num."','".$user."');";
$sql2="select id from profile where email='".$user."';";
$conn->query($sql1);
$result1=$conn->query($sql2);
$id=0;
if($result1->num_rows>0)
{

	while($row =$result1->fetch_assoc())
    {
        $id=$row["id"];
    }
 }
$sql3="insert into account(uid,email,passward) values(".$id.",'".$user."','".$pass."');";
$conn->query($sql3);

return "Login Successfull";
}
}
?>
</div>
</div>
</div>
<?php
if($_SESSION['status']==1)
{
	echo "<script>afterLogin();</script>";
	include "database.php";

}
?>

</body>
</html>