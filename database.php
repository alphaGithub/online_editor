<?php
session_start();
function fileList()
{
$uid=$_SESSION['uid'];
$conn =mysqli_connect('localhost', 'alpha', '1234','website');
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
?>
<!DOCTYPE html>
<html>
<head>
<link rel="StyleSheet" type="text/css" href="/design/database.css">
<script type="text/javascript"  src="script/jquery-3.1.1.min.js"></script>

</head>
	
<body>

	<script type="text/javascript" src="script/database.js"></script>
<div id="page2">
	<div class="header2">
	<div id="headName2">
	<div style="float:left;width:15%;margin-left:10px;margin-right:2%;margin-top:10px">	<span id="titleWebsite"><b> <?php echo $_SESSION['username'];?> </b></span></div>
	<div id='navigation'>
	<ul id='nav'>
	<li id='nli'><a href='javascript:void(0)' onclick="tabs(event,'edit')" class="tlinks" id='home'>Home</a></li>
	<li id='nli'><a href='javascript:void(0)' onclick="tabs(event,'profile')" class="tlinks">Profile</a></li>
	<li id='nli'><a href='javascript:void(0)' onclick="tabs(event,'blog')" class="tlinks">Blog</a></li>
	<li id='nli' style="float:right ;margin-top:0px;margin-bottom:0px;padding:0px">
	<div id="logoutForm" style="float:right">
	<form method="post" action="index.php"><span id="logout"><button id="btnLogout" name="submit" value="3" onclick="logout()">Logout</button></span></form>
	</div>
	</li>
	</ul>
</div>
</div>
</div>

<div id="hint">
<ul><li id="hintHead">Hint</li></ul>
<div id="process"></div>
<div id="fileList">
<?php
fileList();
?>
</div>
</div>


<div id="edit" class="tcontent" >
<div id='tarea'>
<div id='fileInfo'><table id='fnameFetch'><td id='tdata'>File Name:</td><td id='tdata'><input id='fileName' type="text" value="default"></td></table></div>
<textarea id="text" rows="30" autocomplete="off" spellcheck="false" onkeyup="hint(this.value,event)"></textarea>
<button id="btnText" onclick="myText()">SQL Query</button>
<button id="btnClear" onclick="clearText()">clear</button>
<button id="btnSave" onclick="saveFile()" value='8'>Save</button>
<button id="btnDelete" onclick="deleteFile()">Delete</button>
<button id="btnNew" onclick="newFile()" value='9'>New</button>
<div id='output'>
<table id='fnameFetch'><tr><th id='fthead'>Result</th></tr></table>
<div id="result"></div>
</div>
</div>
</div>
<div id='profile' class='tcontent'>
<div id='pcontent'>
<table id='profileContent'>
</table>
	
</div>
</div>
<div id='blog' class='tcontent'>
<div id='blogContent'>
	<div id='barea'>
	<div id='blogInfo'>
	<table id='fnameFetch'><td id='tdata' style="float:left">Title:<input id='blogTitle' type="text" value=""></td><td id='tdata'></td></table>
	</div>
	<textarea id='blogText' rows='10' autocomplete="off" spellcheck="false" onkeyup="hint(this.value,event)">
	</textarea>
	<button id='btnPost' onclick="postBlog()">POST</button>
	</div>
	<div id='blogs'>
	</div>
</div>
</div>


<div id="friend">

<div id="addTab">
<ul id="listTab">
	<li id="tabElement">
		<a href="javascript:void(0)" class="tablinks" onclick="tabView(event,'Search')">Search</a>
	</li>
	<li id="tabElement">
		<a href="javascript:void(0)" class="tablinks" onclick="tabView(event,'addFriend')" id='fclick' >Request</a>
	</li>
</ul>
<div id='Search' class='tabcontent'>
Name:<input type="text" name="searchInput" spellcheck="false" onkeyup="searchFriend(this.value)">
<div id='searchOutput'>

</div>
</div>
<div id='addFriend' class='tabcontent'>

</div>
</div>
<div id="friendList"> 
<ul id='listTab'>
	<li id='tabElement'>
	<a href='javascript:void(0)'>Friends</a>
	</li>
</ul>
<div id='fList'>
</div>
</div>
</div>
<br>

<script>
	document.getElementById('fclick').click();
	document.getElementById('home').click();
	getProfile();
	getBlog();
</script>
<!--<div id="tarea">
	<textarea id='text' rows="5" autocomplete="off" spellcheck="false"> </textarea>
	<button id='blog' name='blog' value='6'>POST</button>
</div>

-->
<div id="test" style="visibility:hidden"></div>



<div id="page3"></div>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
if($_SESSION['status']==0)
{
	include "index.php";
}
}
?>
<script>
	function logout()
{
     $(document).ready(function(){
     $("#page2").remove();
     });

}

</script>
</body>
</html>