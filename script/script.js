
        $(document).ready(function ()
         {
        $("#login").hide();
        $(".createAccount").hide();
        $("#signup").click(function () {
       $(".loginForm").hide();
        $(".createAccount").show();
        $("#login").show();
        $('#signup').hide();});


        $("#login").click(function () {
        $(".createAccount").hide();
            $(".loginForm").show();
            $("#signup").show();
            $('#login').hide();

        });
    });
function validate()
{
    var x = document.forms["loginUser"]["username"].value;
    var y = document.forms["loginUser"]["password"].value;
    if(x=="" || y=="")
    {
        return false;
    }
    else
    {
        return true;
    }
}
function myfunction()
{
    if (validate()) {
        var x = encodeURIComponent(document.forms["loginUser"]["username"].value);
        var y = encodeURIComponent(document.forms["loginUser"]["password"].value);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("show").innerHTML = this.responseText;
               }
        };
        var data = "username=\""+x+"\"&"+"password=\""+y+"\"";
        xhttp.open("POST", "checkForm.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("username="+x+"&password="+y);
        $.get("account.js", function (data, status) {});
        $.get("myscript.js",function (data,status)  {});
    }
}
function updateData(str) {
        var xhttp;
     if (str.length == 0) { 
     document.getElementById("show").innerHTML = "";
     return;
 }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("show").innerHTML = this.responseHTML;
    }
  };
  xhttp.open("GET", "test.php?q="+str, true);
  xhttp.send();
}
