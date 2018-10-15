function loginClick()
{
$(document).ready(function(){
	$("#btnLoginForm").click();
	snackBar();
});
}
function signupClick()
{
$(document).ready(function(){
	$("#btnSignupForm").click();
	snackBar();
});
}

function afterLogin()
{
$(document).ready(function(){ 
$('#page1').remove();
});	

}
function validate()
{
	var usr=document.forms['login']['username'];
	var pass=document.forms['login']['password'];
	if(!(usr=="" || pass==""))
	{
		return true;
	}
	return false;
}
$('document').ready(function(){
	$('#btnLogin').click(function(){
		loginToAccount();
	});
});
           
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
	xhttp.send(sendData);
}
function ajaxRequestGet(id,location)
{
	var xhttpd=new XMLHttpRequest();
	xhttpd.onreadystatechange=function(){
		if(this.readyState==4 && this.status ==200)
			{
				document.getElementById(id).innerHTML=this.responseText;

			}};
	xhttpd.open("GET",location,true);
	xhttpd.send();
}
function snackBar() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar")

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}