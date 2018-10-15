<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{

	$string=$_POST["hints"];
	$servername="localhost";
	$username="alpha";
	$password="1234";
	$dbname="language";
	$link =mysqli_connect('localhost', 'alpha', '1234','language');
		if (! $link) {
	    die('Could not connect: ' . mysql_error());
		}
		$string=strtolower($string);
		$string=strrev($string);
		$res = preg_replace("/[^a-z]/", " ", $string);
		$str=parse_str($res);
		$str=strtok($res," ");
		$string=strrev($str);
		$i=0;
		if(strlen($string)>=1)
		{
			
			$string=$string.'%';

			$sql='select word from words where  word like \''.$string.'\' order by word=\''.$str.'\' asc ;';
			
			if($result=mysqli_query($link,$sql))
			{
			echo "<ul id='lfetch'>";
			
			while($row =$result->fetch_assoc())
    		{
        	echo "<li id='".$i."' onclick='setdata(this.innerHTML)' >".$row['word']."</li>";
        	$i++;
        	if($i==5)
        	{
        		
        		break;
        	}
    		}

    		echo "</ul>";
 		   }
 		   echo "<p id='search1'>".$i."</p>";
 		   echo "<p id='search'>".$string."</p>";
		}

	


}
?>