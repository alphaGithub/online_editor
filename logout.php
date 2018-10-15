<?php
session_start();
?>
<?php
$_SESSION['status']=0;
$_SESSION['username']="";
$_SESSION['password']="";
$_SESSION['uid']="";
$_SESSION['username']="";	
session_destroy();
include "index.php";
?>