<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
	
	if($_POST['submit']==1)
	{
		$content=$_POST['content'];
		$title=$_POST['title'];
		$uid=$_SESSION['uid'];
		$content=trim($content);
		if($content="")
		{
			echo "Please Enter Content in Blog Area";
		}
		else
		{
			$conn=new mysqli('localhost','admin','12345678','website');
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
			$result2=$conn->query($sq2);
			$blogId=1;
			while($row=$result2->num_rows>0)
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
}
?>