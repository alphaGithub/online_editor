<?php
session_start();
?>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST["submit"]==1)
	{
	$uid=$_SESSION['uid'];
	$conn =mysqli_connect('localhost', 'alpha', '1234','website');
	$sql="select * from profile where id=".$uid."";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
		while($row=$result->fetch_assoc())
		{
			$fname=$row['firstName'];
			$lname=$row['lastName'];
			$dob=$row['dob'];
			$gender=$row['gender'];
			$addr=$row['address'];
			$country=$row['country'];
			$email=$row['email'];
			$m="";$f="";
			if($gender==NULL)
			{
				$m="";
				$f="";
			}
			else if($gender=="Male")
			{
				$m="checked";
			}
			else if($gender=="Female")
			{
				$f="checked";
			}
			echo "<tr><th id='phead'>Profile</th><th id='phead'></th></tr>";
			echo "<tr><td id='pname'>First Name</td><td id='pdata'>:<input type='text' value='".$fname."' name='fname' id='fname' spellcheck='false'></td></tr>";
			echo "<tr><td id='pname'>Middle Name</td><td id='pdata'>:<input type='text' value='".$lname."' name='lname'  id='lname' spellcheck='false'></tr>";
			//echo "<tr><td id='pname'>Date of Birth</td><td id='pdata'>:<input type='date' value='".$dob."' name='dob' id='fname'></td></tr>";
			//echo "<tr><td id='pname'>Gender</td><td id='pdata'>:<input type='radio' id='gender' name='gender' value='Male'  ".$m.">Male<input type='radio' id='gender' name='gender' value='Female' ".$f.">Female </td></tr>";
			echo "<tr><td id='pname'>Address</td><td id='pdata'>:<input type='text' id='addr' value='".$addr."' name='addr' spellcheck='false'></td></tr>";
			echo "<tr><td id='pname'>country</td><td id='pdata'>:<input type='text' id='country'  value='".$country."' name='country' spellcheck='false'></td></tr>";
			echo "<tr><td id='pname'>Email</td><td id='pdata'>:".$email."</td></tr>";
			echo "<tr><td id='perrmsg'></td><td><button id='btnUpdate' name='submit' value='2' onclick=updateProfile()>Update</button></td></tr>";
			break;
		}
	}
	}

	if($_POST["submit"]==2)
	{
	$uid=$_SESSION['uid'];
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$addr=$_POST['addr'];
	$country=$_POST['country'];
	$dob=$_POST["dob"];
	$gender=$_POST["gender"];
	
	if(strlen($fname)==0)
	{

		//echo $fname." ".$lname." ".$addr." ".$country;
	}
	
	else
	{
	$conn =mysqli_connect('localhost', 'alpha', '1234','website');
	$sql="update profile set firstName='".$fname."',lastName='".$lname."',address='".$addr."',country='".$country."' where id=".$uid."";
	$result=$conn->query($sql);
	echo "Successfully Updated";
	}
	}

}
?>