<html>
<body>
<?php
$uid=1;
$conn =mysqli_connect('localhost', 'admin', '12345678','website');
$sql="select fname from file where uid=".$uid."";
$result=query($sql);
if($result->num_rows>0)
{
	echo "<table>";
	echo "<tr><th>Files</th><th></th></tr>";
	while($row=$result->fetch_assoc())
	{
		$fname=$row["fname"];
		echo "<tr><td>".$fname."</td></tr>";
	}
	echo "</table>";
}
?>
</body>
</html>