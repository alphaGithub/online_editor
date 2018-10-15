var i=0;
var last=4;
var first=0;
var before=0;
var p=-1;
//function xml request 
function ajaxRequest(id,location,sendData)
{
     
     var xhttpd=new XMLHttpRequest();
     xhttpd.onreadystatechange=function(){
          if(this.readyState==4 && this.status ==200)
               {
                    document.getElementById(id).innerHTML=this.responseText;

               }};
     xhttpd.open("POST",location,true);
     xhttpd.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     xhttpd.send(sendData);
}
//sql query from text;
     
     function myText()
     {


     	document.getElementById('result').innerHTML="";
     	var x=document.getElementById('text').value;
     	if(x=="")
     	{
     		document.getElementById('result').innerHTML="Please ,Enter commonds in text field";
     	}
     	else
     	{
		
		var xhttp=new XMLHttpRequest();
		x=encodeURIComponent(x);
		processSource(x);
          ajaxRequest("result","/php/query.php","query="+x);
     }
}
     //send query to process the input symbols for saving the new words
     function processSource(x)
     {
     ajaxRequest("process","/php/processSource.php","source="+x);

     }
     //hint option while typing the words
     function hint(x,event)
     {
          if(event.which!=38 && event.which!=40 && event.which !=13)
               {
          document.getElementById('process').innerHTML="";
     	var xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange= function()
		{
			if(this.readyState==4 && this.status==200)
			{
				document.getElementById('process').innerHTML=this.responseText;

                    i=0;
                    last=4;
                    first=0;
                    before=0;
                    p=-1;
                    try
                    {
                    var tmp=document.getElementById('search1').innerHTML;
                    document.getElementById('test').innerHTML=tmp;
                    last=parseInt(tmp)-1;
               }catch (e)
               {

               }

			
			}
		};
		xhttp.open('POST','/php/hint.php',true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("hints="+x);
     }
     }
     // clear the content of all the element
     function clearText()
     {
     	document.getElementById('text').value="";
     	document.getElementById('result').innerHTML="";
     	document.getElementById('process').innerHTML="";
     }
     //setting the content in text area after replacing it with selected content
     function setdata(x)
     {
     	var str=document.getElementById('text').value;
     	var s=document.getElementById('search').innerHTML;
     	str=str.substring(0,str.length-s.length);
     	document.getElementById('text').value=str+x;
     	document.getElementById('search').innerHTML=x;
     }
function saveFile()
{
     var x=document.getElementById('text').value;
     x.trim();
     processSource(x);
     var y=document.getElementById('fileName').value;
     var s=document.getElementById('btnSave').value;
     ajaxRequest("result","/php/files.php","content="+x+"&&fname="+y+"&&submit="+s);
     ajaxRequest("fileList","/php/files.php","submit="+4);
}
function newFile()
{
     clearText();
     $(document).ready(function(){
          $('#fileName').val('default');
     });
}
function openFile(x)
{
     ajaxRequest("text","/php/files.php","fname="+x+"&&submit="+5);
     $(document).ready(function()
     {
          $('#fileName').val(x);
     });
}
function deleteFile()
{
     var x=document.getElementById('fileName').value;
     ajaxRequest("result","/php/files.php","fname="+x+"&&submit="+6);
     ajaxRequest("fileList","/php/files.php","submit="+4);
}
function tabView(evt,tabname)
{
     var i,tabcontent,tablinks;
     tabcontent=document.getElementsByClassName("tabcontent");
     for(i=0;i<tabcontent.length;i++)
          {
               tabcontent[i].style.display="none";
          }
     tablinks=document.getElementsByClassName("tablinks");
     for(i=0;i<tablinks.length;i++)
          {
               tablinks[i].className=tablinks[i].className.replace("active","");
          }
     document.getElementById(tabname).style.display="block";
     evt.currentTarget.className+="active";


}
function tabs(evt,tabname)
{
     var i,tabcontent,tablinks;
     tabcontent=document.getElementsByClassName("tcontent");
     for(i=0;i<tabcontent.length;i++)
          {
               tabcontent[i].style.display="none";
          }
     tablinks=document.getElementsByClassName("tlinks");
     for(i=0;i<tablinks.length;i++)
          {
               tablinks[i].className=tablinks[i].className.replace("active","");
          }
     document.getElementById(tabname).style.display="block";
     evt.currentTarget.className+="active";


}
function searchFriend(x)
{
     ajaxRequest('searchOutput','/php/friends.php','search='+x+'&&submit='+1);
     friendList();
     addFriends();
     getBlog();
}
function addFriends()
{
     ajaxRequest('addFriend','/php/friends.php','submit='+2);
}
function friendList()
{
     ajaxRequest('fList','/php/friends.php','submit='+3);
}
function sendRequest(x)
{
     ajaxRequest('result','/php/friends.php','id='+x+'&&submit='+4)
}
function acceptRequest(x)
{
     ajaxRequest('result','/php/friends.php','id='+x+'&&submit='+5);
     addFriends();
     friendList();
}
function getProfile()
{
     ajaxRequest('profileContent','/php/profile.php','submit='+1);
}
function updateProfile()
{
     var fname=document.getElementById('fname').value;
     var lname=document.getElementById('lname').value;
     var addr=document.getElementById('addr').value;
     var country=document.getElementById('country').value;
     //var dob=document.getElementById('dob').value;
     //var gender=document.getElementById('gender').value;
     ajaxRequest('perrmsg','/php/profile.php','submit='+2+'&&fname='+fname+'&&lname='+lname+'&&addr='+addr+'&&country='+country);
}
function postBlog()
{
     var x=document.getElementById('blogText').value;
     var title=document.getElementById('blogTitle').value;
    
     ajaxRequest('blogs','/php/blog.php','submit='+1+'&&content='+x+'&&title='+title);
     processSource(x);
     getBlog();
}
function getBlog()
{
     ajaxRequest('blogs','/php/blog.php','submit='+2)
}
friendList();
addFriends();
setInterval(getBlog,2500);



