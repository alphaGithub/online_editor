<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
	
	if($_POST['submit']==1)
	{
		$content=$_POST['content'];
		$content=trim($content);
		$title=$_POST['title'];
		$uid=$_SESSION['uid'];
		if($content=="")
		{
			echo "Please Enter Content in Blog Area";
		}
		else
		{
			$conn=new mysqli('localhost','alpha','1234','website');
			$sql="select bid from friends where aid=".$uid;
			$result=$conn->query($sql);
			if($result->num_rows>0)
			{

			$i=0;
			while($row=$result->fetch_assoc())
			{
			$bid[$i]=$row["bid"];
			$i++;
			}
			$bid[$i]=$uid;
			$sql1="insert into blog (content,sid,title) values('".$content."',".$uid.",'".$title."')";
			$conn->query($sql1);
			$sql2="select blogId from blog where sid=".$uid." order by date_of_send desc";
			$result2=$conn->query($sql2);
			$blogId=1;
			while($row=$result2->fetch_assoc())
			{
				$blogId=$row['blogId'];
				break;
			}
			$j=0;
			while($j<=$i)
			{
			$sql="insert into blogsendto values('".$uid."','".$bid[$j]."','".$blogId."')";
			$result1=$conn->query($sql);
			$j++;
			}
			}	
		}
	}
	if($_POST["submit"]==2)
	{
		$uid=$_SESSION['uid'];
		$conn=new mysqli('localhost','alpha','1234','website');
		$sql="select blogId from blogsendto where rid=".$uid." order by blogId desc";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
		$i=0;
		while($row=$result->fetch_assoc())
		{
		$bid[$i]=$row["blogId"];
		$i++;
		}
		}
		$j=0;
		echo "<ul id='blogList'>";
		while($j<$i)
		{



			$sql="select content,sid,title from blog where blogId=".$bid[$j]."";
			$result1=$conn->query($sql);
			if($result1->num_rows>0)
			{
				while($row=$result1->fetch_assoc())
				{
					$content=$row['content'];
					$sid=$row['sid'];
					$title=$row['title'];


			$name="";
			$sql="select firstName,lastName from profile where id=".$sid."";
			$result2=$conn->query($sql);
			if($result2->num_rows>0)
			{
			while($row1=$result2->fetch_assoc())
			{
			$fname=$row1["firstName"];
			$lname=$row1["lastName"];
			$name=$fname." ".$lname;
	
			}
			}
					echo "<li id='blogItem'>";
					echo "<table id='fnameFetch'><td id='tdata' style='float:left'>".$name."</td><td id='tdata' style='float:right;'>".$title."</td><td id='tdata'></td></table>";
					echo "<div id='blogData'>";
					echo "<textarea id='blogResponse' rows='7' autocomplete='off' spellcheck='false' onkeyup='hint(this.value,event)' value='".$content."'>";
					echo $content;
					echo "</textarea>";
					echo "</div>";
					echo "</li>";
				}
			}
			$j++;
		}
		echo "</ul>";
	}
	
}
?>