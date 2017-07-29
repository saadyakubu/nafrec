<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nigerian Air Force</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/login.css">
        <!-- Bootstrap validation styling -->
        <link rel="stylesheet" href="css/formValidation.min.css"/>
        <link rel="icon" href="images/naf.ico">
        <link href="css/starter-template.css" rel="stylesheet">

    </head>
    <body>
        <div class="login_bg">
            <div class="container">
                
                <div class="form-signin" action="v_login.php" method="post" id="form-signing"><!--<form class="form-signin" action="v_login.php" method="post" id="form-signing">--> 
                    <h1 class="form-signin-heading text-muted">Sign In</h1>
                    <div id="errormsgcontainer"><div id="errormsg"></div></div>
                    <input type="text" class="form-control" placeholder="Username" autofocus="" name="username" id="username" maxlength="15" required>
                    <input type="password" class="form-control" placeholder="Password" name="userpswd" id="userpswd" maxlength="15" required>
                    <!--<input class="btn btn-lg btn-primary btn-block" type="submit" value="Login">-->  
                    <button class="btn btn-lg btn-primary btn-block" type="button" onclick="verifyLogin()" >Login</button> 
                </div>

            </div>
        </div>

        
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/formValidation/formValidation.min.js"></script>
        <script type="text/javascript" src="js/formValidation/bootstrap.min.js"></script>
        <script type="text/javascript">
            function verifyLogin() {//(str) {
                var select = document.getElementById("username");
                var username = select.value;//select.options[select.selectedIndex].innerHTML.trim();
                var select1 = document.getElementById("userpswd");
                var pswd = select1.value;//select.options[select.selectedIndex].innerHTML.trim();
                //document.write(username+" "+pswd);
                if (username == "" && pswd=="") {
                    $("#username").css("border-color", "red");
                    $("#userpswd").css("border-color", "red");
                }
                if (username == "") {
                    $("#username").css("border-color", "red");
                    $("#userpswd").css("border-color", "black");
                }
                else if (pswd=="") {
                    $("#username").css("border-color", "black");
                    $("#userpswd").css("border-color", "red");
                }
                else
                {
                    $("#username").css("border-color", "black");
                    $("#userpswd").css("border-color", "black");
                    
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("errormsg").innerHTML = this.responseText;
                            
                        }
                    };
                    
                    xmlhttp.open("POST", "v_login.php", true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("username="+username+"&userpswd="+pswd);


                }
            }
            
        </script>
    </body>
</html>
