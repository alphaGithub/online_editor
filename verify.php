<?php
session_start();
$usr=$_POST['username'];
$pass=$_POST['password'];
if($usr=='ak9067007327@gmail.com')
{
	if($pass='1234');
	{
		echo 'login successfull';
	}
	else
	{
		echo 'forgot password';
	}
}
else
{
	echo 'username incorrect';
}
?>