<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{

	$source=$_POST["source"];
	$servername="localhost";
	$username="alpha";
	$password="1234";
	$dbname="website";
	$link =mysqli_connect('localhost', 'alpha', '1234','language');
		if (! $link) {
	    die('Could not connect: ' . mysql_error());
		}
	$string = $source;
	$res = preg_replace("/[^a-zA-Z]/", " ", $string);
	$string=strtok($res," ");
	$lan="";
	while ($string!=false)
	{
			if(strlen($string)>1)
		{
			$sql='select word from words where word=\''.$string.'\';';
			$result=mysqli_query($link,$sql);
			if($result->num_rows==0)
			{

				$sql='insert into words values(\''.$string.'\','.strlen($string).',\''.$lan.'\');';
				$result1=mysqli_query($link,$sql);
			}
			echo mysqli_error($link);
		}
		$string=strtok(" ");

	}
	


}
?>