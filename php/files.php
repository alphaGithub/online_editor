<?php
session_start();
?>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{

if($_POST["submit"]==8)
{
$content=$_POST["content"];
$uid=$_SESSION['uid'];
$fname=$_POST["fname"];
$conn=new mysqli("localhost:3306","admin","12345678","website");
$sql="select fname,uid from file where fname='".$fname."' and uid=".$uid."";
$result=$conn->query($sql);
if($result->num_rows==0)
{
$sql1="insert into file (fname,uid,content) values('".$fname."',".$uid.",'".$content."');";
$result1=$conn->query($sql1);
echo "file saved Successfully";
}
else
{
$content=trim($content);	
$sql2="update file set content='".$content."' where uid=".$uid." and fname='".$fname."'";
$result2=$conn->query($sql2);
echo "file saved Successfully";
}
}



if($_POST["submit"]==4)
{
$uid=$_SESSION['uid'];
$conn =mysqli_connect('localhost', 'admin', '12345678','website');
$sql="select fname from file where uid=".$uid."";
$result=$conn->query($sql);
echo "<table id='ffetch'>";
echo "<tr><th id='thead'>User</th><th id='thead'>Files</th></tr>";
if($result->num_rows>0)
{


	while($row=$result->fetch_assoc())
	{
		$fname=$row["fname"];
		echo "<tr><td id='ftdata'>".$fname."</td>";
		echo "<td><button id='btnfile' value='".$fname."' onclick='openFile(this.value)'>open</button></td>";
		echo "</tr>";
	}
}
if($row=$result->num_rows==0)
{
	echo "<tr><td id='tdata'>No files found</td><td id='tdata'></td></tr>";
}
echo "</table>";

}


if($_POST["submit"]==5)
{

	$uid=$_SESSION['uid'];
    $fname=$_POST["fname"];
   	$conn=mysqli_connect('localhost','admin','12345678','website');
	$sql="select content from file where fname='".$fname."' and uid=".$uid."";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
	while($row=$result->fetch_assoc())
	{
		$content=$row["content"];
		echo  trim($content);
	}
}

}

if($_POST["submit"]==6)
{
	$uid=$_SESSION['uid'];
    $fname=$_POST["fname"];
	$conn=mysqli_connect('localhost','admin','12345678','website');
	$sql="delete from file where fname='".$fname."' and uid=".$uid."";
	$result=$conn->query($sql);
	echo "delete operation performed";
}

}
?>