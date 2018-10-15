<?php
session_start();
?>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{

if($_POST["submit"]==1)
{
$search=$_POST["search"];
$fname=$_POST["fname"];
$conn=new mysqli("localhost:3306","alpha","1234","website");
$sql="select firstName,lastName,id from profile where concat(firstName,' ',lastName) like '".$search."%'  and id!=".$_SESSION['uid']." and id not in (select bid from friends where aid=".$_SESSION['uid'].")";
$result=$conn->query($sql);
echo "<ul id='searchList'>";
if($result->num_rows>0)
{


	while($row=$result->fetch_assoc())
	{
		$fname=$row["firstName"];
		$lname=$row["lastName"];
		$id=$row["id"];
		echo "<li id='searchItem'><div id='fullName' >".$fname." ".$lname."</div><button id='btnfile'  value='".$id."' onclick='sendRequest(this.value)'>send</button></li>";
		
	}
}
if($row=$result->num_rows==0)
{
	echo "<li>No Result found</li>";
}
echo "</ul>";
}


if($_POST["submit"]==2)
{
$sid=$_SESSION['uid'];
$conn=new mysqli("localhost:3306","alpha","1234","website");
$sql="select sid from frequest where rid=".$sid;
$result=$conn->query($sql);
echo "<ul id='searchList'>";
if($result->num_rows>0)
{

	$i=0;
	while($row=$result->fetch_assoc())
	{
		$sid[$i]=$row["sid"];
		$i++;
	}
	$j=0;
	while($j<$i)
	{
	$sql="select firstName,lastName from profile where id=".$sid[$j];
	$result1=$conn->query($sql);
	if($result1->num_rows>0)
	{
	while($row=$result1->fetch_assoc())
	{
		$fname=$row["firstName"];
		$lname=$row["lastName"];
		echo "<li id='searchItem'>".$fname." ".$lname." <button id='btnAccept' value='".$sid[$j]."' onclick='acceptRequest(this.value)'>Accept</button></li>";
	
	}
}
	$j++;

	}
}

if($row=$result->num_rows==0)
{
	echo "<li>Currently You Have No Friends Request</li>";
}
echo "</ul>";
}



if($_POST["submit"]==3)
{
$uid=$_SESSION['uid'];
$conn=new mysqli("localhost:3306","alpha","1234","website");
$sql="select bid from friends where aid=".$uid;
$result=$conn->query($sql);
echo "<ul id='searchList'>";
if($result->num_rows>0)
{

	$i=0;
	while($row=$result->fetch_assoc())
	{
		$bid[$i]=$row["bid"];
		$i++;
	
	}
	$j=0;
	while($j<$i)
	{
	$sql="select firstName,lastName from profile where id=".$bid[$j];
	$result1=$conn->query($sql);
	if($result1->num_rows>0)
	{
	while($row=$result1->fetch_assoc())
	{
		$fname=$row["firstName"];
		$lname=$row["lastName"];
		echo "<li id='searchItem'>".$fname." ".$lname."</li>";
	
	}
}
	$j++;

	}
}

if($row=$result->num_rows==0)
{
	echo "<li>Sorry Currently Your Have No Friends</li>";
}
echo "</ul>";
}

if($_POST["submit"]==4)
{
$id=$_POST["id"];
$conn=new mysqli("localhost:3306","alpha","1234","website");
$sql="insert into frequest values(".$_SESSION['uid'].",".$id.");";
$result=$conn->query($sql);
echo "Request Send";
}


if($_POST["submit"]==5)
{
$id=$_POST["id"];
$conn=new mysqli("localhost:3306","alpha","1234","website");
$sql="insert into friends values(".$_SESSION['uid'].",".$id.");";
$sql1="insert into friends values(".$id.",".$_SESSION['uid'].");";
$sql2="delete from frequest where sid='".$id."' and rid='".$_SESSION['uid']."'";
$conn->query($sql);
$conn->query($sql1);
$conn->query($sql2);
echo "Request Accepted";


}
}
?>