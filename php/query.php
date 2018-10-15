<?php

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$sql=$_POST["query"];
	$servername="localhost";
	$username="alpha";
	$password="1234";
	$dbname="website";
	$link =mysqli_connect('localhost', 'alpha', '1234','website');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}
	
	
	if($result=mysqli_query($link,$sql))
	{
	
	$names[mysqli_num_fields($result)];

	echo "<table id='fetch'>";
	$i=0;
	while($fieldinfo=mysqli_fetch_field($result))
	{
		$names[$i]=$fieldinfo->name;
		echo "<th id='thead'>".$names[$i]."</th>";
		$i++;
	}
	$len=$i;
	
    while($row =$result->fetch_assoc())
    {
        $i=0;
        echo "<tr>";
        while($i!=$len)
        {
        echo "<td id='tdata'>".$row[$names[$i]]."</td>";
        $i++;
    	}
    	echo "</tr>";
    }
    echo "</table>";
    echo "<br><p id='err'>Successfull query</p>";
	}
	else
	{
	
		echo "<p id='err'><b>Error :</b>".mysqli_error($link)."</p>";
			}
	mysqli_close();
}
?>