<!doctype html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
		<title>Nigerian Air Force</title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="icon" href="images/naf.ico">
        
        <script src="bg.js"></script>  
    </head>
    <body>
        <div class="login_bg">
            <div class="container">

            <form class="form-signin" action="v_login.php" method="post" id="login-form"> 
                <h1 class="form-signin-heading text-muted">Sign In</h1>
                <input type="text" class="form-control control-label" placeholder="Username" autofocus="" name="username">
                <input type="password" class="form-control control-label" placeholder="Password" name="userpswd">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            </form>

        </div>
        </div>

        
        
       <!-- placed at end of document so pages load faster -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <!-- Turn off client-side validation, in order to test server-side validation,-->
        <script type="text/javascript" src="../../js/formValidation/formValidation.min.js"></script>

        <!-- Note the following bootstrap.min.js file is for form validation, different from the one above. --> 
        <script type="text/javascript" src="../../js/formValidation/bootstrap.min.js"></script>

        <!-- IE10 viewport hack for surface/dekstop windows 8 bug -->
        <script src="../../js/ie10-viewport-bug-workaround.js"></script>
        <script type="text/javascript">
            //document.write("Awesome!");
            $(document).ready(function(){
                    $('#loginform').formValidation({
                                    message: 'This value is not valid',
                                    icon: {
                                            valid: 'fa fa-check',
                                            invalid: 'fa fa-times',
                                            validating: 'fa fa-refresh'
                                    },

            fields: {
                    username: {
                            validators: {
                                    notEmpty: {
                                            message: 'Username required'
                                    },
                                    stringLength: {
                                            min: 1,
                                            max: 15,
                                            message: 'Username no more than 15 characters'
                                    },
                                    regexp: {
                                            //http://www.regular-expressions,info/
                                            //http://www.regular-expressions.info/quickstart.html
                                            //http://www.regular-expressions.info/shorthand.html
                                            //http://stackoverflow.com/questions/13283470/regex-forallowing-alphanumeric-and-space
                                            //alphanumeric, hyphens, underscores, and spaces
                                            //regexp:/^[a-zA-Z0-9\-_\s]+$/,
                                            //similar to: (though, \w supports other Unicode characters)
                                            regexp: /^[\w\-\s]+$/,
                                            message: 'Name can only contain letters, numbers, hyphens, and underscore'
                                    },
                            },
                    },

            userpswd: {
                            validators: {
                                    notEmpty: {
                                            message: 'Password required'
                                    },
                                    stringLength: {
                                            min: 1,
                                            max: 15,
                                            message: 'Password no more than 30 characters'
                                    },
                                    regexp: {
                                            //http://www.regular-expressions,info/
                                            //http://www.regular-expressions.info/quickstart.html
                                            //http://www.regular-expressions.info/shorthand.html
                                            //http://stackoverflow.com/questions/13283470/regex-forallowing-alphanumeric-and-space
                                            //alphanumeric, hyphens, underscores, and spaces
                                            //regexp:/^[a-zA-Z0-9\-_\s]+$/,
                                            //similar to: (though, \w supports other Unicode characters)
                                            regexp: /^[\w\-\s]+$/,
                                            message: 'Password can only contain letters, numbers, hyphens, and underscore'
                                    },
                            },
                    },

                },
            });
            });
        </script>
    </body>
</html>
